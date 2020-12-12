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
     * Return a training plan containing all objects (effective data)
     * 
     * @param int $id
     * @return Response
     */
    public function getAllEffectiveInTrainingPlan($id){

        $tp = TrainingPlan::with("logbook_pages.training_effs.exercise_effs.series_effs")->get();

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
