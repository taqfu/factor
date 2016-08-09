<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use Auth;
class TaskController extends Controller
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
    public function create()
    {
        //
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
            return "You must logged in in order to do this.";
        }
        $this->validate($request,[
            'timePeriodID'=>'required|integer',
            'typeID'=>'required|integer',
        ]);
        if (count(Task::where('time_period_id', $request->timePeriodID)
          ->where('user_id', Auth::user()->id)
          ->where('type_id', $request->typeID)->get())>0){
            return "Task already exists.";
        }
        $task = new Task;
        $task->time_period_id = $request->timePeriodID;
        $task->type_id = $request->typeID;
        $task->user_id = Auth::user()->id;
        $task->save();
        return "OK";
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
        if (Auth::guest()){
            return back()->withErrors("You must logged in in order to do this.");
        }
        $task = Task::find($id);
        if ($task->user_id != Auth::user()->id){
            return back()->withErrors("You are not authorized to do this.");
        }
        $task->delete();
        return redirect(redirect()->getUrlGenerator()->previous() . "#TP". $task->time_period_id);
    }
}
