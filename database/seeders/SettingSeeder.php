<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $batch = [
            [
                'name' => 'Subscription',
                'slug' => 'subscription',
                'description' => 'One time Subscription Fee for users',
                'meta' => '5000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Minimum Payout',
                'slug' => 'min_payout',
                'description' => 'Minimum Payout Amount',
                'meta' => '1000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Maximum Videos (Subscribers)',
                'slug' => 'max_videos',
                'description' => 'Maximum videos a subscribed User can watch to earn Per day',
                'meta' => '10',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Maximum Videos (Non Subscribers)',
                'slug' => 'max_videos_ns',
                'description' => 'Maximum videos a non subscribed user can watch to earn Per day',
                'meta' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Referral Percentage',
                'slug' => 'referral_percentage',
                'description' => 'Referral Percentage for paid subscription',
                'meta' => '30',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Payout Tax Percentage',
                'slug' => 'payout_tax_percentage',
                'description' => 'Payout Tax Percentage',
                'meta' => '10',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('settings')->insert($batch);
    }
}
