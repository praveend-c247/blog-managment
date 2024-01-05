<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\{User};

/**
 * Class BlogService.
 */
class CheckOutService
{
    public static function checkOut($orderData): User
    {
        
        $user = User::find($orderData->id);
        $user->contact_no = $orderData->contact_no;
        $user->address = $orderData->address;
        $user->subscription_plan_id = $orderData->subscription_plan_id;
        
        $user->update(); 
        return $user;
    }
}
