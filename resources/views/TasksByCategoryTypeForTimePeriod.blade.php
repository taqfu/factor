<?php use App\TaskType; ?>
<!-- This is the Task menu. -->
<input type='hidden' id='timePeriodIDForListOfNewTasks' value='{{ $time_period_id }}' />
<div class='text-center page-header'>
    @if ($active_task_category_type_id=='all')
      <button id='taskCategoryTypeForTimePeriodall'
        class="btn btn-link activeTaskCategoryTypeForTimePeriod"><strong>
          All
      </strong></button>
    @else
      <button id='taskCategoryTypeForTimePeriodall'
        class="btn btn-link taskCategoryTypeForTimePeriod">
          All
      </button>
    @endif
    @foreach ($task_category_types as $task_category_type)
        @if ($task_category_type->id == $active_task_category_type_id)
            <button id='taskCategoryTypeForTimePeriod{{$task_category_type->id}}'
              class='activeTaskCategoryTypeForTimePeriod btn btn-link'>
                <strong>
                    {{ $task_category_type->name }}
                </strong>
            </button>
        @else
            <button id='taskCategoryTypeForTimePeriod{{$task_category_type->id}}'
              class='taskCategoryTypeForTimePeriod btn btn-link'>
                {{ $task_category_type->name }}
            </button>
        @endif
    @endforeach
    <div class='text-center'>
    @foreach($task_types as $task_type)

        @if (isset($task_type->task_type_id))
            @if(in_array($task_type->task_type_id, $active_task_types))
                <button type='submit' id='delete-task{{$task_type->task_type_id}}'
                  class='btn  btn-danger delete-task'>
            @else
                <button type='submit' id='newTask{{$task_type->task_type_id}}'
                  class='btn  btn-success newTask'>
            @endif
                {{ $task_type->name }}
            </button>
            <input type='hidden' id='task-time-period{{$task_type->task_type_id}}'
              value='{{$time_period_id}}' />
        @else
            @if(in_array($task_type->id, $active_task_types))
                <button type='submit' id='delete-task{{$task_type->id}}'
                  class='btn btn-danger delete-task'>
            @else
                <button type='submit' id='newTask{{$task_type->id}}'
                  class='btn  btn-success newTask'>
            @endif
                {{ $task_type->name }}
            </button>
            <input type='hidden' id='task-time-period{{$task_type->id}}'
              value='{{$time_period_id}}' />
        @endif
    @endforeach
    </div>
</div>
