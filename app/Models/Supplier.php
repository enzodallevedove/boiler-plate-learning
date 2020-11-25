<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'cnpj', 'company_name', 'trading_name',
    ];
}
