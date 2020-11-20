<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    public function training_plans()
    {
        return $this->belongsToMany('App\Models\TrainingPlan', 'training_plan_trainings');
    }

    public function exercises()
    {
        return $this->belongsToMany('App\Models\Exercise', 'training_exercises');
    }
}
