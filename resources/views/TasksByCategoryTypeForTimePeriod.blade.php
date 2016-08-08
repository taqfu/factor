<?php use App\TaskType; ?>
<!-- This is the Task menu. -->
<input type='hidden' id='timePeriodIDForListOfNewTasks' value='{{ $time_period_id }}' />
<div class='text-center'>
    <button id='hideNewTasks{{$time_period_id}}' class='hideNewTasks btn btn-primary'>
        Hide Tasks
    </button>
</div>
<div class='text-center bg-info page-header'>
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
</div>
<div class='text-center'>
@foreach($task_types as $task_type)

    @if (isset($task_type->task_type_id))
        <button type='submit' id='newTask{{$task_type->task_type_id}}' 
          class='btn btn-success newTask'>
            {{ $task_type->name }}
        </button>
        <input type='hidden' id='task-time-period{{$task_type->task_type_id}}' 
          value='{{$time_period_id}}' />
    @else 
        <button type='submit' id='newTask{{$task_type->id}}' 
          class='btn btn-success newTask'>
            {{ $task_type->name }}
        </button>
        <input type='hidden' id='task-time-period{{$task_type->id}}' 
          value='{{$time_period_id}}' />
    @endif
@endforeach
</div>
