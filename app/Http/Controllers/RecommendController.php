<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RecommendController extends Controller
{
    public function cheapest()
    {
        /// get the first cheapest book since kind not provided
        $book =  Book::orderBy('price', 'ASC')->first();
        return response()->json([
            'success' => true,
            'data' => $book
        ]);
    }


    /// Get the cheapest book for the kind provided
    /// Recommend books
    public function cheapestByKind($kind)
    {
        /// get the cheapest book that matches the provided kind
        $book =  Book::whereHas('kinds', function($q) use ($kind)
        {
            $q->where('slug', '=', $kind);

        })
            ->orderBy('price', 'ASC')->first();

        /// get kind id for later use
        $kindId = $book->kinds->id;

        /// get 5 recommendations => NSPF => check orders table
        ///  for same kind provided
        /// get 5 books that are sold with price ASC
        $recs = Book::whereHas('orders', function($q) use ($kindId, $book)
        {
            $q->where('kind_id', '=', $kindId);

        })
            ->orderBy('price', 'ASC')
            /// do not get same book again
            ->where('slug', '!=', $book->slug)
            ->take(5)
            ->get();

        /// In case we do not find 5 books, store slug of found books
        $names = addItemToArray($recs);



        /// get number of missing books to get
        $itemToGet = 5 - count($names);

        /// Get the missing number of books based on
        /// the same kind but not already recommended
        if ($itemToGet != 0){
            $newBook =  Book::whereHas('kinds', function($q) use ($kind, $names, $book)
            {
                $q->where('slug', '=', $kind);

            })
                ->orderBy('price', 'ASC')
                ->whereNotIn('slug', $names)
                /// do not get same book again
                ->where('slug', '!=', $book->slug)
                ->take($itemToGet)
                ->get();

            $recs->push(...$newBook);
        }

        $data = [
            'book' => $book,
            'recommendations' => $recs
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
