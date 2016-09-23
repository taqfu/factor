<?php
    use App\TimePeriod;
    use App\User;
    $old_date = 0;
    $last_time_period_ended_at=0;
?>

@foreach ($time_periods as $time_period)
@if ($last_time_period_ended_at!=0 && $time_period->end!="0000-00-00 00:00:00"
  && TimePeriod::interval($time_period->end, $last_time_period_ended_at)>300)
    <div class='lead margin-top-2'>
        {{TimePeriod::format_interval($time_period->end, $last_time_period_ended_at)}}
        unnaccounted for
    </div>
@endif
<?php
    $date   = date("m/d/y", User::local_time(Auth::user()->timezone, strtotime($time_period->start)));
    $month  = date("m", User::local_time(Auth::user()->timezone, strtotime($time_period->start)));
    $day    = date("d", User::local_time(Auth::user()->timezone, strtotime($time_period->start)));
    $year   = date("y", User::local_time(Auth::user()->timezone, strtotime($time_period->start)));
    $last_time_period_ended_at = $time_period->start;
?>
<div class='margin-top'>
    <a id="TP{{$time_period->id}}"></a>
    @if ($date!= $old_date)
        <h1 class='text-center'>
            <a href="{{ route('indexDate', ['month'=>$month, 'day'=>$day, 'year'=>$year]) }}"> 
                {{ $date }}
            </a>
        </h1>
        <?php $old_date = $date ?>
    @endif
    <div class='col-xs-12 col-lg-3'>
        @include ('TimePeriod.destroy')
        @if ($time_period->end==0)
            @include ('TimePeriod.edit', ['when'=>'now'])
            <button id='specifyEndTime{{ $time_period->id }}' class='specifyEndTime btn btn-default'>
                Specify
            </button>
            <button id='hideSpecifyEndTime{{ $time_period->id }}'
              class='hideSpecifyEndTime btn btn-info hidden'>
                Hide
            </button>

            <?php
                $begin = new DateTime($time_period->start);
                $end = new DateTime();
            ?>
        @elseif ($time_period->end!=0)
            <div class='inline'>
                {{ date("H:i", User::local_time(Auth::user()->timezone, strtotime($time_period->end)))  }}
                <?php
                    $begin = new DateTime($time_period->start);
                    $end = new DateTime($time_period->end);
                ?>
            </div>
        @endif
        <div class='inline'>
            <?php
                $interval = $begin->diff($end);
                $hours = (int)$interval->format('%h');
                $minutes = (int)$interval->format('%i');
                $seconds = (int)$interval->format('%S');
            ?>
            (
            <strong>
                @if ($hours>0)
                    {{ $hours }}h
                @endif
                @if ($minutes>0)
                    {{ $minutes }}m
                @endif
                @if ($seconds>0)
                    {{ $seconds }}s
                @endif
            </strong>
            )
            @if ($time_period->end !=0)
                    <form method="POST" action="{{route('time.resume', ['id'=>$time_period->id])}}"
                      class='inline' role='form'>
                        {{csrf_field()}}
                        <button class='btn btn-primary'>
                            Resume
                        </button>
                    </form>
                    @if ($time_period->id == $first_time_period_id)
                        @include ("TimePeriod.new")
                    @endif
            @endif
            @if ($time_period->end==0)
                <div id='selectEndTimestamp{{ $time_period->id }}'
                  class='selectEndTimestamp hidden clearfix margin-left-3'>
                    @include ('TimePeriod.edit', ['when'=>'specify'])
                </div>
            @endif
        </div>
    </div>
    <div class='col-xs-4'></div>
    <div class='col-lg-9 col-xs-8 secondary-menu'>
        <button id='showNewTasks{{$time_period->id}}' class='showNewTasks btn btn-primary show-time-period-menu'>
            Task
        </button>
        <button id='hideNewTasks{{$time_period->id}}' class='hideNewTasks hidden btn btn-info hide-time-period-menu'>
            Hide
        </button>
        <button id='showNewTimePeriodNote{{$time_period->id}}'
          class='showNewTimePeriodNote btn btn-primary show-time-period-menu'>
            Note
        </button>
        <button id='hideNewTimePeriodNote{{$time_period->id}}'
          class='hideNewTimePeriodNote btn btn-info hide-time-period-menu hidden'>
            Hide
        </button>
        <button id='show-new-person-time-period{{$time_period->id}}'
          class='show-new-person btn btn-primary show-time-period-menu'/>
            Person
        </button>
        <button id='hide-new-person-time-period{{$time_period->id}}'
          class='hide-new-person btn btn-info hidden hide-time-period-menu'/>
            Hide
        </button>
    </div>
    <div id='time-period-error{{$time_period->id}}' class='lead text-center text-danger'></div>
    <div id='new-person-time-period{{$time_period->id}}' class='new-person time-period-menu'>
    </div>
    <div id='listOfNewTasks{{$time_period->id}}' class='listOfNewTasks time-period-menu'></div>
    <div id='newTimePeriodNote{{ $time_period->id }}'
      class='newTimePeriodNote clearfix time-period-menu'>
    </div>
    <div id="time-period{{$time_period->id}}">
        @include ('TimePeriod.show')
    </div>
</div>
@endforeach
