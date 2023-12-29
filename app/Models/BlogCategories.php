<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Categories;

class BlogCategories extends Model
{
    use HasFactory;
    protected $table = 'blog_categories';
    protected $primaryKey = 'id';

    public function Categories()
    {
        return $this->belongsTo(Categories::class,'categories_id');
    } 
}
