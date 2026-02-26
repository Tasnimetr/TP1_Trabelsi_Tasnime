<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    protected $fillable = [
        'name',
    ];
}
