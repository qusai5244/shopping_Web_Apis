<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity', 'unit_price'];
    use HasFactory;
    protected $primaryKey = 'shopping_cart_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shoppingCartItems()
    {
        return $this->hasMany(Product::class);
    }
}
