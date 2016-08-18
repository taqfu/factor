<?php
    use App\TaskCategoryType;
    use App\TaskType;
?>
@extends('master')

@section('content')
    <h1 id='show-edit-name' class='text-center '>
        {{$task_category_type->name}} - 
        {{TaskCategoryType::total_hours($task_category_type->id)}} hours
    </h1>
    <h1>
        @include('TaskCategoryType.edit')
    </h1>
    <h3 class='margin-left margin-bottom'> 
        <a href="{{route('time.index')}}">Home</a>
        <form method="POST" action="{{route('TaskCategoryType.destroy', 
          ['id'=>$task_category_type->id])}}" class='inline' role='form'>
            {{csrf_field()}}
            {{method_field('delete')}}
            <input type='submit' value='Delete' style='font-size:1em' class='btn btn-link' />
        </form>
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
