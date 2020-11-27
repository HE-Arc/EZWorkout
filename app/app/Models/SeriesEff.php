<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesEff extends Model
{
    use HasFactory;

    public function exercise_effs()
    {
        return $this->belongsTo('App\Models\ExerciseEff');
    }
}
