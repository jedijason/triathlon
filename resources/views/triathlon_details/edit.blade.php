@extends('layouts.app')


@section('content')

<h1>Edit triathlon event</h1>

@auth




@else
    Guest - please login in or register to an event.    
@endauth

{{$division}}
@endsection



