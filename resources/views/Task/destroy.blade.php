    <div class='col-md-3'>
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
    </div><div>
        <span style='padding-left:15px;'>
                <button id='showNewTaskNotes{{ $task->id }}'
                  class='showNewTaskNotes btn btn-primary show-task-menu'>
                    Note
                </button>
                <button id='hideNewTaskNotes{{ $task->id }}'
                  class='hideNewTaskNotes btn btn-info hidden hide-task-menu'>
                    Hide
                </button>
                <button id='show-new-person-task{{$task->id}}'
                  class='show-new-person btn btn-primary show-task-menu'>
                    Person
                </button>
                <button id='hide-new-person-task{{$task->id}}'
                  class='hide-new-person btn btn-info hidden hide-task-menu'>
                    Hide
                </button>
        </span>
    </div>
