<?php

namespace Database\Seeders;

use App\Models\Kind;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class KindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        $faker = Factory::create('en_US');

        Kind::insert([
            [
                'name' => 'PHP Books',
                'slug' => 'php',
                'description' => $faker->realText(120),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'CSS Books',
                'slug' => 'css',
                'description' => $faker->realText(120),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'JAVA Books',
                'slug' => 'java',
                'description' => $faker->realText(120),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
