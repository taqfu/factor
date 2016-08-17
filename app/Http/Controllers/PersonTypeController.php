<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Person;
use App\PersonType;
class PersonTypeController extends Controller
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
            "name"=>"required|string|max:255",
        ]);
        if (count(PersonType::where('name', $request->name)
          ->where('user_id', Auth::user()->id)->get())>0){       
            return back()->withErrors("Person already exists.");
        }
        $person_type = new PersonType;
        $person_type->name = $request->name;
        $person_type->user_id=Auth::user()->id;
        $person_type->save();
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
            return back()->withErrors("You must be logged in to do this.");
        }
        $person_type = PersonType::find($id);
        if ($person_type==null){
            return back()->withErrors("This is not a valid ID. Sorry.");
        }
        if ($person_type->user_id!=Auth::user()->id){
            return back()->withErrors("You are not authorized to do this.");
        }
        return View ('PersonType.show', [
            "person_type"=>$person_type,
            "people"=>Person::where("user_id", Auth::user()->id)
              ->where('person_type_id', $id)->get(),
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
        $person_type = PersonType::find($id);
        if ($person_type->user_id != Auth::user()->id){
            return back()->withErrors("You are not authorized to do this.");
        }
        $person_type->name = $request->name;
        $person_type->save();
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
            return back()->withErrors("You must be logged in to do this.");
        }
        $person_type = PersonType::find($id);
        if ($person_type==null){
            return back()->withErrors("This is not a valid ID. Sorry.");
        }
        if ($person_type->user_id!=Auth::user()->id){
            return back()->withErrors("You are not authorized to do this.");
        }
        $person_type->disabled_at = date('Y-m-d H:i:s');
        $person_type->save();
        return back();
    }
}
