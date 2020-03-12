<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $emRole = Role::where('name', 'employer')->first();
        $clRole = Role::where('name', 'client')->first();


        $admin = User::create([
            'name' => 'baloo',
            'email' => 'baloo@int.pl',
            'password' => Hash::make("adminadmin")
        ]);

        $em1 = User::create([
            'name' => 'em1',
            'email' => 'em1@int.pl',
            'password' => Hash::make("em")
        ]);

        $em2 = User::create([
            'name' => 'em2',
            'email' => 'em2@int.pl',
            'password' => Hash::make("em")
        ]);

        $cl = User::create([
            'name' => 'cl',
            'email' => 'cl@int.pl',
            'password' => Hash::make("cl")
        ]);

        $admin->roles()->attach($adminRole);
        $em1->roles()->attach($emRole);
        $em2->roles()->attach($emRole);
        $cl->roles()->attach($clRole);
    }
}
