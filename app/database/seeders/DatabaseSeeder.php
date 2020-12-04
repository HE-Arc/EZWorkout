<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\ExerciseEff;
use App\Models\LogbookPage;
use App\Models\SeriesEff;
use App\Models\TrainingPlan;
use App\Models\Training;
use App\Models\TrainingEff;
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
        $lb = new LogbookPage();
        $tp->logbook_pages()->save($lb);
        $lb->trainingEffs()->saveMany([
            new TrainingEff([
                'date' => '12-02-2020',
                'skipped' => false,
                'training_id' => 1
            ]),
            new TrainingEff([
                'date' => '14-02-2020',
                'skipped' => true,
                'training_id' => 2
            ])
        ]);
        $te = TrainingEff::all();
        $te[0]->exerciseEffs()->saveMany([
            new ExerciseEff([
                'pause' => 30,
                'skipped' => false,
                'exercice_id' => 0,
                'rating' => 10
            ]),
            new ExerciseEff([
                'skipped' => true,
                'exercice_id' => 1,
            ])
        ]);
        $ef = ExerciseEff::all();
        $ef[0]->seriesEffs()->saveMany([
            new SeriesEff([
                'rep' => 8,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 500,
                'pause' => 58
            ])
        ]);
    }
    
}
