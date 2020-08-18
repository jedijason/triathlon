@extends('layouts.app')

@section('content')

    @auth
        <h3>My Events</h3>
        @if(count($triDetails) > 0 )
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
                </tr>
                @endforeach
            </table>
        @else
        <p>You have no events to display or something went wrong with show.</p>
        @endif
    @else
        <p>Login in to view stats</p>    
    @endauth
@endsection




