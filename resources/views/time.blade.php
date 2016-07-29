@extends ('master')

@section ('content')
@foreach($errors->all() as $error)
    {{$error}}
@endforeach
<ul class='nav nav-pills nav-justified'>
    <li
      @if ($period=="today")
          class='active'
      @endif
      >
        <a href="{{route('time.index')}}"><h3>Today</h3></a>
    </li>
    <li
      @if ($period=="yesterday")
          class='active'
      @endif
      >
        <a href="{{route('time.index', ['period'=>'yesterday'])}}"><h3>Yesterday</h3></a>
    </li>
    <li
      @if ($period=="week")
          class='active'
      @endif
      >
        <a href="{{route('time.index', ['period'=>'week'])}}"><h3>Week</h3></a>
    </li>
    <li
      @if ($period=="all")
          class='active'
      @endif
      >
        <a href="{{route('time.index', ['period'=>'all'])}}"><h3>All</h3></a>
    </li>
</ul>

@include ('TimePeriod.create') 
<div class='container text-center margin-top'>
    <button id='showNewTaskTypes' class='btn-default'>Show Task Types</button>
    <button id='hideNewTaskTypes' class='btn-default hidden'>Hide Task Types</button>
    <button id='showNewTimePeriod' class='btn-default'>New Time Period</button>
    <button id='hideNewTimePeriod' class='btn-default hidden'>Hide New Time Period</button>
</div>
@include ('TaskType.index')

@include ("TimePeriod.index")

@endsection
