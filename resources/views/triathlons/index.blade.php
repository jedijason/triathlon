@extends('layouts.app')


@section('content')

@auth

        <h3>Triathlon Events in Database</h3>
 
        <div>
            <table class="table table-responsive">
                <tr>
                    <th>Triathlon Name</th>
                    <th>Date of Event</th>
                    <th>City Name</th>
                    <th>State Name</th>
                    <th>Zip Code</th>
                </tr>
                @foreach ($events as $event)
                <tr>
                <td><a href="/triathlons/{{$event->id}}/edit">{{$event->triathlon_name}}</a></td>
                    <td>{{$event->event_date_on}}</td>
                    <td>{{$event->city_name}}</td>
                    <td>{{$event->state_name}}</td>
                    <td>{{$event->zip_code}}</td>
                </tr>
                
                @endforeach
            </table>
        </div>


@else
        <p>Guest - please login in or register to an event.</p>    
@endauth

@endsection
