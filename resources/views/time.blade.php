@extends ('master')

@section ('content')
<div style='padding-bottom:32px;'>
    <a href="{{ route('log') }}">Log</a>
</div>
<form method="POST" action="{{ route('TimePeriod.store') }}" >
{{ csrf_field() }}
<div id='startTimestamp'>
    <div class='timestampHeader'>
    Start
    </div>
    <div>
        <input type='radio' name='startWhen' value='now' checked/> Now
    </div>
    <div>
        <input id='startTimestampSelect' type='radio' name='startWhen' value='timestamp' />
        @include ('timeSelect', ["timestamp_type"=>"start"])
    </div>
</div>
<div id='endTimestamp'>
    <div class='timestampHeader'>
    End
    </div>
    <div>
        <input type='radio' name='endWhen' value='now' /> Now
    </div>
    <div>
        <input type='radio' name='endWhen' value='unspecific' checked/> Specify Later
    </div>
    <div>
        <input id='endTimestampSelect' type='radio' name='endWhen' value='timestamp' />
        @include ('timeSelect', ["timestamp_type"=>"end"])
    </div>
</div>
<input type='hidden' name='test' value='test' />
<input id='createNewTimePeriod' type='submit' value='Create New Time Period' />
</form>

<input type='button' id='showNewTaskTypes' class='textButton' value='[ Show Task Types ]' />
<input type='button' id='showInactiveTimePeriods' class='textButton' value='[ Show Inactive Time Periods ]' />
<input type='button' id='hideInactiveTimePeriods' class='textButton' value='[ Hide Inactive Time Periods ]' />
<div id='listOfNewTaskTypes'>
<input type='button' id='hideNewTaskTypes' class='textButton' value='[ Hide Task Types ]' />
<form method="POST" action="{{ route('TaskType.store') }}" >
{{ csrf_field () }}
<input type='text' name='newTaskName' />
<input type='submit' value='Create New Task' />
</form>
@foreach ($task_types as $task_type)
    <form method="POST" action=" {{ route('TaskType.destroy', ['id'=>$task_type->id]) }}" >
    {{ csrf_field() }}
    {{ method_field('delete') }}

    <input type='submit' value='x' class='textButton delete' />
    {{ $task_type->name }}
    </form>
@endforeach
</div>

<div id='newTaskForm'>
<input type='button' class='hideNewTasks textButton' value='[ - ]' />
@foreach ($task_types as $task_type)
    <form method='POST' action="{{ route('task.store') }}" >   
    {{ csrf_field () }}
    <input type='hidden' name='timePeriodID' />
    <input type='hidden' name='typeID' value='{{ $task_type->id }}' />
    <input type='submit' value='{{ $task_type->name }}' class='textButton' />
    </form>
@endforeach
</div>
<?php $old_date = 0; ?>
@foreach ($time_periods as $time_period)
    <?php $date = date("m/d/y", strtotime($time_period->start)) ?>
    @if ($date!= $old_date)
        <h1> {{ $date }} </h1>
        <?php $old_date = $date ?>
    @endif
    @if ($time_period->end==0)
    <div class='clear timePeriod'>
    @elseif ($time_period->end!=0)
    <div class='inactiveTimePeriod timePeriod'>
    @endif
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
    <div id='listOfNewTasks{{$time_period->id}}' class='listOfNewTasks clear'></div>
    <div class='listOfActiveTasks'>
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
            <span class='taskNoteInfo'>( Created - {{ date("m/d/y g:i", strtotime($note->created_at)) }} }</span>
            </form>
        @endforeach
    @endforeach
    </div>
    </div>
@endforeach
@endsection
