<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountBank extends Model
{
    protected $fillable = ['bank_id', 'type', 'full_name', 'cpf', 'agency', 'account_number'];
}
