<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSale extends Model
{
    protected $fillable = ['quantity', 'price', 'sale_id', 'product_id'];
}
