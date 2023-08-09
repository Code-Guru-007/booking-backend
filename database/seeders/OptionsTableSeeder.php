<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OptionsTableSeeder extends Seeder
{
    static $options = [
        [
            'team_id' => 1,
            'advance' => 10,
        ],
        [
            'team_id' => 2,
            'advance' => 10,
        ],
        [
            'team_id' => 3,
            'advance' => 24,
        ],
        [
            'team_id' => 4,
            'advance' => 24,
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$options as $option) {
            DB::table('options')->insert([
                'team_id' => $option['team_id'],
                'advance' => $option['advance'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
