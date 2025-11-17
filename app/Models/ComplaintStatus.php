<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'label', 'order_no'
    ];

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'current_status_id');
    }
}
