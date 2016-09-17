<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use App\TaskType;
use App\TaskCategory;
use Auth;
class TaskTypeController extends Controller
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
            return back()->withErrors("You must logged in in order to do this.");
        }
        $this->validate($request, [
            'newTaskName'=>'required|string'
        ]);
        if (count(TaskType::where('user_id', Auth::user()->id)
          ->where('name', $request->newTaskName)->get())>0){
            return back()->withErrors("Task type already exists.");
        }
        $task_type = new TaskType;
        $task_type->name = $request->newTaskName;
        $task_type->user_id = Auth::user()->id;
        $task_type->save();

        if ($request->defaultTaskCategoryType!="NULL"){
            $task_category = new TaskCategory;
            $task_category->task_category_type_id = $request->defaultTaskCategoryType;
            $task_category->user_id = Auth::user()->id;
            $task_category->task_type_id =  $task_type->id;
            $task_category->save();
        }
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task_type = TaskType::find($id);
        if ($task_type->user_id != Auth::user()->id){
            return back()->withErrors("You are not authorized to do this.");
        }
        
        return View('TaskType.show', [
            'task_type'=>$task_type,
            'tasks'=>Task::where('type_id', $id)->where('user_id', Auth::user()->id)->get(),
        ]);

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
        if (Auth::guest()){
            return back()->withErrors("You must logged in in order to do this.");
        }
        $this->validate($request, [
            "name"=>"required|string|max:255",
        ]);
        $task_type = TaskType::find($id);
        if ($task_type->user_id != Auth::user()->id){
            return back()->withErrors("You are not authorized to do this.");
        }
        $task_type->name = $request->name;
        $task_type->save();
        return back();
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
        $task_type = TaskType::find($id);
        if ($task_type->user_id != Auth::user()->id){
            return back()->withErrors("You are not authorized to do this.");
        }
        $task_type->delete();
        TaskCategory::where("task_type_id", $id)->where('user_id', Auth::user()->id)->delete();
        return back();
    }
}
