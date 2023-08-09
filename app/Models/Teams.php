<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teams extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'teams';
    protected $fillable = [
        'name',
        'email',
        'user_id',
        'phone',
        'date_join',
        'bank',
        'bank_route',
        'front_percent',
        'back_percent',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'website',
        'timezone',
        'website',
        'currency',
        'cc_disputes_email',
    ];

    public function user(): BelongsToMany
    {
        return $this->BelongsToMany(User::class);
    }
    public function products() {
        return $this->hasMany(RentalProducts::class, 'team_id');
    }
    public function widgetFlows() {
        return $this->hasMany(WidgetFlow::class, 'team_id');
    }
    public function advance() {
        return $this->hasOne(RentalProducts::class, 'team_id');
    }
}
