<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['date_start', 'date_due', 'amount', 'status', 'users_id'];
}
