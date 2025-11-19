<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentAgencySection extends Model
{
    use HasFactory;

    protected $table = 'agency_sections';

    protected $fillable = [
        'NameAr',
        'NameEn',
        'DescriptionAr',
        'DescriptionEn',
        'AgencyId'
    ];

    public function agency()
    {
        return $this->belongsTo(GovernmentAgency::class, 'AgencyId');
    }

    public function services()
    {
        return $this->hasMany(GovernmentAgencySectionService::class, 'SectionId');
    }

}
