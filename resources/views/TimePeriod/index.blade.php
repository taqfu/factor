<?php
    use App\TimePeriod;
    use App\User;
    $old_date = 0;
    $last_time_period_ended_at=0;
    $previous_time_period=0;
?>

<div id='time-period-menu-container' class='hidden'>

</div>

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

<div class='margin-top container' >
    <a id="TP{{$time_period->id}}"></a>
    @if ($date!= $old_date)
        <h1 class='text-center'>
            @if ($period!="today" && $period!="yesterday" && $period!="date")
                <a href="{{ route('indexDate', ['month'=>$month, 'day'=>$day, 'year'=>$year]) }}">
                    {{ $date }}
                </a>
            @else
                {{ $date }}
            @endif

        </h1>
        <?php $old_date = $date ?>
    @endif
    <div id="time-period-row{{$time_period->id}}" class='row time-period-row' >
        <div class='col-xs-12 col-lg-3'>
            <!--@include ('TimePeriod.destroy')-->
            {{ date("H:i", User::local_time(Auth::user()->timezone, strtotime($time_period->start)))  }} -
            @if ($time_period->end==0)
                @include ('TimePeriod.edit', ['when'=>'now', 'time_period_menu'=>false])
                /
                <button id='specifyEndTime{{ $time_period->id }}' class='specifyEndTime btn btn-link'>
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
                          class='inline hidden' role='form'>
                            {{csrf_field()}}
                            <button class='btn btn-primary'>
                                Resume
                            </button>
                        </form>

                        @if ($time_period->id == $first_time_period_id && substr($time_period->start, 0, 10)== date("Y-m-d"))
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

        <div id='time-period-error{{$time_period->id}}' class='lead text-center text-danger'></div>

        <div id="time-period{{$time_period->id}}" >
            @include ('TimePeriod.show')
        </div>
    </div>
</div>
<?php
  $previous_time_period = $time_period;
 ?>
@endforeach
