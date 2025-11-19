<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'Status',
        'ComplaintId'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'ComplaintId');
    }
}
