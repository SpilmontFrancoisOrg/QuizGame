<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'score',
        'date',
        'time',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
