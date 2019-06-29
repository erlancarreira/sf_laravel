<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['id', 'name', 'site'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
