<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBook extends Model
{
    use HasFactory;

    /// mass assignment
    protected $guarded = [];


    /// always get stock with books
    //protected $with = ['books'];



    public function books()
    {
        return $this->belongsTo('App\Models\Book', 'id');
    }

}
