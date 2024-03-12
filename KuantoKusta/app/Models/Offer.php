<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['store', 'link_store', 'price', 'product_id'];


    public function product(){
        return $this->belongsTo(Product::class);

    }
}
