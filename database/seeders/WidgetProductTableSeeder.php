<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WidgetProductTableSeeder extends Seeder
{

    static $products = [
        [
            'product_id' => 1,
            'widget_flow_id' => 1,
            'name' => 'Jet Ski Rental 1',
            'description' => 'Jet Ski Rental Description 1',
            'is_show' => 1,
        ],
        [
            'product_id' => 2,
            'widget_flow_id' => 1,
            'name' => 'Jet Ski Rental 2',
            'description' => 'Jet Ski Rental Description 2',
            'is_show' => 0,
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
            DB::table('widget_product')->insert([
                'product_id' => $product['product_id'],
                'widget_flow_id' => $product['widget_flow_id'],
                'name' => $product['name'],
                'description' => $product['description'],
                'is_show' => $product['is_show'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
