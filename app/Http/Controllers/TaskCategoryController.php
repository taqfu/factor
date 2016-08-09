<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TaskCategory;
use Auth;
class TaskCategoryController extends Controller
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
            return back()->withErrors("You must be logged in to do this.");
        }
        $this->validate($request, [
            'newTaskTypeID' => 'required|integer',
            'newTaskCategoryTypeID' => 'required|integer',
        ]);
        if (count(TaskCategory::where('task_type_id', $request->newTaskTypeID)
          ->where('task_category_type_id', $request->newTaskCategoryTypeID)
          ->get())>0){
            return back()->withErrors("This task category type already exists.");
        }

        $task_category = new TaskCategory;
        $task_category->task_type_id  =  $request->newTaskTypeID;
        $task_category->task_category_type_id = $request->newTaskCategoryTypeID;
        $task_category->user_id = Auth::user()->id;
        $task_category->save();
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
        if (Auth::guest()){
            return back()->withErrors("You must be logged in to do this.");
        }

        $task_category = TaskCategory::find($id);
        
        if ($task_category->user_id!=Auth::user()->id){
            return back()->withErrors("You are not authorized to do this.");
        }

        $task_category->delete();
        return back();
    }
}
