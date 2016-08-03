<?php
    use App\TimePeriod;
    $last_date = 0;
    
?>
@extends('master')

@section('content')
    <h1 class='text-center'>{{$task_type->name}}</h1>

@foreach($tasks as $task)
    <?php 
        $date = date("m/d/y", strtotime($task->time_period->start));
        $start_time = date("H:i", strtotime($task->time_period->start));
        $end_time = date("H:i", strtotime($task->time_period->end));
    ?>
    
    @if ($last_date != $date)
        <h3>{{$date}}</h3>
        <?php $last_date = $date; ?>
    @endif
    <div>
        @if ($task->time_period->end!=0)
            {{$start_time}} -  {{$end_time}} 
            ({{TimePeriod::format_interval($task->time_period->start, $task->time_period->end)}})
        @else
            {{$start_time}} - ongoing
            ({{TimePeriod::format_interval($task->time_period->start, 'now')}})
        @endif
    </div>    
    <ul>
        @foreach ($task->notes as $note)
            <li><i>
                {{$note->report}}
            </i></li>
        @endforeach
    </ul>
@endforeach
@endsection
