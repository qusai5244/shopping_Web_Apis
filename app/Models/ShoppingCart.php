<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    protected $primaryKey = 'shopping_cart_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}