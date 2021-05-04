<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'fees', 'createdBy'];

    public function registers(){

        return $this->belongsToMany(Register::class)->withPivot(['student_class', 'session'])->withTimestamps();

    }

   /* public function regProgram(){

        return th
    }*/
}
