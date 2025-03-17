<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['profession_id', 'question', 'chance'];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
