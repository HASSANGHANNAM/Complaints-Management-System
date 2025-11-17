<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_no', 'title', 'description', 'complaint_type',
        'agency_id', 'reporter_id', 'current_status_id',
        'location', 'closed_at'
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function status()
    {
        return $this->belongsTo(ComplaintStatus::class, 'current_status_id');
    }

    public function history()
    {
        return $this->hasMany(ComplaintHistory::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
