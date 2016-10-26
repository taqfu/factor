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
<div class='text-center margin-top-2'>
    Root Basis is a way to track your time. Track how you spend every minute easily!
</div>
<div class='text-center'>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/htx7a-aF6t4" frameborder="0" allowfullscreen></iframe>
</div>
<div class='text-center margin-top-2'>
    Discuss Root Basis  at <a href="https://www.reddit.com/r/rootbasis/">/r/rootbasis</a>.
</div>
@endsection

