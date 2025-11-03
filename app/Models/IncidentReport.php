<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class IncidentReport extends Model
{
    protected $fillable = [
        'student_name',
        'student_id_image',
        'incident_description',
        'email',
        'image_proof',
        'date_submitted',
        'date_status',
        'status',
        'remarks'
    ];

    protected $casts = [
        'date_submitted' => 'date',
        'date_status' => 'date',
    ];

    // Add this accessor so notification can use a consistent property
    protected function reporterName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->student_name,
        );
    }
}
