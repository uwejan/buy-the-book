<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\StockBook;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = Storage::disk('public')->allFiles('books');
        $faker = Factory::create('en_US');

        for ($i = 1; $i <= 60; $i++) {
           $book = Book::create([
                    'price' => [10000, 20000, 30000][array_rand([10000, 20000, 30000])],
                    'kind_id' => [1, 2, 3][array_rand([1, 2, 3])],
                    'name' => 'Book ' . $i,
                    'slug' => 'book-' . $i,
                    'description' =>
                        [240, 250, 270][array_rand([240, 250, 270])] .
                        ' pages, ' .
                        $faker->realText(100),
                    'image' => $files[rand(0, count($files) - 1)],
                ]);

           StockBook::create([
               'book_id'    =>  $book->id,
           ]);

        }
    }

}
