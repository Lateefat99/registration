<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'register_id',
        'planType',
        'expiryDate',
        'status',
        'amountPaid',
        'amountBilled',
        'balance',
    ];

    public function register(){

        return $this->belongsTo('App\Models\Register');

    }

    public function creditDetails(){

        return $this->hasMany('App\Models\CreditDetail');

    }

    public function __toString()
    {
        return $this->toJson();
    }
}
