<?php

namespace App\Http\Controllers;

use App\Models\ExerciseEff;
use App\Models\TrainingEff;
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
        $tps = TrainingPlan::where('user_id', $request->user()->id)->with("logbook_pages.training_effs.exercise_effs")->get();
        $a = [];
        //used to avoid n to the power of 4 request to db
        foreach($tps as $tp){ 
            foreach ($tp['logbook_pages'] as $lbp) {
                foreach ($lbp['training_effs'] as $te) {
                    foreach ($te['exercise_effs'] as $ee) {
                        $a[] = $ee;
                    }
                }
            }
        }
        return response()->json($a);
    }

    /**
     * Get all effective exercises for the specified effective training
     * 
     * @param int $id trainingEff id
     * @return \Illuminate\Http\Response
     */
    public function getFromTrainingEff(int $id){
        return response()->json(TrainingEff::find($id)->exercise_effs()->get());
    }


    /**
     * Get effective exercise for the specified exercise and effective training
     * 
     * @param int $idETr effective training id
     * @param int $idEx exercise id
     * @return \Illuminate\Http\Response
     */
    public function getFromLogbookPageAndTraining(int $idETr, int $idEx){
        return response()->json(ExerciseEff::where('training_eff_id', $idETr)->where('exercise_id', $idEx)->get());
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
            'pause' => 'integer|min:0',
            'skipped' => 'Boolean',
            'exercise' => 'integer|min:1',
            'rating' => 'integer|min:1|max:10|nullable'
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
    public function show(int $id)
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
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'training_eff' => 'integer|min:1',
            'pause' => 'integer|min:0',
            'skipped' => 'Boolean',
            'exercise' => 'integer|min:1',
            'rating' => 'integer|min:1|max:10|nullable'
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
    public function destroy(int $id)
    {
        ExerciseEff::destroy($id);
        return response()->json(['delete' => 'ok']);
    }
}
