<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'name',
        'email',
        'password',
        'phone',
        //'days',
        'status',
        'image',
        'identity'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts=[
        //'days'=>'array',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function apointmenty()
    {
        return $this->belongsToMany(Apointmenty::class,'apointmenty_doctors');
    }


    public function profile(){
        return $this->hasOne(DoctorProfile::class)->withDefault();
   }
}
