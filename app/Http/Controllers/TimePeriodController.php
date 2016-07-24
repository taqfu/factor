<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TaskCategoryType;
use App\TaskType;
use App\TimePeriod;
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
        $period=$request->period;
        switch($request->period){
            case "all":
                $begin = TimePeriod::orderBy('created_at', 'asc')
                  ->first()->created_at;
                $end = date("Y-m-d") . " 23:59:59";
                break;
            case "yesterday":
                $begin = date("Y-m-d", strtotime("-1 days")) . " 00:00:00";
                $end = date("Y-m-d", strtotime("-1 days")) . " 23:59:59";
                break;
            case "week":
                $begin = date("Y-m-d", strtotime("-1 weeks")) . " 00:00:00";
                $end = date("Y-m-d") . " 23:59:59";
                break;
            default:
                $period="today";
                $begin = date("Y-m-d") . " 00:00:00";
                $end = date("Y-m-d") . " 23:59:59";
                break;
        }
        return View::make('time', [
            'period'=>$period,
            "time_periods" => TimePeriod::where("created_at", ">", $begin)
              ->where("created_at", "<", $end)->orderBy("start", "desc")->get(),
            "task_types" => TaskType::orderBy("name", "asc")->get(),
            "task_category_types" => TaskCategoryType::where("id", ">", 1)
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
        $time_period->save();

        if ($request->endWhen=="now"){
            TimePeriod::new_now();
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
        $time_period = TimePeriod::find($id);
        if ($request->when=="now"){
            $time_period->end = date('Y-m-d H:i:s');
        } else if ($request->when=="timestamp"){
            $time_period->end =  $request->newEndYear . "-" . $request->newEndMonth 
              . "-" . $request->newEndDay . " " . $request->newEndHour . ":" 
              . $request->newEndMinute . ":00";
            
        }
        if (TimePeriod::interval($time_period->start, $time_period->end)<0){
            return back()->withErrors('TimePeriod can not end before it has begun.');
        }
        $time_period->save();
        TimePeriod::new_now();
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
        TimePeriod::find($id)->delete();
        return back();
    }
}
