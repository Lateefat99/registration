<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'amountPaid',
        'collectedBy',
    ];

    public function payments(){

        return $this->belongsTo('App\Models\Payment');

    }
}
