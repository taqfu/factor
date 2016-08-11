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
<h1 class='text-center margin-bottom-2'>
    Track Time Easily
</h1>
    @include ('login')
    @include ('register')
@endsection

