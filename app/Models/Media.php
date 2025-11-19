<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'Media',
        'ComplaintId'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'ComplaintId');
    }
}
