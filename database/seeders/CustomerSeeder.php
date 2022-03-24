<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = [
            [
                'user_id' => 1,
                'no_va' => 1,
                'saldo'=>2500000
            ],
            [
                'user_id' => 2,
                'no_va' => 2,
                'saldo'=>800000
            ],
        ];

        \DB::table('customer')->insert($customer);
    }
}
