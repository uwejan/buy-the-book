<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\StockBook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class DecreaseStock
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

        /// Handle OrderBook
        foreach ($meta as $key => $item){
            StockBook::find($item['stock_id'])
                ->decrement('quantity',$item['quantity'] );
        }
    }
}
