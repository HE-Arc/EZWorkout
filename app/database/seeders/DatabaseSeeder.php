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
            new Exercise([
                'name' => 'Curl2',
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
        $lb->training_effs()->saveMany([
            new TrainingEff([
                'date' => '2020-12-02',
                'skipped' => false,
                'training_id' => 1
            ]),
            new TrainingEff([
                'date' => '2020-12-04',
                'skipped' => true,
                'training_id' => 2
            ])
        ]);

        $lb = new LogbookPage();
        $tp->logbook_pages()->save($lb);
        $lb->training_effs()->saveMany([
            new TrainingEff([
                'date' => '2020-12-02',
                'skipped' => false,
                'training_id' => 1
            ]),
            new TrainingEff([
                'date' => '2020-12-04',
                'skipped' => false,
                'training_id' => 2
            ])
        ]);

        $te = TrainingEff::all();
        $te[0]->exercise_effs()->saveMany([
            new ExerciseEff([
                'pause' => 30,
                'skipped' => false,
                'exercise_id' => 1,
                'rating' => 10
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 2,
                'pause' => 0,
                'rating' => 0
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 3,
                'pause' => 0,
                'rating' => 0
            ])
        ]);
        $te[1]->exercise_effs()->saveMany([
            new ExerciseEff([
                'pause' => 30,
                'skipped' => false,
                'exercise_id' => 1,
                'rating' => 10
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 2,
                'pause' => 0,
                'rating' => 0
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 3,
                'pause' => 0,
                'rating' => 0
            ])
        ]);
        $te[2]->exercise_effs()->saveMany([
            new ExerciseEff([
                'pause' => 30,
                'skipped' => false,
                'exercise_id' => 1,
                'rating' => 10
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 2,
                'pause' => 0,
                'rating' => 0
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 3,
                'pause' => 0,
                'rating' => 0
            ])
        ]);
        $te[3]->exercise_effs()->saveMany([
            new ExerciseEff([
                'pause' => 30,
                'skipped' => false,
                'exercise_id' => 1,
                'rating' => 10
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 2,
                'pause' => 0,
                'rating' => 0
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 3,
                'pause' => 0,
                'rating' => 0
            ])
        ]);
        $ef = ExerciseEff::all();
        $ef[0]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 8,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 14,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 7,
                'weight' => 50,
                'pause' => 58
            ]),
        ]);

        $ef[1]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 15,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 20,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 25,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 22,
                'weight' => 50,
                'pause' => 58
            ]),
        ]);

        $ef[2]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 5,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 6,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 7,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 50,
                'pause' => 58
            ]),
        ]);

        $ef[3]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 5,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 6,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 7,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 50,
                'pause' => 58
            ]),
        ]);

        $ef[4]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 5,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 6,
                'weight' => 30,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 7,
                'weight' => 30,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 30,
                'pause' => 58
            ]),
        ]);

        $ef[5]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 8,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 14,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 7,
                'weight' => 50,
                'pause' => 58
            ]),
        ]);

        $ef[6]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 15,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 20,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 25,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 22,
                'weight' => 50,
                'pause' => 58
            ]),
        ]);

        $ef[7]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 5,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 6,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 7,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 50,
                'pause' => 58
            ]),
        ]);

        $ef[8]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 5,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 6,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 7,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 50,
                'pause' => 58
            ]),
        ]);

        $ef[9]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 5,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 6,
                'weight' => 30,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 7,
                'weight' => 30,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 30,
                'pause' => 58
            ]),
        ]);
    }
    
}
