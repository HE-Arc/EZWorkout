<?php

namespace App\Http\Controllers;

use App\Models\LogbookPage;
use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class LogbookPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $a = [];
        foreach(TrainingPlan::where('user_id', $request->user()->id)->with('logbook_pages')->get() as $tp){
            foreach($tp['logbook_pages'] as $lbp){
                $a[] = $lbp;
            }
        }
        return response()->json($a);
    }

    /**
     * Get all logbook pages for the specified training plan
     * 
     * @param int $id trainingPlan id
     * @return \Illuminate\Http\Response
     */
    public function getFromTrainingPlan(int $id){
        return response()->json(TrainingPlan::find($id)->logbook_pages()->get());
    }

    /**
     * return true if the logbookpage is completed
     */
    public function full(int $id){
        $lbp = null;
        foreach(LogbookPage::with("training_effs.exercise_effs.series_effs")->get() as $l){
            if($l->id==$id){
                $lbp = $l;
            }
        }
        $tp = null;
        foreach(TrainingPlan::with("trainings.exercises")->get() as $t){
            if($t->id==$lbp->training_plan_id){
                $tp = $t;
            }
        }


        if(sizeof($lbp->training_effs)!=sizeof($tp->trainings)){
            return response()->json(['delete' => 'false']);
        }else{
            foreach($tp->trainings as $tr){
                foreach($lbp->training_effs as $etr){
                    if($tr->id==$etr->training_id && $etr->skipped==false){
                        if(sizeof($tr->exercises)>sizeof($etr->exercise_effs)){
                            return response()->json(['delete' => 'false']);
                        }else{
                            foreach($tr->exercises as $ex){
                                foreach($etr->exercise_effs as $eex){
                                    if($ex->id == $eex->exercise_id && $eex->skipped==false){
                                        if($ex->nb_serie>sizeof($eex->series_effs)){
                                            return response()->json(['delete' => 'false']);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return response()->json(['delete' => 'true']);
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
            'trainigPlan' => 'integer|min:1'
        ]);
        $l = new LogbookPage();
        $l->training_plan_id = $data['trainigPlan'];
        $l->save();
        return response()->json($l);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response()->json(LogbookPage::find($id));
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
        $l = LogbookPage::find($id);
        $l->save();
        return response()->json($l);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        LogbookPage::destroy($id);
        return response()->json(['delete' => 'ok']);
    }
}
