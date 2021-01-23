<?php

namespace App\Http\Controllers;

use App\Models\LogbookPage;
use App\Models\Training;
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
        $a = [];
        foreach (TrainingPlan::where('user_id', $request->user()->id)->with("logbook_pages.training_effs")->get() as $tp) {
            foreach ($tp['logbook_pages'] as $lbp) {
                foreach ($lbp['training_effs'] as $te) {
                    $a[] = $te;
                }
            }
        }
        return response()->json($a);
    }

    /**
     * Get all effective trainings for the specified logbook page
     * 
     * @param int $id logbookPage id
     * @return \Illuminate\Http\Response
     */
    public function getFromLogbookPage(int $id){
        return response()->json(LogbookPage::find($id)->training_effs()->get());
    }

    /**
     * Get effective trainings for the specified training and logbookpage
     * 
     * @param int $idLBP logbookPage id
     * @param int $idTr training id
     * @return \Illuminate\Http\Response
     */
    public function getFromLogbookPageAndTraining(int $idLBP, int $idTr){
        return response()->json(TrainingEff::where('training_id', $idTr)->where('logbook_page_id', $idLBP)->get());
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
            'date' => 'Date',
            'skipped' => 'Boolean',
            'training' => 'integer|min:1'
        ]);
        $t = new TrainingEff();
        $t->date = $data['date'];
        $t->logbook_page_id = $data['logbookPage'];
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
    public function show(int $id)
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
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'logbookPage' => 'integer|min:1',
            'date' => 'Date',
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
    public function destroy(int $id)
    {
        TrainingEff::destroy($id);
        return response()->json(['delete' => 'ok']);
    }
}
