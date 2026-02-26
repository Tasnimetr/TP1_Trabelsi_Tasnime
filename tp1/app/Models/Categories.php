<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    protected $fillable = [
        'name',
    ];
}
