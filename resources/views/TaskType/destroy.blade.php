<?php
    use App\TaskType;
    $task_type_id = isset($task_type->task_type_id) ? $task_type->task_type_id : $task_type->id; 
?>
<form method="POST" action=" {{ route('TaskType.destroy', ['id'=>$task_type_id])}}"
  onsubmit="return confirm('Are you sure you want to delete \'{{ $task_type->name }}\'');"
  class='inline' >
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <button type='submit' class='btn btn-danger'>
        x
    </button>
    <a href="{{route('TaskType.show', ['id'=>$task_type_id])}}" class='profile-link'>
        {{ $task_type->name }}
    </a>
</form>
