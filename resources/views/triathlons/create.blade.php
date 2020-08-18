@extends('layouts.app')



@section('content')

@auth

        <h3>Add Triathlon Events To The Database</h3>
     
        {!! Form::open(['action' => ['TriathlonsController@store', Auth()->user()->id ], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('triathlon_name', 'Triathlon Name') }}
            {{Form::text( 'triathlon_name', '', ['class' => 'form-control', 'placeholder' => 'Triathlon Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('event_date', 'Event Date') }}
            {{Form::text('event_date', '', ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd'])}}
        </div>
        <div class="form-group">
            {{Form::label('city_name', 'City Name') }}
            {{Form::text('city_name', '', ['class' => 'form-control', 'placeholder' => 'City Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('state_name', 'State Name') }}
            {{Form::text('state_name', '', ['class' => 'form-control', 'placeholder' => 'State Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('zip_code', 'Zip_Code') }}
            {{Form::text('zip_code', '', ['class' => 'form-control', 'placeholder' => 'Zip Code - optional'])}}
        </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
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