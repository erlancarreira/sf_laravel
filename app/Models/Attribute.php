<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{   
    
    //protected $table = 'attributes';
    
    protected $fillable = [ 
        'name', 
        'quantity',
        'amount'
    ];

    public function itens()
    {   
        return $this->belongsToMany(Item::class,'item_attribute', 'item_id', 'attribute_id'); 
                        
    }

    public function store($id, Atribute $atribute) 
    {
        dd($id, $atribute);
    }

}
