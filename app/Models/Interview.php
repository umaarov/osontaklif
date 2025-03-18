<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'link', 'profession_id', 'grade'];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
