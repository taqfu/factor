@extends ('master')

@section ('content')
@foreach($errors->all() as $error)
    {{$error}}
@endforeach
<ul class='list-inline text-center'>
    <li>
        <a href="{{route('time.index')}}"><h3 class=''>Today</h3></a>
    </li>
    <li>
        <a href="{{route('time.index', ['period'=>'yesterday'])}}"><h3>Yesterday</h3></a>
    </li>
    <li>
        <a href="{{route('time.index', ['period'=>'week'])}}"><h3>Week</h3></a>
    </li>
    <li>
        <a href="{{route('time.index', ['period'=>'all'])}}"><h3>All</h3></a>
    </li>
</ul>
        @include ('TimePeriod.create') 
<div class='container text-center margin-top'>
    <button id='showNewTaskTypes' class='btn-default'>Show Task Types</button>
    <button id='hideNewTaskTypes' class='btn-default hidden'>Hide Task Types</button>
</div>
@include ('TaskType.index')

@include ("TimePeriod.index")

@endsection
