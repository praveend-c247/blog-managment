<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $table = 'reactions';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'reactable_id', 'reactable_type', 'emoji'];

    public function reactable()
    {
        return $this->morphTo();
    }
}