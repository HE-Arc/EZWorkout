<?php

namespace App\Http\Controllers;

use App\Models\ExerciseEff;
use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class ExerciseEffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(TrainingPlan::where('user_id', $request->user()->id)->with('logbookPages')->with('training_effs')->with('exercise_effs')->get());
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
            'training_eff' => 'integer|min:1',
            'pause'=> 'integer|min:0',
            'skipped' => 'Boolean',
            'exercise' => 'integer|min:1',
            'rating' => 'integer|min:1|max:5|nullable'
        ]);
        $e = new ExerciseEff();
        $e->training_eff_id = $data['training_eff'];
        $e->pause = $data['pause'];
        $e->skipped = $data['skipped'];
        $e->exercise_id = $data['exercise'];
        $e->rating = $data['rating'];
        $e->save();
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
        return response()->json(ExerciseEff::find($id));
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
            'training_eff' => 'integer|min:1',
            'pause'=> 'integer|min:0',
            'skipped' => 'Boolean',
            'exercise' => 'integer|min:1',
            'rating' => 'integer|min:1|max:5|nullable'
        ]);
        $e = ExerciseEff::find($id);
        $e->training_eff_id = $data['training_eff'];
        $e->pause = $data['pause'];
        $e->skipped = $data['skipped'];
        $e->exercise_id = $data['exercise'];
        $e->rating = $data['rating'];
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
        ExerciseEff::destroy($id);
        return response()->json(['delete' => 'ok']);
    }
}
