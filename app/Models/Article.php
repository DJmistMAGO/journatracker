<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;
use App\Models\PubManagement;

class Article extends Model
{
	use HasFactory, HasRichText;

	protected $fillable = [
		'user_id',
		'title',
		'description', // Keep this - the trait handles it
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

	// Define which fields should use rich text storage
	protected $richTextFields = [
		'description',
	];

	// Define attributes for rich text fields (required by the package)
	protected $richTextAttributes = [
		'description',
	];

	// REMOVE the getDescriptionAttribute method - it conflicts with the trait!

	// Each article belongs to a user
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function publication()
	{
		return $this->morphOne(PubManagement::class, 'content');
	}

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
