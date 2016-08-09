<div class='timePeriod clearfix row margin-top'>
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
<div id='newTimePeriodNote{{ $time_period->id }}' 
  class='newTimePeriodNote clearfix'>
</div>
<div class='listOfActiveTasks clear margin-left-3'>
    @foreach ($time_period->notes as $time_period_note)
        @include('Note.destroy', ["note"=>$time_period_note, "type"=>"timePeriodNote" ])
    @endforeach
    @foreach ($time_period->tasks as $task)
         <div class='col-xs-8 col-lg-3' style='padding:0px;'>
             @include('Task.destroy')
         </div>
         <div class='col-xs-4 col-lg-9'>
             <button id='showNewTaskNotes{{ $task->id }}' class='showNewTaskNotes btn btn-info'>
                 Note
             </button>
         </div>
        <div id='newTaskNote{{ $task->id }}' class='newTaskNote' >
        </div>
        <div class='margin-left-3'>
            @foreach ( $task->notes as $task_note )
                @include('Note.destroy', ["note"=>$task_note, "type"=>"taskNote"])
            @endforeach
        </div>
    @endforeach
    </div>
</div>
