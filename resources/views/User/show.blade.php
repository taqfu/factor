@extends('master')

@section('content')
    <h1 class='text-center'>
        @if(isset(Auth::user()->username))
            {{Auth::user()->username}}
        @else
            {{Auth::user()->name}}
        @endif
    </h1>

@endsection
