<ul class="nav nav-tabs">

  <li class="nav-item dropdown  @if ($route_name=='time.index') active @endif">
    <a class="nav-link dropdown-toggle active " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Time</a>
    <div class="dropdown-menu">
      <a id="showNewTimePeriod" class="dropdown-item " href="#" onclick="console.log(this.id)">New Time Period</a>
      <div class="dropdown-divider"></div>


      <a class="dropdown-item
          @if ($route_name=='time.index' && isset($period) && $period=="today") active @endif
        " href="{{route('time.index')}}">Today</a>

      <a class="dropdown-item
          @if ($route_name=='time.index' && isset($period) && $period=='yesterday') active @endif
        " href="{{route('time.index', ['period'=>'yesterday'])}}">Yesterday</a>

      <a class="dropdown-item
        @if ($route_name=='time.index' && isset($period) && $period=='week') active @endif
        " href="{{route('time.index', ['period'=>'week'])}}">Week</a>

      <a class="dropdown-item
        @if ($route_name=='time.index' && isset($period) && $period=='all') active @endif
        " href="{{route('time.index', ['period'=>'all'])}}">All</a>

    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{route('task.index')}}">Tasks</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{route('note.index')}}">Notes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{route('person.index')}}">People</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="{{url('/logout')}}">Logout</a>
  </li>
</ul>
