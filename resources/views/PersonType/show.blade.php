<?php
    use App\TimePeriod;
?>
@extends('master')
@section('content')
    <h1  id='show-edit-name' class='text-center'>
        {{$person_type->name}}
    </h1>
    <h1>
        @include ('PersonType.edit')
    </h1>
    <h3 class='margin-bottom'> 
        <a href="{{route('time.index')}}">Home</a>
    </h3>
    @foreach ($people as $person)
        @if($person->task_id>0)
            {{date("m/d/y H:iA", strtotime($person->task->time_period->start))}}
            (
            <strong>
                {{TimePeriod::format_interval( $person->task->time_period->start, 
                $person->task->time_period->end)}}
            </strong>
            ) - 

            {{$person->task->type->name}}
        @else
            {{$person->time_period->start}} - {{$person->time_period->end}}
        @endif
    @endforeach
@endsection
