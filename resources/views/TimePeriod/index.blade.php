
<?php 
    $old_date = 0; 
    $last_visible = null;
?>

@foreach ($time_periods as $time_period)
    <?php $date = date("m/d/y", strtotime($time_period->start)) ?>
    @if ($date!= $old_date)
        <h1>
            {{ $date }} 
        </h1>
        <?php $old_date = $date ?>
    @endif
    <div class=' timePeriod'>
    <form method="POST" action="{{ route('TimePeriod.destroy', ['id'=>$time_period->id]) }}" class='delete' >
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type='submit' value='x' class='textButton delete' />
        {{ date("H:i", strtotime($time_period->start)) }} - 
    </form>
    @if ($time_period->end==0)
        <form method="POST" action="{{ route('TimePeriod.update', ['id'=>$time_period->id]) }}" style='float:left;'> 
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type='hidden' name='when' value='now' />
            <input type='submit' value='Complete now.' class='textButton'/>
            Or
            <input type='button' id='specifyEndTime{{ $time_period->id }}' value='Specify' class='textButton specifyEndTime' /> 
        </form>
        <?php
            $begin = new DateTime($time_period->start); 
            $end = new DateTime(); 
        ?>
    @elseif ($time_period->end!=0)
        <div style='float:left;'>
        {{ date("H:i", strtotime($time_period->end)) }}  
        <?php 
            $begin = new DateTime($time_period->start); 
            $end = new DateTime($time_period->end); 
        ?>
            
        </div>
    @endif
        <?php
            $interval = $begin->diff($end);
            $hours = (int)$interval->format('%h'); 
            $minutes = (int)$interval->format('%i'); 
            $seconds = (int)$interval->format('%S'); 
        ?>
        <div style='float:left;margin-left:16px;'>
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
    <input type='button' id='showNewTasks{{$time_period->id}}' value='[ Add Task ] ' 
      class='showNewTasks textButton' style='margin-left:16px;'/>
    <input type='button' id='hideNewTasks{{$time_period->id}}' value='[ Hide Tasks ] ' 
      class='hideNewTasks textButton' style='margin-left:16px;'/>
    <input type='button' id='showNewTimePeriodNote{{$time_period->id}}' value='[ Add Note ] ' 
      class='showNewTimePeriodNote textButton' />
    @if ($time_period->end==0)
        <form id='selectEndTimestamp{{ $time_period->id }}' class='selectEndTimestamp clear' 
          method="POST" action="{{ route('TimePeriod.update', ['id'=>$time_period->id]) }}">
            <input type='button' id='hideSelectEndTimestamp{{ $time_period->id }}' 
              class='hideSelectEndTimestamp textButton clear' value='[ - ]' />
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include ('timeSelect', ["timestamp_type"=>"newEnd"])
            <input type='hidden' name='when' value='timestamp' />
            <input type='submit' value='Submit' />
        </form>
    @endif
    <div id='newTimePeriodNote{{ $time_period->id }}' class='newTimePeriodNote clear'>
        <form method="POST" action="{{ route('TimePeriodNote.store') }}" class='textWidth'/>
            {{ csrf_field() }}
            <input type='hidden' name='timePeriodID' value='{{ $time_period->id }}' />
            <textarea name='newTimePeriodNote' class='textWidth textHeight'></textarea>
            <input type='submit' value='Create Note' style='float:right;'/>
            <input type='button' id='hideNewTimePeriodNote{{$time_period->id}}' 
              class='hideNewTimePeriodNote' value='Cancel' style='float:right;'/>
        </form>
    </div>
    <div id='listOfNewTasks{{$time_period->id}}' class='listOfNewTasks clear'></div>
    <div class='listOfActiveTasks clear'>
    @foreach ($time_period->notes as $time_period_note)
        <form method="POST" action="{{ route('TimePeriodNote.destroy', ['id'=>$time_period_note->id]) }}">
            {{ csrf_field () }}
            {{ method_field('DELETE') }}
            <input type='submit' value='x' class='textButton delete' />
            <span class='timePeriodNote'>
                {{ $time_period_note->report }} 
                <span class='timePeriodNoteInfo'>
                    (Created: {{ date("m/d/y g:i", strtotime($time_period_note->created_at)) }})
                </span>
            </span>
        </form>
    @endforeach
    @foreach ($time_period->tasks as $task)
        <div class='task clear'>
            <form method="POST" action="{{ route('task.destroy', ['id'=>$task->id]) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type='submit' value='x' class='textButton delete' />
            {{ $task->type->name }}
            <input type='button' id='showNewTaskNotes{{ $task->id }}' value='[ New Note ]' class='textButton showNewTaskNotes'/>
            </form>
        </div>
        <form id='newTaskNote{{ $task->id }}' method="POST" action="{{ route('TaskNote.store') }}" class='textWidth clear newTaskNote'>
            {{ csrf_field() }} 
            <input type='hidden' name='taskID' value='{{ $task->id }}' />
            <textarea name='newTaskNote' class='textWidth textHeight'></textarea>
            <input type='submit' value='Create Note' style='float:right;'/>
            <input type='button' id='hideNewTaskNotes{{ $task->id }}' value='Cancel' class='hideNewTaskNotes' style='float:right;'/>
        </form>
        @foreach ( $task->notes as $note )
            <form method="POST" action="{{ route('TaskNote.destroy', ['id'=>$note->id]) }}"  class='taskNote'>
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type='submit' value='x' class='textButton delete' />
            {{ $note->report }}
            <span class='taskNoteInfo'>( Created - {{ date("m/d/y g:i", strtotime($note->created_at)) }} )</span>
            </form>
        @endforeach
    @endforeach
    </div>
    </div>
@endforeach
