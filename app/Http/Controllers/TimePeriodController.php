<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TimePeriod;

class TimePeriodController extends Controller
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
        $time_period = new TimePeriod;
        $startGuess = false;
        $endGuess = false;
        if ($request->startWhen==="now"){
            $start = date('Y-m-d H:i:s');
        }  else if ($request->startWhen==="unspecific"){
            $start = 0;
        } else if ($request->startWhen==="timestamp"){
            $start = $request->startYear . "-" . $request->startMonth . "-" . $request->startDay . " " . $request->startHour . ":" . $request->startMinute . ":00"; 
            $startGuess = $request->startGuess==="on";
        }

        if ($request->endWhen==="now"){
            $end = date('Y-m-d H:i:s');
        } else if ($request->endWhen==="unspecific"){
            $end = 0;
        } else if ($request->endWhen==="timestamp"){
            $end = $request->endYear . "-" . $request->endMonth . "-" . $request->endDay . " " . $request->endHour . ":" . $request->endMinute . ":00"; 
            $endGuess = $request->endGuess==="on";
        }
        $time_period->start = $start;
        $time_period->startGuess = $startGuess; 
        $time_period->end = $end;
        $time_period->endGuess = $endGuess; 
        $time_period->save();
       
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
            $time_period->save();
        } else if ($request->when=="timestamp"){
            $time_period->end =  $request->newEndYear . "-" . $request->newEndMonth . "-" . $request->newEndDay 
              . " " . $request->newEndHour . ":" . $request->newEndMinute . ":00";
            $time_period->save();
        }
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
        TimePeriod::where("id", $id)->delete();
        return back();
        //
    }
}
