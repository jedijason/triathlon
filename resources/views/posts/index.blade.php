@extends('layouts.app')


@section('content')

<h1>test post</h1>

@if (count($posts) > 1)
    @foreach ($posts as $post)

        <div>
        <h3>{{$post}}</h3>
        </div>
        
    @endforeach
@endif
    
@endif

    
@endsection