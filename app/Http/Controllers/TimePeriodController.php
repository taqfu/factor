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
    public function endOnStart($current_id, $previous_id){
        $current = TimePeriod::find($current_id);
        $previous = TimePeriod::find($previous_id);
        $current->end = $previous->start;
        $current->save();
    }
    public function indexDate($month, $day, $year){
      if (Auth::guest()){
          return redirect(route('root'))->withErrors("Please login before trying to do this.");
      }
      $date = "20" . $year . "-" . $month . "-" . $day;

      $begin = $date . " 00:00:00";
      $end = $date . " 23:59:59";
      $first_time_period_id =
        count ( TimePeriod::where("created_at", ">", $begin)
          ->where('user_id', Auth::user()->id)->where("created_at", "<", $end)
          ->orderBy("start", "desc")->get())>0
        ? TimePeriod::where("created_at", ">", $begin)
          ->where('user_id', Auth::user()->id)->where("created_at", "<", $end)
          ->orderBy("start", "desc")->first()->id
        : 0;
      return View::make('TimePeriod.index', [
          "first_time_period_id"=>$first_time_period_id,
          "period"=>'date',
          "person_types"=>PersonType::where('user_id', Auth::user()->id)
            ->whereNull('disabled_at')->orderBy('name', 'asc')->get(),
          "task_category_types" => TaskCategoryType::where("id", ">", 1)
            ->where('user_id', Auth::user()->id)->orderBy("name", "asc")->get(),

          "time_periods" => TimePeriod::where("created_at", ">", $begin)
            ->where('user_id', Auth::user()->id)->where("created_at", "<", $end)
            ->orderBy("start", "desc")->get(),
          "task_types" => TaskType::where('user_id', Auth::user()->id)
            ->orderBy("name", "asc")->get(),
      ]);
    }
    public function index(Request $request)
    {
        if (Auth::guest()){
            return redirect(route('root'))->withErrors("Please login before trying to do this.");
        }
        $period_data = TimePeriod::fetch_period($request->period);
        $time_periods = TimePeriod::where("created_at", ">", $period_data['begin'])
          ->where('user_id', Auth::user()->id)
          ->where("created_at", "<", $period_data['end'])
          ->orderBy("start", "desc")->get();
        $first_time_period_id =
          count ($time_periods)>0
          ? TimePeriod::where("created_at", ">", $period_data['begin'])
            ->where('user_id', Auth::user()->id)->where("created_at", "<", $period_data['end'])
            ->orderBy("start", "desc")->first()->id
          : 0;
        if (count($time_periods)==0){
            /* why is this here?
             *
            $time_periods = TimePeriod::where('end', '0000-00-00 00:00:00')
              ->orWhere("created_at", ">", $period_data['begin'])
              ->where('user_id', Auth::user()->id)
              ->where("created_at", "<", $period_data['end'])
              ->orderBy("start", "desc")->get();

             */

        }
        return View::make('TimePeriod.index', [
            "first_time_period_id"=>$first_time_period_id,
            "period"=>$period_data['name'],
            "person_types"=>PersonType::where('user_id', Auth::user()->id)
              ->whereNull('disabled_at')->orderBy('name', 'asc')->get(),
            "task_category_types" => TaskCategoryType::where("id", ">", 1)
              ->where('user_id', Auth::user()->id)->orderBy("name", "asc")->get(),
            "time_periods" => $time_periods,
            "task_types" => TaskType::where('user_id', Auth::user()->id)
              ->orderBy("name", "asc")->get(),
        ]);
    }
    public function selectDate(){
        $earliest_time_period = TimePeriod::where('user_id', Auth::user()->id)->whereNull('deleted_at')->orderBy('created_at', 'asc')->first();
        $last_time_period = TimePeriod::where('user_id', Auth::user()->id)->whereNull('deleted_at')->orderBy('created_at', 'desc')->first();
        return View('TimePeriod.date',[
            'earliest_time_period'=>$earliest_time_period,
            'last_time_period'=>$last_time_period,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("TimePeriod.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $open_time_period = TimePeriod::is_another_time_period_already_open();

        if (Auth::guest()){
            return back()->withErrors("Please login before trying to do this.");
        }
/*  disabled 09/04/16 because of an app breaking bug
    enabled on September 17, 2016 for testing purposes
    Don't forget line 173
*/
        if (TimePeriod::has_this_already_been_created()){
            return back()->withErrors("Time Period has already been created.");
        }

        if ($open_time_period){
            if ($open_time_period>1){
                $time_period = TimePeriod::find($open_time_period);
                $url = env('APP_URL') . "/time/month/" . date('m', strtotime($time_period->start))
                    . "/day/" . date('d', strtotime($time_period->start)) . "/year/" . date('y', strtotime($time_period->start))
                    . "#TP" . $open_time_period;
                return back()->withErrors("<a href='$url' class='text-danger text-link'>Another time period is already open. Click here to close that first.</a>");
            }
        }

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

        $time_period = TimePeriod::find($id);
        if (Auth::user()->id!=$time_period->user_id){
            return back()->withErrors('You are not authorized to do this.');
        }

        if ($time_period->end!=0){
            return back()->withErrors("Time period has already ended.");
        } else if ($request->when=="now"){
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
        $prev_time_period = TimePeriod::where('user_id', Auth::user()->id)
          ->whereNull('deleted_at')->where('id', '>', $id)
          ->orderBy('created_at', 'asc')->first();
        if (Auth::user()->id!=$time_period->user_id){
            return back()->withErrors('You are not authorized to do this.');
        }

        foreach (Task::where('time_period_id', $id)->get() as $task){
            $task->delete();
        }
        $time_period->delete();

        if ($prev_time_period==null){
            return redirect(redirect()->getUrlGenerator()->previous());
        }
        return redirect(redirect()->getUrlGenerator()->previous() . "#TP". $prev_time_period->id);
    }
}
