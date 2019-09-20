<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPlatform extends Model
{
    protected $fillable = [
        'name', 'image',
    ];
}
