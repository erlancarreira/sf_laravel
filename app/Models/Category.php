<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'user_id', 'category_id', 'name'];

    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }

    public function itens()
    {
    	return $this->hasMany(Item::class, 'id', 'category_id');
    }
}
