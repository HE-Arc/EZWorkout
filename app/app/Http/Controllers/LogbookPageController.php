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
        $a = array();
        foreach(TrainingPlan::where('user_id', $request->user()->id)->get() as $tp){
            foreach($tp->logbook_pages()->get() as $lbp){
                $a[] = $lbp;
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
    public function show($id)
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
    public function update(Request $request, $id)
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
    public function destroy($id)
    {
        LogbookPage::destroy($id);
        return response()->json(['delete' => 'ok']);
    }
}
