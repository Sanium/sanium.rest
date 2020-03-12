<?php

namespace Tests\Unit;

use App\Employer;
use App\User;
use App\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $adminRole;
    private $emRole;
    private $clRole;

    public function setUp(): void
    {
        parent::setUp();

        $this->adminRole = Role::create(['name' => 'admin']);
        $this->emRole = Role::create(['name' => 'employer']);
        $this->clRole = Role::create(['name' => 'client']);
    }

    /** @test */
    public function it_can_create_admin_user()
    {
        /** @var User $user */
        $user = User::create([
            'name' => 'baloo',
            'email' => 'baloo@baloo.baloo',
            'password' => 'baloo'
        ]);

        $this->assertInstanceOf(User::class, $user);

        $user->roles()->attach($this->adminRole);

        $this->assertTrue($user->isAdmin());

    }

    /** @test */
    public function it_can_create_employer_user()
    {
        /** @var User $user */
        $user = User::create([
            'name' => 'AlleOLX',
            'email' => 'all@olx.pl',
            'password' => 'allolx'
        ]);

        $this->assertInstanceOf(User::class, $user);

        $user->roles()->attach($this->emRole);

        $this->assertTrue($user->isEmployer());

        $profile = $user->profile()->create([
            'name' => 'AlleOLX Polska'
        ]);

        $this->assertInstanceOf(Employer::class, $profile);

        $this->assertEquals('AlleOLX Polska', $user->profile()->first()->name);
    }

}
