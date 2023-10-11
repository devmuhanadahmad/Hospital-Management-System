<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'name',
        'email',
        'password',
        'phone',
        'days',
        'status',
        'image',
    ];

    protected $hidden = [
        'password',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }


    
}
