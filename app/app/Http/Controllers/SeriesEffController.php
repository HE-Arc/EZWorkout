<?php

namespace App\Http\Controllers;

use App\Models\SeriesEff;
use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class SeriesEffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(TrainingPlan::where('user_id', $request->user()->id)->with('logbookPages')->with('training_effs')->with('exercise_effs')->with('serie_effs')->get());
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
            'rep' => 'integer|min:1',
            'weight'=> 'numeric|min:0.0',
            'pause' => 'integer|min:0',
            'exercise_eff' => 'integer|min:1',
        ]);
        $e = new SeriesEff();
        $e->rep = $data['rep'];
        $e->weight = $data['weight'];
        $e->pause = $data['pause'];
        $e->exercise_eff = $data['exercise_eff'];
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
        return response()->json(SeriesEff::find($id));
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
            'rep' => 'integer|min:1',
            'weight'=> 'numeric|min:0.0',
            'pause' => 'integer|min:0',
            'exercise_eff' => 'integer|min:1',
        ]);
        $e = SeriesEff::find($id);
        $e->rep = $data['rep'];
        $e->weight = $data['weight'];
        $e->pause = $data['pause'];
        $e->exercise_eff = $data['exercise_eff'];
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
        SeriesEff::destroy($id);
        return response()->json(['delete' => 'ok']);
    }
}
