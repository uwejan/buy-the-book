<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\Order;
use App\Models\OrderBook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class StoreOrder
{

    /**
     * @var Request $request
     */
    public $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderPlaced  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        $request = $this->request;
        $data = $request->json()->all();
        $meta = $data['meta'];
        $order = new Order();
        $order->user_id = Auth::id();
        $order->subtotal = $data['subtotal'];
        $order->tax = $data['tax'];
        $order->total = $data['total'];
        /// save order
        $order->save();

        /// Handle OrderBook
        foreach ($meta as $key => $item){
            OrderBook::create([
               'order_id' => $order->id,
               'kind_id' =>  $item['kind_id'],
               'book_id' => $item['book_id'],
               'quantity' => $item['quantity']
            ]);
        }


    }
}
