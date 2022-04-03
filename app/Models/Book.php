<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /// mass assignment
    protected $guarded = [];


    /// always get stock & kind with books
    //protected $with = ['stocks'];


    public function kinds()
    {
        return $this->belongsTo('App\Models\Kind', 'kind_id');
    }

    public function stocks()
    {
        return $this->hasOne('App\Models\StockBook', 'book_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\OrderBook', 'book_id');
    }


    /// helper function auto generate slug from title
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }


    public function setPriceAttribute($value)
    {
        return  $this->attributes['price']  = $value * 100;
    }


    public function getPriceAttribute()
    {
        return number_format( $this->attributes['price']  / 100, 2);
    }
}
