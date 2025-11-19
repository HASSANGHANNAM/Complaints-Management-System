<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentAgency extends Model
{
    use HasFactory;
    protected $table = 'agencies';

    protected $fillable = [
        'NameAr',
        'NameEn',
        'DescriptionAr',
        'DescriptionEn',
        'LocationAr',
        'LocationEn',
        'WorkingStartTime',
        'WorkingEndTime',
        'Status',
        'ParentId',
        'ManagerId'
    ];

    public function children()
    {
        return $this->hasMany(GovernmentAgency::class, 'ParentId');
    }

    public function parent()
    {
        return $this->belongsTo(GovernmentAgency::class, 'ParentId');
    }

    public function sections()
    {
        return $this->hasMany(GovernmentAgencySection::class, 'AgencyId');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'ManagerId');
    }
}
