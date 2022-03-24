<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                'harga' => 50000,
                'created_by' => null,
                'updated_by' => null,
            ],
            [
                'harga' => 100000,
                'created_by' => null,
                'updated_by' => null,
            ],
            [
                'harga' => 200000,
                'created_by' => null,
                'updated_by' => null,
            ],
            [
                'harga' => 300000,
                'created_by' => null,
                'updated_by' => null,
            ],
        ];

        \DB::table('product')->insert($product);
    }
}
