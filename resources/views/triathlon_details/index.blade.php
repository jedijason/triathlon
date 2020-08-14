@extends('layouts.app')

@section('content')

@auth
<h3>My Events</h3>
            
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
    @foreach ($triDetails as $triDetail)
    <tr>
        <td>{{$triDetail->first_name}}</td>
        <td>{{$triDetail->last_name}}</td>
        <td> <a href="/triathlon-details/showevent/{{$triDetail->tri_id}}/{{$triDetail->div_id}}"> {{$triDetail->triathlon_name}} </a> </td>
        <td>{{$triDetail->division_name}}</td>
        <td>{{$triDetail->minutes}}</td>
        <td>{{$triDetail->miles}}</td>
        <td>{{$triDetail->kms}}</td>
        <td style="display: none">{{$triDetail->tri_id}}</td>
    </tr>
    
    @endforeach
</table>

@else
     Login in to view stats    
@endauth
@endsection



