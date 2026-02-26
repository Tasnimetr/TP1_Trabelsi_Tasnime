<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rentals extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasOne(Reviews::class);
    }

    protected $fillable = [
        'startDate',
        'endDate',
        'totalPrice',
        'user_id',
        'equipment_id',
    ];
}
