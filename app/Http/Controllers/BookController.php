<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $book = Book::with('stocks')->get();

        /// for better results / performance there should be pagination

        return response()->json([
            'success' => true,
            'data' => $book,
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
            'kind_id' => 'required|integer',  /// enable if required
            'price' => 'required|gte:0|lte:99',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

       if ($validated){
           $data = $request->all();
           $book = Book::create($data);
           return response()->json([
               'success' => true,
               'data' => $book
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
        $book = Book::with('stocks')->find($id);

        return response()->json([
            'success' => true,
            'data' => $book
        ]);
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kind_id' => 'required|integer',
            'price' => 'required|gte:0|lte:99',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);
        if ($validated){
            $book = Book::where('id', $id)
                        ->update($request->all());

            return response()->json([
                'success' => true,
                'data' => $book
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
        Book::destroy($id);
        return response()->json([
            'success' => true,
        ]);
    }
}
