<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WidgetProduct extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'widget_product';
    protected $fillable = [
        'product_id',
        'widget_flow_id',
        'name',
        'description',
        'is_show',
    ];

    public function product()
    {
        return $this->belongsTo(RentalProducts::class);
    }
}
