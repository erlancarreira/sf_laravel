<?php

namespace App\Models;
use App\Models\Brands;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //protected $table = 'products';

    protected $fillable = ['user_id', 'brand_id', 'name', 'description', 'stock', 'price_cost', 'price_sale'];
    
    public function itens()
    {   
        return $this->belongsToMany(Item::class, 'item_product', 'item_id', 'product_id');
    }

    public function brands()
    {
    	return $this->hasMany(Brand::class, 'id', 'brand_id');
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }
}
