<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 15; $i++) {
            $order = Order::create([
                'user_id'   =>  [1, 2][array_rand([1, 2])],
                'meta'  =>  json_encode([[2, 6, 9][array_rand([2, 6, 9])], [2, 6, 9][array_rand([2, 6, 9])]])
            ]);

            for ($g = 1; $g <= 3; $g++) {
                OrderBook::create([
                    'order_id'   => $order->id,
                    'kind_id'   =>  [1, 2][array_rand([1, 2])],
                    'book_id'   => [2, 6, 9][array_rand([2, 6, 9])]
                ]);
            }
        }
    }
}
