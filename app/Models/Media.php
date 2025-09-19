<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'date',
        'tags',
        'description',
        'image_path',
        'link',
    ];

    /**
     * Relation: Media belongs to a user (who submitted it)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
