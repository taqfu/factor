<?php
    use App\TimePeriod;
    use App\User;
    $old_date = 0;
    $last_time_period_ended_at=0;
    $previous_time_period=0;
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
	$time_period_is_empty=FALSE;
    $date   = date("m/d/y", User::local_time(Auth::user()->timezone, strtotime($time_period->start)));
    $month  = date("m", User::local_time(Auth::user()->timezone, strtotime($time_period->start)));
    $day    = date("d", User::local_time(Auth::user()->timezone, strtotime($time_period->start)));
    $year   = date("y", User::local_time(Auth::user()->timezone, strtotime($time_period->start)));
    $last_time_period_ended_at = $time_period->start;
    $start_time = date("H:i", User::local_time(Auth::user()->timezone, strtotime($time_period->start)));
	if (count($time_period->tasks)==0 && count($time_period->notes) == 0
	  && count($time_period->people)==0){
		$time_period_is_empty=TRUE;
	}
?>
<div class='margin-top'>
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
    @if ($time_period->end !=0)
            @if ($time_period->id == $first_time_period_id)
                @include ("TimePeriod.new")
            @endif
    @endif
    	<div class='col-xs-12 col-lg-3'>
    	    @include ('TimePeriod.destroy')
    	    <strong> {{$start_time}} - </strong>
    	    @if ($time_period->end==0)
    	        @include ('TimePeriod.edit', ['when'=>'now', 'button_caption'=>$start_time])
    	        <button id='specifyEndTime{{ $time_period->id }}' class='specifyEndTime btn btn-primary'>
    	            &#x0231A;
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
				<?php
    	        	$resume_button_caption = date("H:i", User::local_time(Auth::user()->timezone, strtotime($time_period->end)));
				?>
    	         <form method="POST" action="{{route('time.resume', ['id'=>$time_period->id])}}"
    	           class='inline' role='form'>
    	             {{csrf_field()}}
					<input type='hidden' id='resume-button-caption{{$time_period->id}}' value='{{$resume_button_caption}}' />
    	             <button id='resume-button{{$time_period->id}}'
						class='resume-button btn btn-info'>
						{{$resume_button_caption}}
    	             </button>
    	         </form>
    	        <div class='inline'>
    	            <?php
    	                $begin = new DateTime($time_period->start);
    	                $end = new DateTime($time_period->end);
    	            ?>
    	        </div>
    	    @endif
    	    <div class='inline'>
    	        <?php
    	            $interval = $begin->diff($end);
    	            $days = (int)$interval->format('%d');
    	            $hours = (int)$interval->format('%h');
    	            $minutes = (int)$interval->format('%i');
    	            $seconds = (int)$interval->format('%S');
    	        ?>
    	        (
    	        <strong>
				<span id='duration{{$time_period->id}}'
				  class='duration @if ($time_period->end == 0) active @endif'>
    	            @if ($days>0)
    	                {{ $days }}d
    	            @endif
    	            @if ($hours>0)
    	                {{ $hours }}h
    	            @endif
    	            @if ($minutes>0)
    	                {{ $minutes }}m
    	            @endif
    	            @if ($seconds>0)
    	                {{ $seconds }}s
    	            @endif
				</span>
    	        </strong>)
    	        @if ($time_period->end==0)
    	            <div id='selectEndTimestamp{{ $time_period->id }}'
    	              class='selectEndTimestamp hidden clearfix margin-left-3'>
    	                @include ('TimePeriod.edit', ['when'=>'specify'])
    	            </div>
    	        @endif
    	    </div>
    	</div>
    <div class='col-lg-9 col-xs-12 secondary-menu'>
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
		@if($time_period_is_empty)
			<h3 class='empty-time-period col-xs-12 col-md-4 text-center'>???</h3>
		@endif
        @include ('TimePeriod.show')
    </div>
</div>
<?php
  $previous_time_period = $time_period;
 ?>
@endforeach
