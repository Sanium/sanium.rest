<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['name' => env('ADMIN_NAME'), 'email' => env('ADMIN_EMAIL'), 'password' => Hash::make(env('ADMIN_PASSWORD')), 'role' => \App\Role::ROLE_ADMIN]);
        $user->profile()->create(['name' => $user->name]);
        $user->markEmailAsVerified();
    }
}
