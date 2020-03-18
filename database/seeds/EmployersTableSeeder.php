<?php

use App\Employer;
use App\User;
use Illuminate\Database\Seeder;

class EmployersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employer::truncate();
        $user = User::where('name', 'sanium')->first();
        $user->profile()->create([
            'name' => 'Sanium REST'
        ]);
    }
}
