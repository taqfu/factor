@if($task_category_type!="all")
<h3 class='text-center'>
  <a href="{{route('TaskCategoryType.show', ['id'=>$task_category_type->id])}}">
      {{ $task_category_type->name }}
  </a>
</h3>
@endif
@foreach ($task_types as $task_type)
<?php
  $task_type_id = isset ($task_type->task_type_id) ? $task_type->task_type_id : $task_type->id;
  $task_type_categories = isset($task_type->task_type_id)
    ? $task_type->categories
    : $task_type->categories_all;
?>
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
