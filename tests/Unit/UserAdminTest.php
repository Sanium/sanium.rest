<?php

namespace Tests\Unit;

use App\Admin;
use App\Role;
use App\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use PHPUnit\Framework\AssertionFailedError;
use Tests\TestCase;

class UserAdminTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function create_user(): User
    {
        $user = User::create([
            'name' => 'baloo',
            'email' => 'baloo@baloo.baloo',
            'password' => 'baloo',
            'role' => Role::ROLE_ADMIN
        ]);
        $profile_attr = [
            'name' => $user->name,
        ];
        $user->profile()->create($profile_attr);

        return $user;
    }

    /** @test */
    public function it_can_create_user(): void
    {
        /** @var User $user */
        $user = User::create([
            'name' => 'baloo',
            'email' => 'baloo@baloo.baloo',
            'password' => 'baloo',
            'role' => Role::ROLE_ADMIN
        ]);
        $profile_attr = [
            'name' => $user->name,
        ];
        $user->profile()->create($profile_attr);


        $this->assertInstanceOf(User::class, $user);
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isEmployer());
        /** @var Admin $profile */
        $profile = $user->profile()->first();
        $this->assertInstanceOf(Admin::class, $profile);
        $this->assertEquals('baloo', $user->name);
        $this->assertEquals('baloo@baloo.baloo', $user->email);
        $this->assertEquals(Str::slug($profile_attr['name']), $profile->slug);
    }

    /** @test */
    public function it_can_update_profile(): void
    {
        $user = $this->create_user();

        $new_profile_attr = [
            'name' => 'BALOO CORP'
        ];

        /** @var Admin $profile */
        $profile = $user->profile;
        $profile->update($new_profile_attr);

        $this->assertEquals($new_profile_attr['name'], $profile->name);
        $this->assertEquals(Str::slug($new_profile_attr['name']), $profile->slug);
    }

    /** @test */
    public function it_can_delete_user_with_profile(): void
    {
        $user = $this->create_user();
        /** @var Admin $profile */
        $profile = $user->profile;

        try {
            $user->delete();
        } catch (Exception $e) {
            throw new AssertionFailedError("Deletion of user failed");
        }

        $this->assertDeleted($user);
        $this->assertDeleted($profile);
    }

    /** @test */
    public function it_can_delete_profile_with_user(): void
    {
        $user = $this->create_user();
        /** @var Admin $profile */
        $profile = $user->profile;

        try {
            $profile->delete();
        } catch (Exception $e) {
            throw new AssertionFailedError("Deletion of profile failed");
        }

        $this->assertDeleted($user);
        $this->assertDeleted($profile);
    }
}
