<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Person;
use App\PersonType;
use App\Task;
class PersonController extends Controller
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
        return View('Person.create',[
            'person_types'=>PersonType::where('user_id', Auth::user()->id)->get(),
            'task_id'=>$task_id,
            'time_period_id'=>$time_period_id,
        ]);
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
            "timePeriodID"=>"required|integer",
            "taskID"=>"required|integer",
            "personTypeID"=>"required|integer",
        ]); 
        if (count(Person::where('user_id', Auth::user()->id)->where('task_id', $request->taskID)
          ->where('time_period_id', $request->timePeriodID)
          ->where('person_type_id', $request->personTypeID)->get())>0){
            return back()->withErrors("This person has already been tagged.");
        }
        $person = new Person;
        $person->user_id = Auth::user()->id; 
        $person->task_id = $request->taskID;
        $person->time_period_id = $request->timePeriodID;
        $person->person_type_id = $request->personTypeID;
        $person->save();
        if ($request->timePeriodID>0){
            $time_period_id = $request->timePeriodID;
        } else {
            $task = Task::find($request->taskID);
            $time_period_id = $task->time_period_id;
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
        //
    }
}
