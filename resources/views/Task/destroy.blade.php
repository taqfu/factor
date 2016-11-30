<form method="POST" action="{{ route('task.destroy', ['id'=>$task->id]) }}" class='inline' id='destroy-task{{$task->id}}'>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type='button' id='delete-element-destroy-task{{$task->id}}' class='btn btn-danger delete-element-button'>
        x
    </button>
    <a href="{{route('TaskType.show', ['id'=>$task->type_id])}}">
        {{ $task->type->name }}
    </a>
</form>
