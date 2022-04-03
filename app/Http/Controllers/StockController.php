<?php

namespace App\Http\Controllers;

use App\Models\StockBook;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $stock = StockBook::all();

        /// for better results / performance there should be pagination

        return response()->json([
            'success' => true,
            'data' => $stock,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

       if ($validated){
           $data = StockBook::create($request->all());
           return response()->json([
               'success' => true,
               'data'   => $data
           ]);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $stock = StockBook::find($id);

        return response()->json([
            'success' => true,
            'data' => $stock
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer',
        ]);
        if ($validated){
            $stock = StockBook::where('id', $id)
                        ->update($request->all());

            return response()->json([
                'success' => true,
                'data' => $stock
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        StockBook::destroy($id);

        return response()->json([
            'success' => true,
        ]);
    }
}
