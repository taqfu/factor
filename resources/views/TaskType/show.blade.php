<?php
    use App\TaskType;
    use App\TaskCategoryType;
    use App\TimePeriod;
    $last_date = 0;
    $today = date('m/d/y');
?>
@extends('master')

@section('content')
    <h1 class='text-center'>
        {{$task_type->name}} - 
        {{TaskType::total_hours($task_type->id)}} hours
    </h1>
    <h3 class='margin-left margin-bottom'> 
        <a href="{{URL::previous()}}">Back</a>
    </h3>
    <h4 class='margin-left'>Categories:</h4> 
    <ul class='margin-left'>
    @forelse($tasks->first()->type->categories_all as $task_category)
        <li>
            <a href="{{route('TaskCategoryType.show', ['id'=>$task_category->type->id])}}">
                {{$task_category->type->name}}  
            </a>
            - {{TaskCategoryType::total_hours($task_category->type->id)}} hours
        </li>
    @empty
        <li>
            None
        </li>
    @endforelse
    </ul>
@foreach($tasks as $task)
    <?php 
        $date = date("m/d/y", strtotime($task->time_period->start));
        $start_time = date("H:i", strtotime($task->time_period->start));
        $end_time = date("H:i", strtotime($task->time_period->end));
        $daily_hours = 
          TaskType::daily_hours(date('Y-m-d', strtotime($task->time_period->start)), $task_type->id);
    ?>
    
    @if ($last_date != $date)
        <h2 class='text-center'>
            {{$date}}
            @if ($date != $today)
             - {{$daily_hours}} hours 
            @endif
        </h2>
        <?php $last_date = $date; ?>
    @endif
    <div class='lead margin-left'>
        @if ($task->time_period->end!=0)
            {{$start_time}} -  {{$end_time}} 
            <i>
            ({{TimePeriod::format_interval($task->time_period->start, $task->time_period->end)}})
            </i>
        @else
            {{$start_time}} - ongoing
            <i>
            ({{TimePeriod::format_interval($task->time_period->start, 'now')}})
            </i>
        @endif
    </div>    
    @if (count($task->time_period->tasks)>1)
        <div class='margin-left'><strong>
        Other activity:
        </strong></div>
        <ul class='margin-left'>
        @foreach($task->time_period->tasks as $time_period_task)
            @iF ($time_period_task->type_id != $task->type_id)
                <li>
                {{$time_period_task->type->name}}
                </li>
            @endif
        @endforeach
        </ul>
    @endif
    <ul class='list-group margin-left'>
        @foreach ($task->notes as $note)
            <li class='list-group-item' title='Created {{$note->created_at}}'><i>
                {{$note->report}}
            </i></li>
        @endforeach
    </ul>
@endforeach
@endsection
