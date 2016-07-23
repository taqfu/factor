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

    <div id='listOfNewTasks{{$time_period->id}}' 
      class='listOfNewTasks clearfix'>
    </div>
    <div class='timePeriod clearfix row margin-top' style=''>
        <div class='col-xs-12 col-lg-3'>
            <form method="POST" action="{{ route('time.destroy', 
              ['id'=>$time_period->id]) }}" class='inline' >
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type='submit' class='btn btn-danger' />
                    x
                </button>
                {{ date("H:i", strtotime($time_period->start)) }} - 
            </form>
            @if ($time_period->end==0)
                <form method="POST" action="{{ route('time.update', 
                  ['id'=>$time_period->id]) }}" class='inline'>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type='hidden' name='when' value='now' />
                    <button type='submit' class='btn btn-default'/>
                        Now
                    </button>
                </form>
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
        <div class='col-lg-9 col-xs-8'>
            <button id='showNewTasks{{$time_period->id}}'
              class='showNewTasks btn btn-primary'>
                Task
            </button>
            <button id='showNewTimePeriodNote{{$time_period->id}}'
              class='showNewTimePeriodNote btn btn-primary'>
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
            <form  method="POST" action="{{ route('time.update', 
              ['id'=>$time_period->id]) }}" class='pull-left'>
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                @include ('timeSelect', ["timestamp_type"=>"newEnd", 'radio'=>false])
                <input type='hidden' name='when' value='timestamp' />
                <input type='submit' value='Submit' class='pull-left'/>
            </form>
        </div>
    @endif
    <div id='newTimePeriodNote{{ $time_period->id }}' 
      class='newTimePeriodNote clearfix hidden'>
        <form method="POST" action="{{ route('TimePeriodNote.store') }}"
          class='inline'>
            {{ csrf_field() }}
            <input type='hidden' name='timePeriodID' 
              value='{{ $time_period->id }}' />
            <textarea name='newTimePeriodNote' class='form-control'></textarea>
            <button type='submit' class='btn btn-info'>
                Add Note
            </button>
        </form>
        <button id='hideNewTimePeriodNote{{$time_period->id}}' 
          class='hideNewTimePeriodNote btn btn-info'>
            Cancel
        </button>
    </div>
    <div class='listOfActiveTasks clear'>
        @foreach ($time_period->notes as $time_period_note)
            <form method="POST" action="{{ route('TimePeriodNote.destroy', 
              ['id'=>$time_period_note->id]) }}" class='margin-left-3 bg-info text-muted'>
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
            <div class='task clearfix padding-left-3'>
                <div class='col-xs-8 col-lg-3'>
                    <form method="POST" action="{{ route('task.destroy', 
                      ['id'=>$task->id]) }}" class='inline text-info'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type='submit' class='delete btn btn-danger'>
                            x
                        </button>
                        {{ $task->type->name }}
                    </form>
                </div>
                <div class='col-xs-4 col-lg-9'>
                    <button id='showNewTaskNotes{{ $task->id }}'
                      class='showNewTaskNotes btn btn-info margin-left'>
                        Note
                    </button>
                </div>
            </div>
            <div>
                <form id='newTaskNote{{ $task->id }}' method="POST"
                  action="{{ route('TaskNote.store') }}"
                  class='newTaskNote hidden' style='display:inline;'>
                    {{ csrf_field() }} 
                    <input type='hidden' name='taskID' value='{{ $task->id }}' />
                    <textarea name='newTaskNote' class='form-control'></textarea>
                    <button type='submit' class='btn btn-info'>
                        Create Note
                    </button>
                </form>
                <button id='hideNewTaskNotes{{ $task->id }}' 
                  class='hideNewTaskNotes btn btn-info hidden'>
                    Cancel
                </button>
            </div>
            @foreach ( $task->notes as $note )
                <form method="POST" action="{{ route('TaskNote.destroy', 
                  ['id'=>$note->id]) }}"  
                  class='taskNote bg-info text-muted margin-left-7'>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type='submit' class='delete btn btn-danger'>
                        x
                    </button>
                    {{ $note->report }}
                    <i class='small'>
                        ( Created - 
                        {{ date("m/d/y g:i", strtotime($note->created_at)) }} )
                    </i>
                </form>
            @endforeach
        @endforeach
        </div>
    </div>
@endforeach
