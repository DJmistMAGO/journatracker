<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PubManagement;

class Article extends Model
{
	use HasFactory;
	protected $fillable = [
		'user_id',
		'title',
		'description',
		'image_path', 
		'category',
		'tags',
		'date_submitted',
		'date_publish',
		'status',
		'remarks',
	];

	protected $casts = [
		'tags'           => 'array',
		'date_submitted' => 'date',
		'date_publish'   => 'date',
	];


	// Each article belongs to a user
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function publication()
	{
		return $this->morphOne(PubManagement::class, 'content');
	}
}
