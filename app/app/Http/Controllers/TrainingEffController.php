<?php

namespace App\Http\Controllers;

use App\Models\TrainingEff;
use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class TrainingEffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(TrainingPlan::where('user_id', $request->user()->id)->with('logbookPages')->with('training_effs')->get());
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
            'logbookPage' => 'integer|min:1',
            'date'=> 'Date',
            'skipped' => 'Boolean',
            'training' => 'integer|min:1'
        ]);
        $t = new TrainingEff();
        $t->date = $data['date'];
        $t->logbookPage_id = $data['logbookPage'];
        $t->skipped = $data['skipped'];
        $t->training_id = $data['training'];
        $t->save();
        return response()->json($t);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(TrainingEff::find($id));
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
            'logbookPage' => 'integer|min:1',
            'date'=> 'Date',
            'skipped' => 'Boolean',
            'training' => 'integer|min:1'
        ]);
        $t = TrainingEff::find($id);
        $t->date = $data['date'];
        $t->logbookPage_id = $data['logbookPage'];
        $t->skipped = $data['skipped'];
        $t->training_id = $data['training'];
        $t->save();
        return response()->json($t);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TrainingEff::destroy($id);
        return response()->json(['delete' => 'ok']);
    }
}
