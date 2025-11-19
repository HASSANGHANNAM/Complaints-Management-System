<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintResponse extends Model
{
    use HasFactory;
    protected $fillable = [
        'Response',
        'EmployeeId',
        'UserId',
        'ComplaintId',
        'ParentId'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'ComplaintId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId');
    }

    public function employee()
    {
        return $this->belongsTo(GovernmentAgencyEmployee::class, 'EmployeeId');
    }

    public function parentResponse()
    {
        return $this->belongsTo(ComplaintResponse::class, 'ParentId');
    }

    public function replies()
    {
        return $this->hasMany(ComplaintResponse::class, 'ParentId');
    }

}
