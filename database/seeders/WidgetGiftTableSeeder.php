<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WidgetGiftTableSeeder extends Seeder
{

    static $gifts = [
        [
            'widget_flow_id' => 1,
            'name' => 'Gift |1',
            'is_show' => 1,
        ],
        [
            'widget_flow_id' => 1,
            'name' => 'Gift |2',
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
        foreach (self::$gifts as $gift) {
            DB::table('widget_gift')->insert([
                'widget_flow_id' => $gift['widget_flow_id'],
                'name' => $gift['name'],
                'is_show' => $gift['is_show'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
