<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['date_sale', 'amount_sale', 'discount', 'increase', 'amount_total', 'obs', 'users_id'];
}
