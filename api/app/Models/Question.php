<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'difficulty'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function theme()
    {
        return $this->hasOne(Theme::class);
    }
}
