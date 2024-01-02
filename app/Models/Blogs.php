<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Qirolab\Laravel\Reactions\Traits\Reactable;
use Qirolab\Laravel\Reactions\Contracts\ReactableInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\BlogCategories;
use App\Models\Comments;
use App\Models\Reaction;
use Illuminate\Database\Eloquent\SoftDeletes; 


class Blogs extends Model implements ReactableInterface
{
    use HasFactory, Reactable, SoftDeletes;

    protected $table = 'blogs';
    protected $primaryKey = 'id';

    public function Blogcategories()
    {
        return $this->hasMany(BlogCategories::class)->with('Categories');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class,'blog_id');
    }

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }
 
}
