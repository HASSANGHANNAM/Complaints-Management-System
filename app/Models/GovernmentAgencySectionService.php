<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentAgencySectionService extends Model
{
    use HasFactory;
    protected $table = 'section_services';

    protected $fillable = [
        'NameAr',
        'NameEn',
        'DescriptionAr',
        'DescriptionEn',
        'SectionId'
    ];

    public function section()
    {
        return $this->belongsTo(GovernmentAgencySection::class, 'SectionId');
    }

}
