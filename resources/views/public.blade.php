@extends('master')

@section('content')
    @if (count($errors)>0)
        @foreach($errors as $error)
            {{$error}}
        @endforeach
    @endif
    @include ('login')
    @include ('register')
@endsection

