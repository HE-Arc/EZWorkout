<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\TrainingPlan;
use App\Models\Training;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //training plan
        $tp = new TrainingPlan([
            'name' => 'Cycle de force',
            'user_id' => 1
        ]);
        $tp->save();

        $tp->find(1)->trainings()->saveMany([
            new Training(['name' => 'Pec - triceps']),
            new Training(['name' => 'Dos - Biceps'])
        ]);

        $trainings = Training::all();
        $trainings[0]->exercises()->saveMany([
            new Exercise([
                'name' => 'Developpé couché',
                'comment' => 'On s\'en fout mec',
                'nbSerie' => 1,
                'repMin' => 8,
                'repMax' => 12,
                'pauseSerie' => 60,
                'pauseExercise' => 120
            ]),
            new Exercise([
                'name' => 'Kickback',
                'comment' => 'On s\'en fout',
                'nbSerie' => 1,
                'repMin' => 8,
                'repMax' => 12,
                'pauseSerie' => 60,
                'pauseExercise' => 120
            ]),
        ]);
        $trainings[1]->exercises()->saveMany([
            new Exercise([
                'name' => 'Tirage vertical',
                'comment' => 'OSEF',
                'nbSerie' => 1,
                'repMin' => 8,
                'repMax' => 12,
                'pauseSerie' => 60,
                'pauseExercise' => 120
            ]),
            new Exercise([
                'name' => 'Curl',
                'comment' => 'On s\'en fout',
                'nbSerie' => 1,
                'repMin' => 8,
                'repMax' => 12,
                'pauseSerie' => 60,
                'pauseExercise' => 120
            ]),
        ]);
    }
    
}
