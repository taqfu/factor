<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TaskType;
use App\TaskCategory;
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
        $this->validate($request, [
            'newTaskName'=>'required|unique:task_types,name',
        ]);
        $task_type = new TaskType;
        $task_type->name = $request->newTaskName;
        $task_type->save();

        $task_category = new TaskCategory;
        $task_category->task_category_type_id = 1;
        $task_category->task_type_id =  $task_type->id;
        $task_category->save();

        if ($request->defaultTaskCategoryType!="NULL"){
            $task_category = new TaskCategory;
            $task_category->task_category_type_id = 
              $request->defaultTaskCategoryType;
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
        TaskType::find($id)->delete();
        TaskCategory::where("task_type_id", $id)->delete();
        return back();
    }
}
