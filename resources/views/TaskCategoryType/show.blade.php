<?php
    use App\TaskCategoryType;
    use App\TaskType;
?>
@extends('master')

@section('content')
    <h1 class='text-center'>
        {{$task_category_type->name}} - 
        {{TaskCategoryType::total_hours($task_category_type->id)}} hours
    </h1>
    <h3 class='margin-left margin-bottom'> 
        <a href="{{URL::previous()}}">Back</a>
    </h3>
<ul>
@foreach($task_types as $task_type)
    <li>
        <a href="{{route('TaskType.show', ['id'=>$task_type->id])}}">
            {{$task_type->name}}
        </a>
        - {{TaskType::total_hours($task_type->task_type_id)}} hours 
    </li>
@endforeach
</ul>
@endsection
