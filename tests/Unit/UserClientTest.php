<?php

namespace Tests\Unit;

use App\Role;
use App\User;
use App\Client;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserClientTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function create_user(): User
    {
        /** @var User $user */
        $user = User::create([
            'name' => 'Bartłomiej Olszanowski',
            'email' => 'baloo@baloo.baloo',
            'password' => 'baloo',
            'role' => Role::ROLE_CLIENT
        ]);
        $profile_attr = [
            'name' => $user->name,
            'links' => 'http://baloo.baloo',
            'file' => 'path_to_logo'
        ];
        $user->profile()->create($profile_attr);


        return $user;
    }

    /** @test */
    public function it_can_create_user(): void
    {
        /** @var User $user */
        $user = User::create([
            'name' => 'Bartłomiej Olszanowski',
            'email' => 'baloo@baloo.baloo',
            'password' => 'baloo',
            'role' => Role::ROLE_CLIENT
        ]);
        $profile_attr = [
            'name' => $user->name,
            'links' => 'http://baloo.baloo',
            'file' => 'path_to_logo'
        ];
        $user->profile()->create($profile_attr);

        $this->assertInstanceOf(User::class, $user);
        $this->assertTrue($user->isClient());
        $this->assertFalse($user->isEmployer());
        $this->assertFalse($user->isAdmin());
        /** @var Client $profile */
        $profile = $user->profile()->first();
        $this->assertInstanceOf(Client::class, $profile);
        $this->assertEquals('Bartłomiej Olszanowski', $user->name);
        $this->assertEquals('baloo@baloo.baloo', $user->email);
        $this->assertEquals(Str::slug($profile_attr['name']), $profile->slug);
        $this->assertEquals($profile_attr['links'], $profile->links);
        $this->assertEquals($profile_attr['file'], $profile->file);
    }

    /** @test */
    public function it_can_update_user(): void
    {
        $user = $this->create_user();

        $new_user_attr = [
            'name' => 'Bartek Olszanowski',
            'email' => 'baloo2@baloo2.baloo2',
        ];

        $user->update($new_user_attr);

        $this->assertEquals($new_user_attr['name'], $user->name);
        $this->assertEquals($new_user_attr['email'], $user->email);
    }

    /** @test */
    public function it_can_update_profile(): void
    {
        $user = $this->create_user();

        $new_profile_attr = [
            'name' => 'Bartek Olszanowski',
            'links' => 'github',
            'file' => 'new_file'
        ];

        /** @var Client $profile */
        $profile = $user->profile()->first();
        $profile->update($new_profile_attr);

        $this->assertEquals($new_profile_attr['name'], $profile->name);
        $this->assertEquals(Str::slug($new_profile_attr['name']), $profile->slug);
        $this->assertEquals($new_profile_attr['links'], $profile->links);
        $this->assertEquals($new_profile_attr['file'], $profile->file);
    }
    /** @test */
    public function it_can_delete_user_with_profile(): void
    {
        $user = $this->create_user();
        $profile = $user->profile()->first();

        $user->delete();

        $this->assertDeleted($user);
        $this->assertDeleted($profile);

    }

    /** @test */
    public function it_can_delete_profile_with_user(): void
    {
        $user = $this->create_user();
        $profile = $user->profile()->first();

        $profile->delete();

        $this->assertDeleted($user);
        $this->assertDeleted($profile);

    }

}
