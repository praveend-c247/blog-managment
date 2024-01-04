<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlans;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['plan_name' => 'Free','amount'=>0,'blog_count'=>'2'],
            ['plan_name' => 'Pro','amount'=>2000,'blog_count'=>'10'],
            ['plan_name' => 'Pro Plus','amount'=>5000,'blog_count'=>'30']
        ];
        SubscriptionPlans::insert($data);
    }
}
