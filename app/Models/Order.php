<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $with = ['details'];


    /// mass assignment
    protected $guarded = [];

    /// cast in cas if order meta to be stored as JSON
    protected $casts = [
        'meta' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function books()
    {
        return $this->belongsToMany('App\Models\Book');
    }

    public function details()
    {
        return $this->hasMany('App\Models\OrderBook');
    }
}
