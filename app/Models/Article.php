<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title_article',
        'thumbnail_image',
        'article_content',
        'date_written',
        'status',
        'category',
        'tags',
    ];

      // Cast tags to array automatically
    protected $casts = [
        'tags' => 'array',
        'date_written' => 'date',
    ];

    // Each article belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
