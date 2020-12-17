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
        $a = [];
        foreach (TrainingPlan::where('user_id', $request->user()->id)->with("logbook_pages.training_effs.exercise_effs.series_effs")->get() as $tp) {
            foreach ($tp['logbook_pages'] as $lbp) {
                foreach ($lbp['training_effs'] as $te) {
                    foreach ($te['exercise_effs'] as $ee) {
                        foreach ($ee['series_effs'] as $se) {
                            $a[] = $se;
                        }
                    }
                }
            }
        }
        return response()->json($a);
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
        $e->exercise_eff_id = $data['exercise_eff'];
        $e->save();
        return response()->json($e);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
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
    public function update(Request $request, int $id)
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
        $e->exercise_eff_id = $data['exercise_eff'];
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
        SeriesEff::destroy($id);
        return response()->json(['delete' => 'ok']);
    }
}
