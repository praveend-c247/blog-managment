<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SubscriptionPlans extends Model
{
    use HasFactory;
    protected $table = 'subscription_plans';
    protected $primaryKey = 'id';

    public function getUser()
    {
        return $this->hasMany(User::class,'subscription_plan_id')->where('id', auth()->id());
    }
}
