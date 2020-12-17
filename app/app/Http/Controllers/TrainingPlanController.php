<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class TrainingPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(TrainingPlan::where('user_id', $request->user()->id)->get());
    }

    /**
     * Return all effective data and template for a given training plan
     * 
     * @param int $id
     * @return Response
     */
    public function getResultData($id){

        $trainingPlanEffective = TrainingPlan::with("logbook_pages.training_effs.exercise_effs.series_effs")->get();
        $trainingPlanTemplate = TrainingPlan::with("trainings.exercises")->get();

        $templateNames = [];
        $tabData = [];
        $tabHeader = [];
        
        foreach ($trainingPlanTemplate as $tpTemplate)
        {
            if ($tpTemplate->id == $id)
            {
                foreach ($tpTemplate->trainings as $training)
                {
                    foreach ( $training->exercises as $exo)
                    {
                        //Fill the templateNames dictionary
                        $templateNames[$exo->id] = $exo->name;
                    }
                }
            }
        }


        foreach ($trainingPlanEffective as $tp)
        {
            if ($tp->id == $id)
            {
                $pageIndex = 0;
                $tabHeader[0][0] = 0;
                foreach ($tp->logbook_pages as $logPage)
                {
                    $exoIndex = 0;
                    foreach ($logPage->training_effs as $trainingEff)
                    {
                        
                        foreach ($trainingEff->exercise_effs as $exoEff)
                        {
                            //put the name of the exercise on first cell for each row
                            $tabData[$exoIndex][0] = $templateNames[$exoEff->exercise_id];

                            $serieIndex = 0;
                            foreach ($exoEff->series_effs as $serie)
                            {
                                $tabData[$exoIndex][] = $serie;

                                $serieIndex++;
                            }
                            $exoIndex++;
                            if ($tabHeader[0][0] <  $serieIndex)//get the maximum number of series for one exercise
                            {
                                $tabHeader[0][0] = $serieIndex;
                            }
                        }
                    }
                    $tabHeader[1][] = $pageIndex+1;
                    $pageIndex++;
                }
                $dataOutput = [
                    "data" => $tabData,
                    "header" => $tabHeader
                ];
                return response()->json($dataOutput);
            }
        }
        return response()->json([]);
    }

    /**
     * Return a training plan containing all objects (template only)
     * 
     * @param int $id
     * @return Response
     */
    public function getAllTemplateInTrainingPlan($id){

        $tp = TrainingPlan::with("trainings.exercises")->get();

        foreach ($tp as $currentTp)
        {
            if ($currentTp->id == $id)
            {
                return response()->json($currentTp);
            }
        }
        return response()->json([]);
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
            'name' => 'string'
        ]);
        $t = new TrainingPlan();
        $t->name = $data['name'];
        $t->user_id = $request->user()->id;
        $t->save();
        return response()->json($t);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response()->json(TrainingPlan::find($id));
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
            'name' => 'string'
        ]);
        $t = TrainingPlan::find($id);
        $t->name = $data['name'];
        $t->save();
        return response()->json($t);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        TrainingPlan::destroy($id);
        return response()->json(['delete' => 'ok']);
    }
}
