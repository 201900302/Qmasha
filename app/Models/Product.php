<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //make all fields fillable 
    protected $guarded = [];

    public function vendor(){
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
}
