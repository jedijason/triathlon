@extends('layouts.app')


@section('content')

<h3>Add</h3>

@auth
    @if( count($triathlonsNotEntered) > 0 && count($divisions) > 0 )
        {!! Form::open(['action' => 'TriathlonDetailsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('triathlon_name', 'Triathlon Name') }}
            {{Form::select('tri_id', $triathlonsNotEntered, ['class' => 'form-control', 'placeholder' => 'Triathlon Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('division_name', 'Division Name') }}
            {{Form::select('div_id', $divisions, ['class' => 'form-control', 'placeholder' => 'Division Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('activity_name', 'Swim') }}
            {{Form::text('swim_id', '',  ['class' => 'form-control', 'placeholder' => 'Minutes'] )}}
        </div>
        <div class="form-group">
            {{Form::label('activity_name', 'Bike') }}
            {{Form::text('bike_id', '',  ['class' => 'form-control', 'placeholder' => 'Minutes'])}}
        </div>
        <div class="form-group">
            {{Form::label('activity_name', 'Run') }}
            {{Form::text('run_id', '', ['class' => 'form-control', 'placeholder' => 'Minutes'])}}
        </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}

    @else
    <p>Something went wrong</p>
    @endif
    
@else
    <p>Guest - please login in or register to an event.</p>    
@endauth

@endsection