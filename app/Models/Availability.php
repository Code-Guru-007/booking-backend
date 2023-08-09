<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $table = 'availabilities';
    protected $casts = [
        'days' => 'json',
        'starts_specific' => 'json',
    ];

    protected $fillable = [
        'times',
        'start_time',
        'end_time',
        'starts_every',
        'days',
        'starts_specific',
    ];

    public function product()
    {
        return $this->belongsTo(RentalProducts::class,'product_id');
    }

    public function durations()
    {
        return $this->belongsToMany(Duration::class);
    }
}
