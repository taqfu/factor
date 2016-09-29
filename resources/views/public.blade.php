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
<div class='text-center margin-bottom-2 margin-top-2'>
    Press play to see how it works!
</div>
<div class='text-center'>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/htx7a-aF6t4" frameborder="0" allowfullscreen></iframe>
</div>
@endsection

