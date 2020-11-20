<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPlan extends Model
{
    use HasFactory;
    
    public function logbook_pages()
    {
        return $this->hasMany('App\Models\LogbookPage');
    }

    public function trainings()
    {
        return $this->belongsToMany('App\Models\Training', 'training_plan_trainings');
    }
}
