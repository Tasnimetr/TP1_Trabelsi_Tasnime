<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function reviews()
    {
        return $this->hasOne(Review::class);
    }

    protected $fillable = [
        'startDate',
        'endDate',
        'totalPrice',
        'user_id',
        'equipment_id',
    ];
}
