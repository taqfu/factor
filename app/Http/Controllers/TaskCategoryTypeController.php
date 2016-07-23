<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TaskCategoryType;
use App\TaskCategory;
use App\TaskType;
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
        $this->validate($request, [
            'newTaskCategoryTypeName'=>'required|unique:task_category_types,name',
        ]);
        $task_category_type = new TaskCategoryType;
        $task_category_type->name = $request->newTaskCategoryTypeName;
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
        return View::make('TaskCategory.show', [
        "task_types"=>TaskType::join('task_categories', 'task_type_id', '=', 
          'task_types.id')->where('task_categories.task_category_type_id', $id)
          ->whereNull('task_categories.deleted_at')->orderBy('task_types.name', 
          'asc')->get(),
        "task_category_types" => TaskCategoryType::where("id", ">", 1)->orderBy("name", "asc")->get(),
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
        TaskCategoryType:: find($id)->delete();
        return back();
    }
}
