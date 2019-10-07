<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Order;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
