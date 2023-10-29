<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'pattients_id',
        'doctor_id',
        'section_id',
        'service_id',
        'price',
        'discount',
        'tax_rate',
        'tax_value',
        'total_with_tax',
        'type',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class)->withDefault(['name'=>'unKnow']);
    }

    public function pattient()
    {
        return $this->belongsTo(Pattient::class,'pattients_id','id')->withDefault(['name'=>'unKnow']);
    }

    public function section()
    {
        return $this->belongsTo(Section::class)->withDefault(['name'=>'unKnow']);
    }

    public function service()
    {
        return $this->belongsTo(Service::class)->withDefault(['name'=>'unKnow']);
    }
}
