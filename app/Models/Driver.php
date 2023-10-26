<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','phone','notes','ambulance_id', 'status'
    ];

    public function ambulances(){
        return $this->belongsTo(Ambulances::class,'ambulance_id','id');
    }



}
