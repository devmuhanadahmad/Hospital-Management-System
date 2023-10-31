<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptAccount extends Model
{
    use HasFactory;


    protected $fillable = [
        'debit',
        'pattient_id',
        'notes',
    ];

    public function pattient()
    {
        return $this->belongsTo(Pattient::class,'pattient_id','id')->withDefault(['name'=>'unKnow']);
    }
}
