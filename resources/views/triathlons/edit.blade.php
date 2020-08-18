

@extends('layouts.app')

@section('content')

@auth
    @if($tri) 

        <h3>Edit Triathlon</h3>

        {!! Form::open(['action' => ['TriathlonsController@update', $tri->id ], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('triathlon_name', 'Triathlon Name') }}
            {{Form::text( 'triathlon_name', $tri->triathlon_name, ['class' => 'form-control', 'placeholder' => 'Triathlon Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('event_date_on', 'Event Date') }}
            {{Form::text('event_date_on', $tri->event_date_on, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd'])}}
        </div>
        <div class="form-group">
            {{Form::label('city_name', 'City Name') }}
            {{Form::text('city_name', $tri->city_name, ['class' => 'form-control', 'placeholder' => 'City Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('state_name', 'State Name') }}
            {{Form::text('state_name', $tri->state_name, ['class' => 'form-control', 'placeholder' => 'State Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('zip_code', 'Zip_Code') }}
            {{Form::text('zip_code', $tri->zip_code, ['class' => 'form-control', 'placeholder' => 'Zip Code - optional'])}}
        </div>
        
            {{Form::hidden('_method' , 'PUT' )}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        
        
            {!!Form::open(['action' => ['TriathlonsController@destroy', $tri->id ], 'method' => 'POST', 'class' => 'pull-right' ])!!}
            {{Form::hidden('_method', 'DELETE')  }}
            {{Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            {!!Form::close() !!}
        

 


    @else
            <p>Something went wrong with editevent</p>
    @endif
@else
    <p>Guest - please login in or register to an event.</p>    
@endauth


@endsection

