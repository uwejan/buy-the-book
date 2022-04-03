<?php

namespace App\Http\Controllers;

use App\Models\Kind;
use Illuminate\Http\Request;

class KindController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $kinds = Kind::all();

        /// for better results / performance there should be pagination

        return response()->json([
            'success' => true,
            'data' => $kinds,
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
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

       if ($validated){
           $data = Kind::create($request->all());
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
        $kind = Kind::find($id);

        return response()->json([
            'success' => true,
            'data' => $kind
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
            'name' => 'required|string',
            'description' => 'required|string',
            ]);

        if ($validated){
            $kind = Kind::where('id', $id)
                        ->update($request->all());

            return response()->json([
                'success' => true,
                'data' => $kind
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
        Kind::destroy($id);
        return response()->json([
            'success' => true,
        ]);
    }
}
