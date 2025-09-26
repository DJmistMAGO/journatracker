<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PubManagement;

class Media extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'title',
		'description',
		'image_path',
		'link',
		'category',
		'tags',
		'date_submitted',
		'date_publish',
		'status',
		'remarks',
	];

	protected $casts = [
		'tags'          => 'array',
		'date_submitted' => 'date',
		'date_publish'  => 'date',
	];


	/**
	 * Relation: Media belongs to a user (who submitted it)
	 */
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function publication()
	{
		return $this->morphOne(PubManagement::class, 'content');
	}
}
