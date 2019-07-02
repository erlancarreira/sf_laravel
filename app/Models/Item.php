<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{   
    //protected $primaryKey = 'id'; // or null

    //public $incrementing = false;
    const TYPE = ['sale' => 'Vendas', 'service' => 'Servicos', 'bill' => 'Contas a pagar'];

    public $timestamps = false;

    protected $table = 'itens';

   // protected $with = ['attributes:item_id,name,quantity,amount'];  

    protected $fillable = [
        'category_id', 
        'user_id', 
        'type',
        'payment_date', 
        'payment_method', 
        'payment_status', 
        'description', 
        'additionally', 
        'discount', 
        'amount_total'
    ];
    
    // protected $casts = [
    //     'payment_date' => 'date:Y-m-d'
    // ];

    public function products()
    {   
        return $this->belongsToMany(Product::class,'item_product','item_id','product_id')->withPivot('quantity', 'amount')
        ->withTimestamps();
                        
    }

    public function attributes()
    {   
        return $this->belongsToMany(Attribute::class,'item_attribute', 'item_id', 'attribute_id')->withTimestamps(); //->withTimestamps();
                        
    }

    public function categories()
    {
    	return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function users()
    {   
        return $this->hasMany(User::class, 'id', 'user_id');
                        
    }


}
