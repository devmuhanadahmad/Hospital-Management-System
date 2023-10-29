<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'single_invoice_id',
        'pattient_id',
        'debit',
        'credit',
    ];
}
