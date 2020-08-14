@extends('layouts.app')

@section('content')

@auth

<h3>Details</h3>
<div>
<table class="table table-hover">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Triathlon</th>
        <th>Division</th>
        <th>Total Minutes</th>
        <th>Total Miles</th>
        <th>Total Kilometers</th>
    </tr>
    @foreach ($triSum as $tri)
    <tr>
        <td>{{$tri->first_name}}</td>
        <td>{{$tri->last_name}}</td>
        <td>{{$tri->triathlon_name}}</td>
        <td>{{$tri->division_name}}</td>
        <td>{{$tri->minutes}}</td>
        <td>{{$tri->miles}}</td>
        <td>{{$tri->kms}}</td>
    </tr>
    
    @endforeach
</table>
</div>
<div>
    <table class="table table-hover">
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
</div>
<div>
<a href="/triathlon-details/editevent/{{$tri->tri_id}}/{{$tri->div_id}}" class="btn btn-default">Edit</a>
</div>

{!!Form::open(['action' => ['TriathlonDetailsController@destroy2', $tri->tri_id, $tri->div_id ], 'method' => 'POST', 'class' => 'pull-right' ])!!}
{{Form::hidden('_method', 'DELETE')  }}
{{Form::submit('Delete', ['class' => 'btn btn-danger']) }}
{!!Form::close() !!}

@else
    Guest - please login in or register to an event.    
@endauth

@endsection
