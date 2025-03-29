<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfessionSkill extends Model
{
    use HasFactory;

    protected $fillable = ['profession_id', 'skill_name', 'count', 'last_updated'];

    protected $casts = [
        'last_updated' => 'datetime',
    ];

    final public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }
}
