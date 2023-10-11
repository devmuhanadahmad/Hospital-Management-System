<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'notes',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

}
