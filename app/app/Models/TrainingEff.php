<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingEff extends Model
{
    use HasFactory;

    public function exercise_effs()
    {
        return $this->hasMany("App\Models\ExerciseEff");
    }
}
