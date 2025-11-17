<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id', 'from_status_id',
        'to_status_id', 'comment', 'changed_by'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function fromStatus()
    {
        return $this->belongsTo(ComplaintStatus::class, 'from_status_id');
    }

    public function toStatus()
    {
        return $this->belongsTo(ComplaintStatus::class, 'to_status_id');
    }

    public function changer()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
