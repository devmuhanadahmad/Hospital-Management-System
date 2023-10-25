<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'image',
        'identity'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://th.bing.com/th/id/OIP.bxvaxfb76xs-iWKbTzc4QwHaHL?w=201&h=195&c=7&r=0&o=5&pid=1.7';
        }
        return asset('assets/img/' . $this->image);

    }
}
