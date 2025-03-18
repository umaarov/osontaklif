<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'link', 'profession_id', 'grade'];

    final function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }
}
