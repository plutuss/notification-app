<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = Hash::make('1234demo');

        $users = [
            [
                'name' => 'Ivanov',
                'email' => 'ivanov@example.com',
                'password' => $pass,
            ],
            [
                'name' => 'Petrov',
                'email' => 'petrov@example.com',
                'password' => $pass,
            ]
        ];

        foreach ($users as $user) {
            User::query()
                ->create($user);
        }

        User::factory(60)->create();

    }
}
