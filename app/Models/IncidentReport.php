<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
