<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PattientProfile extends Model
{
    use HasFactory;
    protected $primaryKey = 'pattient_id';

    protected $fillable = [
        'pattient_id',
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'street_address',
        'city',
        'state',
        'country',
        'locale',
        'job_name',
        'specialization',
        'image',
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://th.bing.com/th/id/OIP.bxvaxfb76xs-iWKbTzc4QwHaHL?w=201&h=195&c=7&r=0&o=5&pid=1.7';
        }
        return asset('assets/img/' . $this->image);

    }
}
