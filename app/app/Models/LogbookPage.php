<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogbookPage extends Model
{
    use HasFactory;

    public function training_plans()
    {
        return $this->belongsTo('App\Models\TrainingPlan');
    }
}
