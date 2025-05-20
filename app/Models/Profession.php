<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    final function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    final function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    final function skills(): HasMany
    {
        return $this->hasMany(ProfessionSkill::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($profession) {
            if (empty($profession->slug)) {
                $profession->slug = static::generateUniqueSlug($profession->name);
            }
        });

        static::updating(function ($profession) {
            if ($profession->isDirty('name') && !$profession->isDirty('slug')) {
                $profession->slug = static::generateUniqueSlug($profession->name, $profession->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        $query = static::where('slug', $slug);
        if ($excludeId !== null) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $count++;
            $query = static::where('slug', $slug);
            if ($excludeId !== null) {
                $query->where('id', '!=', $excludeId);
            }
        }
        return $slug;
    }
}

