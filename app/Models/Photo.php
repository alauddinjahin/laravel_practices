<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class,'photo_id','id');
    }
}
