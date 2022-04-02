<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function kinds()
    {
        return $this->belongsTo('App\Models\Kind', 'kind_id');
    }

    public function stock()
    {
        return $this->belongsTo('App\Models\StockBook', 'book_id');
    }


    public function orders()
    {
        return $this->hasMany('App\Models\OrderBook', 'book_id');
    }


}
