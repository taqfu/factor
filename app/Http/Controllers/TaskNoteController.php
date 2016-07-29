<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use App\TaskNote;

class TaskNoteController extends Controller
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
        return View('TaskNote.create', ['id'=>$id]);
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
            "newTaskNote"=>"required|string|max:20000",
            "taskID"=>"required|integer",
        ]);
        $task_note = new TaskNote;
        $task_note->report = $request->newTaskNote;
        $task_note->task_id = $request->taskID;
        $task_note->save();
        $task = Task::find($request->taskID);
        return redirect(redirect()->getUrlGenerator()->previous() . "#TP". $task->time_period_id);
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
        $task_note = TaskNote::find($id);
        $task = Task::find($task_note->task_id);
        $task_note->delete();
        return redirect(redirect()->getUrlGenerator()->previous() . "#TP". $task->time_period_id);
    }
}
