<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'email', 'address', 'rfc', 'phone',
        'cellphone', 'credit', 'notes', 'products'
    ];
}
