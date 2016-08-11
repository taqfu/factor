@extends('master')

@section('content')
<div class='text-center'>
    <img src='logo-12.png'>
</div>
    @if (count($errors)>0)
        @foreach($errors as $error)
            {{$error}}
        @endforeach
    @endif
    @include ('login')
    @include ('register')
@endsection

