<form method="POST" action="{{ route('task.destroy', 
  ['id'=>$task->id]) }}" class='inline text-info'>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type='submit' class='delete btn btn-danger'>
        x
    </button>
    {{ $task->type->name }}
</form>
