<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentType extends Model
{
    use HasFactory;
    protected $fillable = ['studentType','Fees'];

    public function registers(){

        return $this->hasMany('App\Models\Register');

    }
}
