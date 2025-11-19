<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'Title',
        'Content',
        'EmployeeId',
        'UserId',
        'AgencyId',
        'SectionId'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'EmployeeId');
    }

    public function agency()
    {
        return $this->belongsTo(GovernmentAgency::class, 'AgencyId');
    }

    public function section()
    {
        return $this->belongsTo(GovernmentAgencySection::class, 'SectionId');
    }

    public function statuses()
    {
        return $this->hasMany(ComplaintStatus::class, 'ComplaintId');
    }

    public function responses()
    {
        return $this->hasMany(ComplaintResponse::class, 'ComplaintId');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ComplaintId');
    }
}
