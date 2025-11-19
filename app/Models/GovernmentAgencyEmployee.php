<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentAgencyEmployee extends Model
{
    use HasFactory;
    protected $table = 'agency_employees';
    protected $fillable = [
        'EmploymentStatus',
        'EmploymentDate',
        'CanResponseToComplaint',
        'CanChangeComplaintStatus',
        'UserId',
        'GovernmentAgencyEmploymentTypeId'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId');
    }

    public function employmentType()
    {
        return $this->belongsTo(GovernmentAgencyEmploymentType::class, 'EmploymentTypeId');
    }

    public function responses()
    {
        return $this->hasMany(ComplaintResponse::class, 'EmployeeId');
    }
}
