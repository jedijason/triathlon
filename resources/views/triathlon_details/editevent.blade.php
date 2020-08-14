@extends('layouts.app')


@section('content')

@auth

<h3>Edit</h3>

{!! Form::open(['action' => ['TriathlonDetailsController@update', Auth()->user()->id ], 'method' => 'POST']) !!}
<div class="form-group">
    {{Form::label('triathlon_name', 'Triathlon Name') }}
    {{Form::select( 'tri_id', $triathlons, ['class' => 'form-control', 'placeholder' => 'Triathlon Name'])}}
</div>
<div class="form-group">
    {{Form::label('division_name', 'Division Name') }}
    {{Form::select('div_id', $divisions, ['class' => 'form-control', 'placeholder' => 'Division Name'])}}
</div>
<div class="form-group">
    {{Form::label('activity_type', 'Activity Type') }}
    {{Form::select('act_id', $activities, ['class' => 'form-control', 'placeholder' => 'Activity Type'])}}
</div>
<div class="form-group">
    {{Form::label('minutes', 'Minutes') }}
    {{Form::text('minutes', '', ['class' => 'form-control', 'placeholder' => 'Minutes'])}}
</div>
    {{Form::hidden('_method' , 'PUT' )}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

    <table class="table table-responsive">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Triathlon</th>
            <th>Division</th>
            <th>Activity</th>
            <th>Total Minutes</th>
            <th>Total Miles</th>
            <th>Total Kilometers</th>
        </tr>
        @foreach ($triDetails as $triDetail)
        <tr>
            <td>{{$triDetail->first_name}}</td>
            <td>{{$triDetail->last_name}}</td>
            <td>{{$triDetail->triathlon_name}}</td>
            <td>{{$triDetail->division_name}}</td>
            <td>{{$triDetail->activity_type}}</td>
            <td>{{$triDetail->minutes}}</td>
            <td>{{$triDetail->miles}}</td>
            <td>{{$triDetail->kms}}</td>
        </tr>
        
        @endforeach
    </table>
@else
    Guest - please login in or register to an event.    
@endauth

@endsection

