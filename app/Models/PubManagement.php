<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PubManagement extends Model
{
    protected $fillable = ['views'];

    public function content()
    {
        return $this->morphTo();
    }
}
