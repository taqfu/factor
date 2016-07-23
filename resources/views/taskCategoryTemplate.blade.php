<?php
    use App\TaskType;
?>
<div class='clearfix'>
    <div class='bg-primary clearfix'>
        <form method="POST" action=" {{ route('TaskType.destroy', 
          ['id'=>$task_type->task_type_id]) }}" onsubmit="return 
          confirm('Are you sure you want to delete \'{{ $task_type->name }}\'');"
          class='inline' >
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <button type='submit' class='btn btn-danger'>
                x
            </button>
            {{ $task_type->name }} 
            ({{round(TaskType::total_time($task_type->task_type_id)/60/60, 1)}})
        </form>
        <button id='showNewTaskCategory{{ $task_type->task_type_id }}' 
          class='showNewTaskCategory btn btn-success'>
            New
        </button>
        <button id='hideNewTaskCategory{{ $task_type->task_type_id }}'
          class='hideNewTaskCategory btn btn-success hidden'>
            Hide
        </button>
    </div>
    <form method="POST" action="{{ route('TaskCategory.store') }}"
      id='newTaskCategory{{ $task_type->task_type_id}}'
      class='newTaskCategory hidden'>
        {{ csrf_field() }}
        <input type='hidden' name='newTaskTypeID' 
          value='{{ $task_type->task_type_id }}' />
        <select name='newTaskCategoryTypeID' class='form-control'>
            @foreach ($task_category_types as $task_category_type)
                <option value='{{ $task_category_type->id }}'>
                    {{ $task_category_type->name }}
                </option>
            @endforeach
        </select>
        <button type='submit' class='btn btn-primary'>
            Add
        </button>
    </form>
    @foreach ($task_type->categories as $task_type_category)
        @if ($task_type_category->type->id!=1)
        <form method='POST' action="{{ route('TaskCategory.destroy', 
          ['id'=>$task_type_category->id]) }}" 
          class='clearfix margin-left-3 text-muted'>
            {{csrf_field() }}
            {{ method_field('DELETE') }}
            <button type='submit' class='btn btn-danger'>
                x
            </button>
            {{ $task_type_category->type->name }}  
        </form>
        @endif
    @endforeach 
</div>
