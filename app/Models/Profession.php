<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    final function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    final function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }
}

