<?php 
    use App\TimePeriod;
    $old_date = 0; 
    $last_time_period_ended_at=0;
?>

@foreach ($time_periods as $time_period)
@if ($last_time_period_ended_at!=0 
  && TimePeriod::interval($time_period->end, $last_time_period_ended_at)>300)
    <div class='lead margin-top-2'>
        {{TimePeriod::format_interval($time_period->end, $last_time_period_ended_at)}}
        unnaccounted for
    </div>
@endif
<?php 
    $date = date("m/d/y", strtotime($time_period->start));
    $last_time_period_ended_at = $time_period->start;
?>
<div id="time-period{{$time_period->id}}" class='margin-top'>
    <div id='time-period-error{{$time_period->id}}' class='text-danger'></div>
    <a name="TP{{$time_period->id}}"></a>
    @if ($date!= $old_date)
        <h1 class='text-center'>
            {{ $date }} 
        </h1>
        <?php $old_date = $date ?>
    @endif
    <div class='col-xs-12 col-lg-3'>
        @include ('TimePeriod.destroy')
        @if ($time_period->end==0)
            @include ('TimePeriod.edit', ['when'=>'now'])
            <button id='specifyEndTime{{ $time_period->id }}' 
              class='specifyEndTime btn btn-default'>
                Specify
            </button> 
            <?php
                $begin = new DateTime($time_period->start); 
                $end = new DateTime(); 
            ?>
        @elseif ($time_period->end!=0)
            <div class='inline'>
                {{ date("H:i", strtotime($time_period->end)) }}  
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
            @if ($hours>0)
                {{ $hours }}h
            @endif 
            @if ($minutes>0)
                {{ $minutes }}m
            @endif
            @if ($seconds>0) 
                {{ $seconds }}s
            @endif
            )
        </div>
    </div>
    <div class='col-xs-4'></div>
    <div class='col-lg-9 col-xs-8 secondary-menu'>
        <button id='showNewTasks{{$time_period->id}}' class='showNewTasks btn btn-primary'>
            Task
        </button>
        <button id='hideNewTasks{{$time_period->id}}' class='hideNewTasks hidden btn btn-primary'>
            Hide
        </button>
        <button id='showNewTimePeriodNote{{$time_period->id}}'
          class='showNewTimePeriodNote btn btn-info'>
            Note
        </button>
    </div>
</div>
@if ($time_period->end==0)
    <div id='selectEndTimestamp{{ $time_period->id }}'
      class='selectEndTimestamp hidden clearfix margin-left-3'>
        <button id='hideSelectEndTimestamp{{ $time_period->id }}' 
          class='hideSelectEndTimestamp btn btn-default pull-left'>
            -
        </button>
        @include ('TimePeriod.edit', ['when'=>'specify'])
    </div>
@endif
<div id='listOfNewTasks{{$time_period->id}}' class='listOfNewTasks clearfix'></div>
<div id='newTimePeriodNote{{ $time_period->id }}' 
  class='newTimePeriodNote clearfix'>
</div>
    @include ('TimePeriod.show')
</div>
@endforeach
