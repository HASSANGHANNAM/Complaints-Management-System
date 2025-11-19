<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentAgencyEmploymentType extends Model
{
    use HasFactory;
    protected $table = 'employment_types';

    protected $fillable = [
        'NameAr',
        'NameEn'
    ];

    public function employees()
    {
        return $this->hasMany(GovernmentAgencyEmployee::class, 'EmploymentTypeId');
    }
}
