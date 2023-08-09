<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WidgetFlowTableSeeder extends Seeder
{

    static $widgets = [
        [
            'team_id' => '1',
            'name' => 'Jet Ski Rental',
            'description' => 'Jet Ski Rental Widget Flow Description',
            'is_show' => 1,
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$widgets as $widget) {
            DB::table('widget_flow')->insert([
                'name' => $widget['name'],
                'description' => $widget['description'],
                'team_id' => $widget['team_id'],
                'is_show' => $widget['is_show'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
