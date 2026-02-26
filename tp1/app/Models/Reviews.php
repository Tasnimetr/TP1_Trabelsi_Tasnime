<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{

    public function rental()
    {
        return $this->belongsTo(Rentals::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'rating',
        'comment',
        'user_id',
        'rental_id',
    ];
}
