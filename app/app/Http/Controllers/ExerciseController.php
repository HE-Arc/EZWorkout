<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Training;
use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $a = TrainingPlan::where('user_id', $request->user()->id)->with("trainings.exercises")->get();

        $final  = [];
        $ids = [];

        //used to avoid n cube request on db
        foreach ($a as $tp) {
            foreach ($tp['trainings'] as $t) {
                foreach ($t['exercises'] as $current) {
                    if (!in_array($current->id, $ids)) {
                        $final[] = $current;
                        $ids[] = $current->id;
                    }
                }
            }
        }


        return response()->json($final);
    }

    /**
     * Return exercises that are part of a training
     * 
     * @param int $id
     * @return Response
     */
    public function getFromTraining(int $id)
    {
        return response()->json(Training::find($id)->exercises()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string',
            'comment' => 'string',
            'nbSerie' => 'integer|min:1',
            'repMin' => 'integer|min:1',
            'repMax' => 'integer|min:1',
            'pauseSerie' => 'integer|min:0',
            'pauseExercise' => 'integer|min:0',
            'training' => 'integer|min:1'
        ]);
        $t = Training::find($data['training']);
        $e = new Exercise();
        $e->name = $data['name'];
        $e->comment = $data['comment'];
        $e->nbSerie = $data['nbSerie'];
        $e->repMin = $data['repMin'];
        $e->repMax = $data['repMax'];
        $e->pauseSerie = $data['pauseSerie'];
        $e->pauseExercise = $data['pauseExercise'];
        $t->exercises()->save($e);
        return response()->json($e);
    }

    /**
     * attach exercise to training
     */
    public function attach(Request $request, int $id)
    {
        $data = $request->validate([
            'training' => 'integer|min:1'
        ]);
        $p = Training::find($data['training']);
        $p->exercises()->attach($id);
    }

    /**
     * detach exercise from training
     */
    public function detach(Request $request, int $id)
    {
        $data = $request->validate([
            'training' => 'integer|min:1'
        ]);
        $p = Training::find($data['training']);
        $p->exercises()->detach($id);
    }

    /**
     * detach exercise from all training
     */
    public function detachAll(int $id)
    {
        $p = Exercise::find($id);
        $p->trainings()->detach();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response()->json(Exercise::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'string',
            'comment' => 'string',
            'nbSerie' => 'integer|min:1',
            'repMin' => 'integer|min:1',
            'repMax' => 'integer|min:1',
            'pauseSerie' => 'integer|min:0',
            'pauseExercise' => 'integer|min:0'
        ]);
        $e = Exercise::find($id);
        $e->name = $data['name'];
        $e->comment = $data['comment'];
        $e->nbSerie = $data['nbSerie'];
        $e->repMin = $data['repMin'];
        $e->repMax = $data['repMax'];
        $e->pauseSerie = $data['pauseSerie'];
        $e->pauseExercise = $data['pauseExercise'];
        $e->save();
        return response()->json($e);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Exercise::destroy($id);
        return response()->json(['delete' => 'ok']);
    }
}
