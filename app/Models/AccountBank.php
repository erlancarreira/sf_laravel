<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountBank extends Model
{
    protected $table    = 'account_banks';
    protected $fillable = ['bank_id', 'user_id', 'type', 'full_name', 'cpf', 'agency', 'account_number'];

    public function users()
    {   
        return $this->belongsToMany(User::class); 
                        
    }
}
