<?php
    $task_type_id = isset($task_type->task_type_id) ? $task_type->task_type_id : $task_type->id;
 ?>
<form method="POST" action="{{ route('TaskCategory.store') }}"
  id='newTaskCategory{{ $task_type_id}}' class='newTaskCategory hidden'>
    {{ csrf_field() }}
    <input type='hidden' name='newTaskTypeID' value='{{ $task_type_id }}' />
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
