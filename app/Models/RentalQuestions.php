<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalQuestions extends Model
{
    protected $table = 'rental_questions';
    protected $fillable = [
        'product_id',
        'question_id',
        'is_require',
        'is_internal',
        'is_display',
        'is_assign',
    ];

    public function product(){
        return $this->hasOne(RentalProducts::class,'id','product_id');
    }

    public function question(){
        return $this->hasOne(Question::class,'id','question_id');
    }
}
