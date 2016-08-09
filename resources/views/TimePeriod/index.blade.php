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
<div id='listOfNewTasks{{$time_period->id}}' class='listOfNewTasks clearfix'></div>
<div id="time-period{{$time_period->id}}">
    <div id='time-period-error{{$time_period->id}}' class='text-danger'></div>
    <a name="TP{{$time_period->id}}"></a>
    @if ($date!= $old_date)
        <h1 class='text-center'>
            {{ $date }} 
        </h1>
        <?php $old_date = $date ?>
    @endif
    @include ('TimePeriod.show')
</div>
@endforeach
