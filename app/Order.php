<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Book;

class Order extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function books(){
        return $this->belongsToMany(Book::class)->withPivot('quantity');
    }

    // DYNAMICE PROPERTY
    public function getTotalQuantityAttribute(){
        $total_quantity = 0;

        foreach($this->books as $book){
            $total_quantity += $book->pivot->quantity;
        }

        return $total_quantity;
    }


}
