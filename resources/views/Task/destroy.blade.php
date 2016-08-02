<form method="POST" action="{{ route('task.destroy', ['id'=>$task->id]) }}" class='inline' >
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type='submit' class='btn btn-danger'>
        x
    </button>
    {{ $task->type->name }}
</form>
