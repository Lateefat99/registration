<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Register extends Model
{
    public $directory = "/";
    use HasFactory;
//    use SoftDeletes;

    protected $fillable = [
        'title',
        'firstname',
        'lastname',
        'd_o_b',
        'address',
        'gender',
        'marital_status',
        'nationality',
        'place_of_origin',
        'state_of_origin',
        'local_govt',
        'lang_spoken',
        'guardian_name',
        'guardian_phone',
        'guardian_email',
        'guardian_relationship',
        'card_number',
    ];

    public function getFilenameAttribute($value){

        return $this->directory . $value;

    }

    public function payments(){

        return $this->hasMany('App\Models\Payment');

    }

    public function programs(){

        return $this->belongsToMany(Program::class)
            ->withPivot(['student_class', 'session'])->withTimestamps();

    }

    public function __toString()
    {
        return $this->toJson();
    }

    public function valid($currentDate){

        return $this->payments()->where('expiryDate', '>', $currentDate)->get();
    }

    public function invalid($currentDate){

        return $this->payments()->where('expiryDate', '<=', $currentDate)->first();
    }

    public function programClass($programId, $studClass){

        return $this->programs()->where('program_id', '=', $programId)
            ->wherePivot('student_class', '=', $studClass)->get();

    }


}
