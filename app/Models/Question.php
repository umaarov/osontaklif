<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['profession_id', 'question', 'content', 'chance'];

    final function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }
}
