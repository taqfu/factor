<form method="POST" action="{{ route('task.destroy', ['id'=>$task->id]) }}" class='inline' >
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type='submit' class='btn btn-danger'>
        x
    </button>
    <a href="{{route('TaskType.show', ['id'=>$task->type_id])}}">
        {{ $task->type->name }}
    </a>
</form>
