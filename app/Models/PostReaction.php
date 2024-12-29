<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostReaction extends Model
{
    const UPDATED_AT = null;
    protected $fillable = ['post_id', 'user_id', 'type'];
}
