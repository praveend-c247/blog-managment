<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Blogs;
use App\Models\Replies;
use App\Models\Reaction;

class Comments extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function blog() {
        return $this->belongsTo(Blogs::class);
    }

    public function replies() {
        return $this->hasMany(Replies::class);
    }

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }
}
