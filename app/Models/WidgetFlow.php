<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WidgetFlow extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'widget_flow';
    protected $fillable = [
        'team_id',
        'name',
        'description',
        'is_show',
    ];
    public function widgetProducts()
    {
        return $this->hasMany(WidgetProduct::class, 'widget_flow_id');
    }

    public function widgetGifts()
    {
        return $this->hasMany(WidgetGift::class, 'widget_flow_id');
    }
}
