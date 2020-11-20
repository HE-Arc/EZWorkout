<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseEff extends Model
{
    use HasFactory;

    public function series_effs()
    {
        return $this->hasMany("App\Models\SeriesEff");
    }

    public function training_effs()
    {
        return $this->belongsTo('App\Models\TrainingEff');
    }

}
