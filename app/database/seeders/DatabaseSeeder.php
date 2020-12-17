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
                'comment' => 'Barre libre',
                'nbSerie' => 4,
                'repMin' => 8,
                'repMax' => 12,
                'pauseSerie' => 90,
                'pauseExercise' => 160
            ]),
            new Exercise([
                'name' => 'Kickback',
                'comment' => '',
                'nbSerie' => 5,
                'repMin' => 10,
                'repMax' => 12,
                'pauseSerie' => 60,
                'pauseExercise' => 120
            ]),
            new Exercise([
                'name' => 'Dips lestées',
                'comment' => '',
                'nbSerie' => 3,
                'repMin' => 8,
                'repMax' => 10,
                'pauseSerie' => 60,
                'pauseExercise' => 120
            ]),
        ]);
        $trainings[1]->exercises()->saveMany([
            new Exercise([
                'name' => 'Tirage vertical',
                'comment' => '',
                'nbSerie' => 5,
                'repMin' => 10,
                'repMax' => 15,
                'pauseSerie' => 60,
                'pauseExercise' => 120
            ]),
            new Exercise([
                'name' => 'Curl haltere',
                'comment' => 'no comment',
                'nbSerie' => 4,
                'repMin' => 10,
                'repMax' => 15,
                'pauseSerie' => 60,
                'pauseExercise' => 120
            ]),
            new Exercise([
                'name' => 'Curl barre',
                'comment' => 'no comment',
                'nbSerie' => 5,
                'repMin' => 10,
                'repMax' => 15,
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
                'exercise_id' => 4,
                'rating' => 10
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 5,
                'pause' => 0,
                'rating' => 0
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 6,
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
                'exercise_id' => 4,
                'rating' => 10
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 5,
                'pause' => 0,
                'rating' => 0
            ]),
            new ExerciseEff([
                'skipped' => false,
                'exercise_id' => 6,
                'pause' => 0,
                'rating' => 0
            ])
        ]);
        $ef = ExerciseEff::all();
        $ef[0]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 10,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 9,
                'weight' => 55,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 60,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 7,
                'weight' => 65,
                'pause' => 58
            ]),
        ]);

        $ef[1]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 15,
                'weight' => 10,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 13,
                'weight' => 12,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 13,
                'weight' => 12,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 15,
                'pause' => 58
            ]),
        ]);

        $ef[2]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 15,
                'weight' => 30,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 13,
                'weight' => 35,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 45,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 50,
                'pause' => 58
            ]),
        ]);

        $ef[3]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 15,
                'weight' => 50,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 13,
                'weight' => 55,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 60,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 65,
                'pause' => 58
            ]),
        ]);

        $ef[4]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 15,
                'weight' => 15,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 14,
                'weight' => 15,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 13,
                'weight' => 17,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 12,
                'weight' => 20,
                'pause' => 58
            ]),
        ]);

        $ef[5]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 12,
                'weight' => 15,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 15,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 17,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 20,
                'pause' => 58
            ]),
        ]);

        $ef[6]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 10,
                'weight' => 60,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 9,
                'weight' => 65,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 65,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 7,
                'weight' => 70,
                'pause' => 58
            ]),
        ]);

        $ef[7]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 15,
                'weight' => 15,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 13,
                'weight' => 15,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 13,
                'weight' => 17,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 17,
                'pause' => 58
            ]),
        ]);

        $ef[8]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 15,
                'weight' => 45,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 13,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 50,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 55,
                'pause' => 58
            ]),
        ]);

        $ef[9]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 15,
                'weight' => 55,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 13,
                'weight' => 60,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 65,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 70,
                'pause' => 58
            ]),
        ]);

        $ef[10]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 15,
                'weight' => 17,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 14,
                'weight' => 18,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 13,
                'weight' => 20,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 12,
                'weight' => 22,
                'pause' => 58
            ]),
        ]);

        $ef[11]->series_effs()->saveMany([
            new SeriesEff([
                'rep' => 12,
                'weight' => 20,
                'pause' => 60
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 22,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 10,
                'weight' => 22,
                'pause' => 58
            ]),
            new SeriesEff([
                'rep' => 8,
                'weight' => 25,
                'pause' => 58
            ]),
        ]);
    }
    
}
