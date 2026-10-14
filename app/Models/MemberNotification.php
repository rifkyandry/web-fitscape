<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberNotification extends Model
{
    protected $fillable = ['user_id', 'type', 'title', 'message', 'is_read'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}