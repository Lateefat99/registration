<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgramRegister extends Pivot
{
    use HasFactory;

    public function studentClass(){

        return $this->belongsToMany(Register::class);
    }
}
