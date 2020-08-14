@extends('layouts.app')

    @section('content')
        
<h1>{{$title}}</h1>
        

    @guest
        <h3>Welcome Guest!</h3>
        <p>Use this application to record your triathlon race results.</p>
        <p>Registration required.</p>  
   
    @else
            <h3>Welcome {{Auth()->user()->first_name}} </h3>
            <p>We hope you are enjoying this tracker.  </p>
            <p></p>
    @endauth


    @endsection