<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    public function trainings()
    {
        return $this->belongsToMany('App\Models\Training', 'training_exercises');
    }

    public function exercise_effs()
    {
        return $this->hasMany("App\Models\ExerciseEff");
    }
}
