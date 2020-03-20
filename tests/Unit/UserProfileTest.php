<?php

namespace Tests\Unit;

use App\Employer;
use App\User;
use App\Role;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $emRole;

    public function setUp(): void
    {
        parent::setUp();

        $this->emRole = Role::create(['name' => 'employer']);
    }

    public function create_user()
    {
        return User::create([
            'name' => 'baloo',
            'email' => 'baloo@baloo.baloo',
            'password' => 'baloo'
        ]);
    }

    /** @test */
    public function it_can_create_user()
    {
        /** @var User $user */
        $user = $this->create_user();

        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(Role::class, $user->roles()->first());
        $this->assertTrue($user->isEmployer());
        $this->assertInstanceOf(Employer::class, $user->profile()->first());
        /** @var Employer $profile */
        $profile = $user->profile()->first();
        $this->assertEquals('baloo', $user->name);
        $this->assertEquals('baloo@baloo.baloo', $user->email);
        $this->assertEquals(Str::slug('baloo'), $profile->slug);


    }

    /** @test */
    public function it_can_update_user()
    {
        /** @var User $user */
        $user = $this->create_user();

        $new_user_attr = [
            'name' => 'baloo2',
            'email' => 'baloo2@baloo2.baloo2',
        ];

        $user->update($new_user_attr);

        $this->assertEquals($new_user_attr['name'], $user->name);
        $this->assertEquals($new_user_attr['email'], $user->email);
    }

    /** @test */
    public function it_can_update_profile()
    {
        /** @var User $user */
        $user = $this->create_user();

        $new_profile_attr = [
            'name' => 'BALOO CORP'
        ];

        /** @var Employer $profile */
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
