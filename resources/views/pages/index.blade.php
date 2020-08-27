@extends('layouts.app')

    @section('content')
        
<h1>{{$title}}</h1>
        
    @guest
        <h3>Welcome Guest!</h3>
        <p>Use this application to record your triathlon race results.</p>
        <p>Registration required.</p>  
        <p>Registered users are able to select a past triathlon event and enter their completion times 
            for swimming, running, and bicycling. Results from all users are combined and sorted
            by best time in each triathlon. 
        </p>
   
    @else
            <h3>Welcome {{Auth()->user()->first_name}} </h3>
            <p>I hope you are enjoy using this tracker.  </p>
            <p>New Features are added regularly so, check back often.</p>
            <p></p>
    @endauth


    @endsection