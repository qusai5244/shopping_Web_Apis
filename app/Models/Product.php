<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    use HasFactory;

    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }
}
