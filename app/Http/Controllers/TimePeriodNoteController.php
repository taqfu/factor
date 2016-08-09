<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TimePeriodNote;

class TimePeriodNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return View('TimePeriodNote.create', ['id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "newTimePeriodNote"=>"required|string|max:20000",
            "timePeriodID"=>"required|integer",
        ]);
        $time_period_note = new TimePeriodNote;
        $time_period_note->report = $request->newTimePeriodNote; 
        $time_period_note->time_period_id = $request->timePeriodID; 
        $time_period_note->save();
        return redirect(redirect()->getUrlGenerator()->previous() . "#TP". $request->timePeriodID);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $time_period_note = TimePeriodNote::find($id);
        $time_period_note->delete();
        return redirect(redirect()->getUrlGenerator()->previous() . "#TP". $time_period_note->time_period_id);
    }
}
