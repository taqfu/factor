@extends ('master')

@section ('content')
<div>
    <div>
        <a href="{{route('time.index')}}">Today</a>
        <a href="{{route('time.index', ['period'=>'yesterday'])}}">Yesterday</a>
        <a href="{{route('time.index', ['period'=>'week'])}}">Week</a>
        <a href="{{route('time.index', ['period'=>'all'])}}">All</a>
    </div>
</div>

@include ('TimePeriod.create') 

<div class='clear'>
    <button id='showNewTaskTypes' >Show Task Types</button>
    <button id='hideNewTaskTypes' >Hide Task Types</button>
</div>
@include ('TaskType.index')

<div id='newTaskForm'>
</div>

@include ("TimePeriod.index")

@endsection
