<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'brand',
        'image'
    ];

    public function categorie(){
        return $this->belongsTo(Categorie::class, 'category_id');
    }

    public function offers(){
        return $this->hasMany(Offer::class);

    }
}
