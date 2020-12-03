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
        return response()->json(TrainingPlan::where('user_id', $request->user()->id)->with('trainings')->with('exercice')->get());
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
            'pauseExercice' => 'integer|min:0',
            'trainig' => 'integer|min:1'
        ]);
        $t = Training::find($data['training']);
        $e = new Exercise();
        $e->name = $data['name'];
        $e->comment = $data['comment'];
        $e->nbSerie = $data['nbSerie'];
        $e->repMin = $data['repMin'];
        $e->repMax = $data['repMax'];
        $e->pauseSerie = $data['pauseSerie'];
        $e->pauseExercice = $data['pauseExercice'];
        $t->exercises()->save($e);
        return response()->json($e);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string',
            'comment' => 'string',
            'nbSerie' => 'integer|min:1',
            'repMin' => 'integer|min:1',
            'repMax' => 'integer|min:1',
            'pauseSerie' => 'integer|min:0',
            'pauseExercice' => 'integer|min:0'
        ]);
        $e = Exercise::find($id);
        $e->name = $data['name'];
        $e->comment = $data['comment'];
        $e->nbSerie = $data['nbSerie'];
        $e->repMin = $data['repMin'];
        $e->repMax = $data['repMax'];
        $e->pauseSerie = $data['pauseSerie'];
        $e->pauseExercice = $data['pauseExercice'];
        $e->save();
        return response()->json($e);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Exercise::destroy($id);
        return response()->json(['delete' => 'ok']);
    }
}
