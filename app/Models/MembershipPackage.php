<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPackage extends Model
{
    protected $fillable = [
        'name',
        'description', 
        'price',
        'duration_days',
        'color',
        'is_active',
    ];

    // Relasi ke users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}