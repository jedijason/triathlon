<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\triathlon;
use Illuminate\Support\Facades\DB;


class TriathlonsController extends Controller
{   // authenticate user roles
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('role:superadministrator');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = DB::table('triathlons')->orderBy('triathlon_name')->get();
        
        return view('/triathlons/index')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $events = DB::table('triathlons')->orderBy('triathlon_name')->get();

        return view('/triathlons.create')->with('events', $events);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        /** Notes
         */

        //'event_date'     => 'date_format:yyyy-mm-dd'
        // verify the minutes fields from the form
        $this->validate($request,[
            'triathlon_name' => 'required',
            'city_name'      => 'required',
            'state_name'     => 'required',
            
        ]);
     
            $tri = new triathlon();

            $tri->triathlon_name = $request->input('triathlon_name');
            $tri->event_date_on = $request->input('event_date');
            $tri->city_name = $request->input('city_name');
            $tri->state_name = $request->input('state_name');
            if($request->input('zip_code') ) {
                $tri->zip_code = $request->input('zip_code');
            }
            $tri->save();

            $events = DB::table('triathlons')->orderBy('triathlon_name')->get();
            $request->session()->flash('success', 'Triathlon sucessfully added!');

            return view('/triathlons.index')->with('events' , $events,);
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
        $tri = DB::table('triathlons')->find($id);

        return view('/triathlons/edit')->with('tri', $tri);
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
         // data comes from create.blade.php
         $this->validate($request,
         [
             'triathlon_name' => 'required',
             'event_date_on' =>  'required',
             'city_name' =>      'required',
             'state_name' =>     'required',
             
         ]);
       /*  
         $event = triathlon::find($id);
         //$event = DB::table('triathlons')->find($id);
         //$event = triathlon::findorfail($id);
         echo $event->id;
        echo $event->triathlon_name;
        echo $event->event_date_on;
        echo $event->city_name;
        echo $event->state_name;
        echo $event->zip_code;
//*/

        /* ($affected = DB::table('triathlons')
            ->where( 'id', $id )
            ->update([
                [ 'triathlon_name' =>  $request->input('triathlon_name') ],
                [ 'event_date_on' =>  $request->input('event_date_on') ],
                [ 'city_name'     =>  $request->input('city_name') ],
                [ 'state_name'    =>  $request->input('state_name') ],
                [ 'zip_code'      =>  $request->input('zip_code') ],
                ] );
                //*
//*/


                $tri = triathlon::find($id);
         $tri->triathlon_name = $request->input('triathlon_name');
         $tri->event_date_on = $request->input('event_date_on');
         $tri->city_name = $request->input('city_name');
         $tri->state_name = $request->input('state_name');
         //if($request->isset('zip_code')){
         $tri->zip_code = $request->input('zip_code');
         //}
         $tri->save();
//*/
        $events = DB::table('triathlons')->orderBy('triathlon_name')->get();


        return view('/triathlons.index')->with([
            'success' => 'Event successfully updated.',
            'events' => $events, 
            ]);
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tri = triathlon::find($id);
        //if(auth()->user()->id !== $tri->user_id ){
          //  return redirect('/posts')->with('error', 'Unauthorized page.');
       // }

        $tri->delete();
        return redirect('/triathlons')->with('success', 'Event Removed.');
    }
}
