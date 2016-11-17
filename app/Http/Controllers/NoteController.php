<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Note;
use App\Task;
use Auth;

class NoteController extends Controller
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
    public function create($task_id, $time_period_id)
    {
        return View('Note.create', ['task_id'=>$task_id, 'time_period_id'=>$time_period_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        if (Auth::guest()){
            return back()->withErrors("You must be logged in to do this.");
        }
        
        $this->validate($request, [
            "taskID"=>"required|integer",
            "timePeriodID"=>"required|integer",
            "report"=>"required|string|max:20000",
        ]);
        if (count(Note::where('user_id', Auth::user()->id)->where('task_id', $request->taskID)
          ->where('time_period_id', $request->timePeriodID)->where('report', $request->report)
          ->get())>0){
            return back()->withErrors("This note has already been created.");
        }
        $note = new Note;
        $note->task_id = $request->taskID;
        $note->time_period_id = $request->timePeriodID;
        $note->report = $request->report;
        $note->user_id = Auth::user()->id;
        $note->save();
        if ($request->taskID>0){
            $task = Task::find($request->taskID);
            $time_period_id = $task->time_period_id;
        } else if ($request->timePeriodID>0){
            $time_period_id = $request->timePeriodID;
        }
        return redirect(redirect()->getUrlGenerator()->previous() . "#TP". $time_period_id);
        
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
        $this->validate($request, [
            'newReport'=>'required|string|max:20000',
        ]);
        $note = Note::find($id);

        if ($note->user_id != Auth::user()->id){
            return back()->withErrors("You are not authorized to do this.");
        }

        $note->report = trim($request->newReport);
        $note->save();

        if ($note->task_id>0){
            $task = Task::find($note->task_id);
            $time_period_id = $task->time_period_id;
        } else if ($note->time_period_id>0){
            $time_period_id = $note->time_period_id;
        }
        return redirect(redirect()->getUrlGenerator()->previous() . "#TP". $time_period_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::guest()){
            return back()->withErrors("You must be logged in to do this.");
        }

        $note = Note::find($id);    

        if ($note->user_id != Auth::user()->id){
            return back()->withErrors("You are not authorized to do this.");
        }

        $note->delete();
        if ($note->time_period_id>0){
            return redirect(redirect()->getUrlGenerator()->previous() 
              . "#TP". $note->time_period_id);
        } else if ($note->task_id>0){
            $task=Task::find($note->task_id);
            return redirect(redirect()->getUrlGenerator()->previous() 
              . "#TP". $task->time_period_id);
        }
    }
}
