<?php

use App\Coupon;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => '10K',
            'type' => 'fixed',
            'value' => 10000,
        ]);
        Coupon::create([
            'code' => '20K',
            'type' => 'fixed',
            'value' => 20000,
        ]);
        Coupon::create([
            'code' => '30K',
            'type' => 'fixed',
            'value' => 30000,
        ]);

        Coupon::create([
            'code' => '10%',
            'type' => 'percent',
            'percent_off' => 10,
        ]);
    }
}
