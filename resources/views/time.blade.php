@extends ('master')

@section ('content')
<div class='text-danger text-center lead'>

@foreach($errors->all() as $error)
    <div>
        {!!$error !!}
    </div>
@endforeach
</div>
<input type='hidden' value='{{$period}}' id='period-of-time' />
<!--
REQUIRES BOOTSTRAP 4
<ul class="nav nav-tabs">

  <li class="nav-item dropdown  active">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Time</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">New Item</a>
      <div class="dropdown-divider"></div>

      <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>

      <a class="dropdown-item" href="#">Separated link</a>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Tasks</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">People</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#">Logout</a>
  </li>
</ul>
-->

<ul class='nav nav-pills nav-justified'>
    <li class='dropdown'>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <h3>
                {{ucfirst($period)}}
            </h3>
            <span class="caret"></span>
        </a>
        <ul class='dropdown-menu'>
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
            <li>
                <a href="{{route('selectDate')}}"><h3>Date</h3></a>
            </li>
            <li
              @if ($period=="all")
                  class='active'
              @endif
              >
                <a href="{{route('time.index', ['period'=>'all'])}}"><h3>All</h3></a>
            </li>

        </ul>
    </li>
    <li>
        <a href="{{url('/logout')}}"><h3>Logout</h3></a>
    </li>
</ul>
<div class='container text-center margin-top'>
    <button id='showNewTimePeriod' class='btn-default btn-show'>New Time Period</button>
    <button id='hideNewTimePeriod' class='btn-default hidden btn-hide'>Hide New Time Period</button>
    <button id='showNewTaskTypes' class='btn-default btn-show'>Task Types</button>
    <button id='hideNewTaskTypes' class='btn-default hidden btn-hide'>Hide Task Types</button>

    <button id='showPeople' class='btn-default btn-show'>People</button>
    <button id='hidePeople' class='btn-default hidden btn-hide'>Hide People</button>
    <button id='show-time-zone' class='btn-default btn-show'>Timezone</button>
    <button id='hide-time-zone' class='btn-default hidden btn-hide'>Hide Timezone</button>
</div>
@include ('TimePeriod.create')
@include('PersonType.index')

@include ('TaskType.index')
@include ('timezones');
@include ('TimePeriod.index')
@endsection
