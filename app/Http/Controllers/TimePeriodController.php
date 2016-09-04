<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PersonType;
use App\Task;
use App\TaskCategoryType;
use App\TaskType;
use App\TimePeriod;
use Auth;
use DB;
use View;
class TimePeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::guest()){
            return redirect(route('root'))->withErrors("Please login before trying to do this.");
        }
        $period_data = TimePeriod::fetch_period($request->period);
        $first_time_period_id = 
          count ( TimePeriod::where("created_at", ">", $period_data['begin'])
            ->where('user_id', Auth::user()->id)->where("created_at", "<", $period_data['end'])
            ->orderBy("start", "desc")->get())>0
          ? TimePeriod::where("created_at", ">", $period_data['begin'])
            ->where('user_id', Auth::user()->id)->where("created_at", "<", $period_data['end'])
            ->orderBy("start", "desc")->first()->id
          : 0;
        return View::make('time', [
            "first_time_period_id"=>$first_time_period_id,
            "period"=>$period_data['name'],
            "person_types"=>PersonType::where('user_id', Auth::user()->id)
              ->whereNull('disabled_at')->orderBy('name', 'asc')->get(),
            "task_category_types" => TaskCategoryType::where("id", ">", 1)
              ->where('user_id', Auth::user()->id)->orderBy("name", "asc")->get(),
            "time_periods" => TimePeriod::where("created_at", ">", $period_data['begin'])
              ->where('user_id', Auth::user()->id)->where("created_at", "<", $period_data['end'])
              ->orderBy("start", "desc")->get(),
            "task_types" => TaskType::where('user_id', Auth::user()->id)
              ->orderBy("name", "asc")->get(),
        ]);
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
            return back()->withErrors("Please login before trying to do this.");
        }
/* disabled 09/04/16 because of an app breaking bug
        if (TimePeriod::is_there_one_already()){
            return back()->withErrors("Time Period has already been created.");
        }
*/
        $startGuess = false;
        $endGuess = false;
        if ($request->startWhen==="now"){
            $start = date('Y-m-d H:i:s');
        }  else if ($request->startWhen==="unspecific"){
            $start = 0;
        } else if ($request->startWhen==="timestamp"){
            $start = $request->startYear . "-" . $request->startMonth . "-" 
              . $request->startDay . " " . $request->startHour . ":" 
              . $request->startMinute . ":00"; 
            $startGuess = $request->startGuess==="on";
        }

        if ($request->endWhen==="now"){
            $end = date('Y-m-d H:i:s');
        } else if ($request->endWhen==="unspecific"){
            $end = 0;
        } else if ($request->endWhen==="timestamp"){
            $end = $request->endYear . "-" . $request->endMonth . "-" 
              . $request->endDay . " " . $request->endHour . ":" 
              . $request->endMinute . ":00"; 
            $endGuess = $request->endGuess==="on";
        }
        $time_period = new TimePeriod;
        $time_period->start = $start;
        $time_period->startGuess = $startGuess; 
        $time_period->end = $end;
        $time_period->endGuess = $endGuess; 
        $time_period->user_id = Auth::user()->id;
        $time_period->save();

        if ($request->endWhen=="now"){
            TimePeriod::new_now();
        }
        return redirect(redirect()->getUrlGenerator()->previous());
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
            return back()->withErrors("You must be logged in to do this.");
        }
        $time_period = TimePeriod::find($id);
        if (Auth::user()->id != $time_period->user_id){
            return back()->withErrors("You are not authorized to do this.");
        }
        return View('TimePeriod.show', [
           'time_period'=>$time_period, 
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

    public function resume($id){
        if (Auth::guest()){
            return back()->withErrors("Please login before trying to do this.");
        }
        $time_period = TimePeriod::find($id);

        if (Auth::user()->id!=$time_period->user_id){
            return back()->withErrors('You are not authorized to do this.');
        }
        $time_period->end = 0;
        $time_period->save();
        return redirect(redirect()->getUrlGenerator()->previous());
        
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
            return back()->withErrors("Please login before trying to do this.");
        }
        if (TimePeriod::is_there_one_already()){
            return back()->withErrors("Time Period has already been created.");
        }

        $time_period = TimePeriod::find($id);

        if (Auth::user()->id!=$time_period->user_id){
            return back()->withErrors('You are not authorized to do this.');
        }

        if ($request->when=="now"){
            $time_period->end = date('Y-m-d H:i:s');
            TimePeriod::new_now();
        } else if ($request->when=="timestamp"){
            $timestamp =  $request->newEndYear . "-" . $request->newEndMonth 
              . "-" . $request->newEndDay . " " . $request->newEndHour . ":" 
              . $request->newEndMinute . ":00";

            $time_period->end = $timestamp;
            $another_time_period = new TimePeriod;
            $another_time_period->start = $timestamp;
            $another_time_period->end = 0;
            $another_time_period->user_id=Auth::user()->id;
            $another_time_period->save();
            
        }
        if (TimePeriod::interval($time_period->start, $time_period->end)<0){
            return back()->withErrors('TimePeriod can not end before it has begun.');
        }
        $time_period->save();
        return redirect(redirect()->getUrlGenerator()->previous());
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
            return back()->withErrors("Please login before trying to do this.");
        }

        $time_period = TimePeriod::find($id);

        if (Auth::user()->id!=$time_period->user_id){
            return back()->withErrors('You are not authorized to do this.');
        }
        foreach (Task::where('time_period_id', $id)->get() as $task){
            $task->delete();
        }
        $time_period->delete();
        
        return redirect(redirect()->getUrlGenerator()->previous());
    }
}
