<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en_US');

        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name'           => $faker->userName(),
                'email'          => 'user' . $i . '@example.com',
                'password'       => bcrypt('password'),
            ]);
        }

    }
}
