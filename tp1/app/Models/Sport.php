<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sport extends Model
{
    use HasFactory;

    public function equipment(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class);
    }

    protected $fillable = [
        'name',
    ];
}
