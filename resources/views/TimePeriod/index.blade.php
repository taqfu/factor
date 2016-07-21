<?php 
    $old_date = 0; 
?>

@foreach ($time_periods as $time_period)
    <?php $date = date("m/d/y", strtotime($time_period->start)) ?>
    @if ($date!= $old_date)
        <h1 class='text-center'>
            {{ $date }} 
        </h1>
        <?php $old_date = $date ?>
    @endif

    <div class='timePeriod clearfix lead' style=''>
        <form method="POST" action="{{ route('time.destroy', 
          ['id'=>$time_period->id]) }}" class='pull-left' >
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type='submit' class='btn btn-danger' />
                x
            </button>
            {{ date("H:i", strtotime($time_period->start)) }} - 
        </form>
        @if ($time_period->end==0)
            <form method="POST" action="{{ route('time.update', 
              ['id'=>$time_period->id]) }}" class='pull-left'>
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type='hidden' name='when' value='now' />
                <button type='submit' class='btn btn-default'/>
                    Complete now
                </button>
            </form>
            <div class='pull-left'>
                Or
                <button id='specifyEndTime{{ $time_period->id }}' 
                  class='btn btn-default specifyEndTime'>
                Specify
                </button> 
            </div>
            <?php
                $begin = new DateTime($time_period->start); 
                $end = new DateTime(); 
            ?>
        @elseif ($time_period->end!=0)
            <div class='pull-left'>
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
        <div class='pull-left'>
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
        <div class=''>
            <button id='showNewTasks{{$time_period->id}}'
              class='showNewTasks btn btn-primary'>
                Add Task
            </button>
            <button id='hideNewTasks{{$time_period->id}}'
              class='hideNewTasks btn btn-primary hidden'>
                Hide Tasks
            </button>
            <button id='showNewTimePeriodNote{{$time_period->id}}'
              class='showNewTimePeriodNote btn btn-primary'>
                Add Note
            </button>
        </div>
        @if ($time_period->end==0)
        <div id='selectEndTimestamp{{ $time_period->id }}'
          class='selectEndTimestamp hidden'>
            <button id='hideSelectEndTimestamp{{ $time_period->id }}' 
              class='hideSelectEndTimestamp pull-left btn btn-default'>
                -
            </button>
            <form  method="POST" action="{{ route('time.update', 
              ['id'=>$time_period->id]) }}" class='pull-left clearfix'>
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                @include ('timeSelect', ["timestamp_type"=>"newEnd", 'radio'=>false])
                <input type='hidden' name='when' value='timestamp' />
                <input type='submit' value='Submit' class='pull-left'/>
            </form>
        </div>
        @endif
    </div>
    <div id='newTimePeriodNote{{ $time_period->id }}' class='newTimePeriodNote clearfix hidden'>
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
        <form method="POST" action="{{ route('TimePeriodNote.destroy', 
          ['id'=>$time_period_note->id]) }}" class='margin-left bg-info'>
            {{ csrf_field () }}
            {{ method_field('DELETE') }}
            <button type='submit' class='delete btn btn-danger'>
                x
            </button>
            <span class='timePeriodNote'>
                {{ $time_period_note->report }} 
                <span class='timePeriodNoteInfo'>
                    (Created: {{ date("m/d/y g:i", strtotime($time_period_note->created_at)) }})
                </span>
            </span>
        </form>
    @endforeach
    @foreach ($time_period->tasks as $task)
        <div class='task clearfix margin-left'>
            <form method="POST" action="{{ route('task.destroy', 
              ['id'=>$task->id]) }}" class='pull-left'>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type='submit' class='delete btn btn-danger'>
                    x
                </button>
                {{ $task->type->name }}
            </form>
            <button id='showNewTaskNotes{{ $task->id }}'
              class='showNewTaskNotes btn btn-default margin-left'>
                New Note
            </button>
        </div>
        <form id='newTaskNote{{ $task->id }}' method="POST" action="{{ route('TaskNote.store') }}" class='textWidth clearfix newTaskNote hidden'>
            {{ csrf_field() }} 
            <input type='hidden' name='taskID' value='{{ $task->id }}' />
            <textarea name='newTaskNote' class='textWidth textHeight'></textarea>
            <input type='submit' value='Create Note' style='float:right;'/>
            <input type='button' id='hideNewTaskNotes{{ $task->id }}' value='Cancel' class='hideNewTaskNotes' style='float:right;'/>
        </form>
        @foreach ( $task->notes as $note )
            <form method="POST" action="{{ route('TaskNote.destroy', 
              ['id'=>$note->id]) }}"  class='taskNote bg-info margin-left-2'>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type='submit' class='delete btn btn-danger'>
                    x
                </button>
                {{ $note->report }}
                <span class='taskNoteInfo'>
                    ( Created - 
                    {{ date("m/d/y g:i", strtotime($note->created_at)) }} )
                </span>
            </form>
        @endforeach
    @endforeach
    </div>
    </div>
@endforeach
