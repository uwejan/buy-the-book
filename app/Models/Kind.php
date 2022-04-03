<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'kinds';


    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }


    /// helper function auto generate slug from title
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}
