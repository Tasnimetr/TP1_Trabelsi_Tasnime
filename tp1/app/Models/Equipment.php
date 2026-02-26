<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipment extends Model
{

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rentals::class);
    }

    public function sports(): BelongsToMany
    {
        return $this->belongsToMany(Sports::class, 'equipmentsports');
    }

    protected $fillable = [
        'name',
        'description',
        'dailyPrice',
        'category_id',
    ];
}
