<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    //to make all the feilds fillable 
    protected $guarded = [];

    //create relashionship
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
