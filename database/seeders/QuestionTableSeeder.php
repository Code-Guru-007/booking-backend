<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class QuestionTableSeeder extends Seeder
{
    static $questions = [
        [
            'product_id' => 1,
            'question' => 'Enter your Car color',
            'question_type' => 'type',
            'question_answer' => null,
        ],
        [
            'product_id' => 1,
            'question' => 'Fort-Loudon|houisville Landing',
            'question_type' => 'multiple_choice',
            'question_answer' => 1,
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$questions as $question) {
            DB::table('questions')->insert([
                'question' => $question['question'],
                'question_type' => $question['question_type'],
                'question_answer' => $question['question_answer'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
