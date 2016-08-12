<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TaskCategoryType;
use App\TaskCategory;
use App\TaskType;
use Auth;
use View;
class TaskCategoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            return back()->withErrors("You must be logged in to do this.");
        }
        $this->validate($request, [
            'newTaskCategoryTypeName'=>'required|string',
        ]);
        if (count(TaskCategoryTime::where('user_id', Auth::user()->id)
          ->where('name', $request->newTaskCategoryTypeName)->get())>0){
            return back()->withErrors("This Task Category Type already exists.");
        }
        $task_category_type = new TaskCategoryType;
        $task_category_type->name = $request->newTaskCategoryTypeName;
        $task_category_type->user_id = Auth::user()->id;
        $task_category_type->save();
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
        if (Auth::guest()){
            return back()->withErrors("You need to be logged in to do this.");
        }
        if(Auth::user()->id != TaskCategoryType::find($id)->user_id){
            return back()->withErrors("You are not authorized to view this.");
        }
        $task_types = TaskType::join('task_categories', 'task_types.id', '=', 'task_categories.task_type_id')->where('task_categories.task_category_type_id', $id)->get();
        return View('TaskCategoryType.show', [
            'task_category_type'=>TaskCategoryType::find($id),
            'task_types'=>$task_types,
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
            return back()->withErrors("You must be logged in to do this.");
        }
        $task_category_type = TaskCategoryType:: find($id);
        
        if ($task_category_type->user_id != Auth::user()->id){
            return back()->withErrors("You are not authorized to do this.");
        }
        $task_category_type->delete();
        return back();
    }
}
