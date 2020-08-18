@extends('layouts.app')

@section('content')

@auth
    <h3>Everyone</h3>
    
    @if(count($triDetails) > 0)            
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
                    @if($triDetail->usr_id == Auth()->user()->id)
                    <td> <a href="/triathlon-details/showevent/{{$triDetail->tri_id}}/{{$triDetail->div_id}}"> {{$triDetail->triathlon_name}} </a> </td>
                    @else   
                    <td>{{$triDetail->triathlon_name}}</td>
                    @endif
                    <td>{{$triDetail->division_name}}</td>
                    <td>{{$triDetail->minutes}}</td>
                    <td>{{$triDetail->miles}}</td>
                    <td>{{$triDetail->kms}}</td>
                </tr> 
            @endforeach
        </table>
    @else
    <p>Something went wrong with index</p>
    @endif
@else
    <p>Login in to view stats</p>    
@endauth

@endsection




