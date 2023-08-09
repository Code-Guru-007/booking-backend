<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalProductsTableSeeder extends Seeder
{

    static $products = [
        [
            'name' => 'Jet Ski Rental 1',
            'description' => 'Jet Ski Rental Description 1',
            'tax_template' => 1,
            'team_id' => '1',
        ],
        [
            'name' => 'Jet Ski Rental 2',
            'description' => 'Jet Ski Rental Description 2',
            'tax_template' => 2,
            'team_id' => '1',
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$products as $product) {
            DB::table('rental_products')->insert([
                'name' => $product['name'],
                'description' => $product['description'],
                'tax_template' => $product['tax_template'],
                'team_id' => $product['team_id'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
