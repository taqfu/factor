<?php
  $task_type_id = isset ($task_type->task_type_id) ? $task_type->task_type_id : $task_type->id;
  $task_type_categories = isset($task_type->task_type_id)
    ? $task_type->categories
    : $task_type->categories_all;
?>
@foreach ($task_types as $task_type)
    <div class='clearfix'>
        <div class='bg-primary clearfix'>
            @include('TaskType.destroy')
            <button id='showNewTaskCategory{{ $task_type_id }}'
              class='showNewTaskCategory btn btn-success'>
                New
            </button>
            <button id='hideNewTaskCategory{{ $task_type_id }}'
              class='hideNewTaskCategory btn btn-success hidden'>
                Hide
            </button>
        </div>
        @include ('TaskCategory.store')

        @foreach ($task_type_categories as $task_type_category)
                @include('TaskCategory.destroy')
        @endforeach
    </div>
@endforeach
