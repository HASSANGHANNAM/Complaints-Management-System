<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    use HasFactory;
        protected $fillable = [
        'user_id', 'ip_address', 'attempts_count',
        'last_attempt_at', 'locked_until'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
