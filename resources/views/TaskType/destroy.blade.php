<?php
    use App\TaskType;
?>
<form method="POST" action=" {{ route('TaskType.destroy', ['id'=>$task_type->task_type_id]) }}"
  onsubmit="return confirm('Are you sure you want to delete \'{{ $task_type->name }}\'');"
  class='inline' >
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <button type='submit' class='btn btn-danger'>
        x
    </button>
    {{ $task_type->name }} 
    @if (isset($task_type->task_type_id))
    ({{round(TaskType::total_time($task_type->task_type_id)/60/60, 1)}})
    @elseif (isset($task_type->id))
    ({{round(TaskType::total_time($task_type->id)/60/60, 1)}})
    @endif
</form>
