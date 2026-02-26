<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sports extends Model
{
    public function equipment(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class);
    }

    protected $fillable = [
        'name',
    ];
}
