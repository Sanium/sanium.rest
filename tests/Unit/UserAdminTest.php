<?php

namespace Tests\Unit;

use App\Admin;
use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAdminTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $emRole;
    private $adminRole;

    public function setUp(): void
    {
        parent::setUp();

        $this->emRole = Role::create(['name' => 'employer']);
        $this->adminRole = Role::create(['name' => 'admin']);
    }

    public function create_user()
    {
        /** @var User $user */
        $user = User::createWithRole([
            'name' => 'baloo',
            'email' => 'baloo@baloo.baloo',
            'password' => 'baloo',
            'role' => 'admin'
        ]);
        $profile_attr = [
            'name' => $user->name,
        ];
        $user->profile()->create($profile_attr);

        return $user;
    }

    /** @test */
    public function it_can_create_user()
    {
        /** @var User $user */
        $user = User::createWithRole([
            'name' => 'baloo',
            'email' => 'baloo@baloo.baloo',
            'password' => 'baloo',
            'role' => 'admin'
        ]);
        $profile_attr = [
            'name' => $user->name,
        ];
        $user->profile()->create($profile_attr);


        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(Role::class, $user->roles()->first());
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
    public function it_can_update_profile()
    {
        /** @var User $user */
        $user = $this->create_user();

        $new_profile_attr = [
            'name' => 'BALOO CORP'
        ];

        /** @var Admin $profile */
        $profile = $user->profile()->first();
        $profile->update($new_profile_attr);

        $this->assertEquals($new_profile_attr['name'], $profile->name);
        $this->assertEquals(Str::slug($new_profile_attr['name']), $profile->slug);
    }

    /** @test */
    public function it_can_delete_user_with_profile()
    {
        /** @var User $user */
        $user = $this->create_user();
        $profile = $user->profile()->first();

        $user->delete();

        $this->assertDeleted($user);
        $this->assertDeleted($profile);

    }

    /** @test */
    public function it_can_delete_profile_with_user()
    {
        /** @var User $user */
        $user = $this->create_user();
        $profile = $user->profile()->first();

        $profile->delete();

        $this->assertDeleted($user);
        $this->assertDeleted($profile);

    }
}
