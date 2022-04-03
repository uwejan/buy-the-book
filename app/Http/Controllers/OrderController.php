<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function userOrders()
    {
        $data = auth()->user();
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subtotal' => 'required|integer',
            'tax' => 'required|integer',
            'total' => 'required|integer',
            'meta' => 'required|array', /// can also add validation for each expected key
        ]);

        if ($validated){
            /// Handle payment
            /// TODO
            ///
            /// Handle Shipment
            /// TODO
            ///
            /// Handle order
            /// Store Order + Decrease Stock through events
            /// Events helps with queuing and make code cleaner
            /// And easier to maintain
            event(new OrderPlaced($request));

            /// Handle Emails notifications
            /// TODO

            return response()->json([
                'success' => true,
                'message'=> 'Order Placed Successfully!'
            ]);

        }
    }
}
