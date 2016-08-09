<?php
    use App\TaskType;
    use App\TimePeriod;
    $last_date = 0;
    $today = date('m/d/y');
?>
@extends('master')

@section('content')
    <h1 class='text-center'>
        {{$task_type->name}}<br>
        {{TaskType::total_hours($task_type->id)}} hours
    </h1>
    <h3>
        <a href="{{URL::previous()}}">Back</a>
    </h3>
@foreach($tasks as $task)
    <?php 
        $date = date("m/d/y", strtotime($task->time_period->start));
        $start_time = date("H:i", strtotime($task->time_period->start));
        $end_time = date("H:i", strtotime($task->time_period->end));
        $daily_hours = 
          TaskType::daily_hours(date('Y-m-d', strtotime($task->time_period->start)), $task_type->id);
    ?>
    
    @if ($last_date != $date)
        <h3>
            {{$date}}
            @if ($date != $today)
             - {{$daily_hours}} hours 
            @endif
        </h3>
        <?php $last_date = $date; ?>
    @endif
    <div class='margin-left'>
        @if ($task->time_period->end!=0)
            {{$start_time}} -  {{$end_time}} 
            ({{TimePeriod::format_interval($task->time_period->start, $task->time_period->end)}})
        @else
            {{$start_time}} - ongoing
            ({{TimePeriod::format_interval($task->time_period->start, 'now')}})
        @endif
    </div>    
    <ul class='margin-left'>
        @foreach ($task->notes as $note)
            <li><i>
                {{$note->report}}
            </i></li>
        @endforeach
    </ul>
@endforeach
@endsection
