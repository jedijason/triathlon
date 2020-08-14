@extends('layouts.app')


@section('content')

<h3>Add</h3>

@auth

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
    {{Form::label('activity_type', 'Swim') }}
    {{Form::text('swim_id', '',  ['class' => 'form-control', 'placeholder' => 'Minutes'] )}}
</div>
<div class="form-group">
    {{Form::label('activity_type', 'Bike') }}
    {{Form::text('bike_id', '',  ['class' => 'form-control', 'placeholder' => 'Minutes'])}}
</div>
<div class="form-group">
    {{Form::label('activity_type', 'Run') }}
    {{Form::text('run_id', '', ['class' => 'form-control', 'placeholder' => 'Minutes'])}}
</div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@else
    Guest - please login in or register to an event.    
@endauth

@endsection