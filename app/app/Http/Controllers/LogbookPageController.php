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

    public function getFromTrainingPlan($id){
        return response()->json(TrainingPlan::find($id)->logbook_pages()->get());
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
        $l->trainingPlan_id = $data['trainigPlan'];
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
