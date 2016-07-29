<form method="POST" action="{{ route('TaskType.store') }}" role='form'>
    {{ csrf_field () }}
    <input type='text' name='newTaskName' />
    <select name='defaultTaskCategoryType'>
        <option value='NULL'>No Default</option>
        @foreach($task_category_types as $task_category_type)
            <option value="{{$task_category_type->id}}">
                {{$task_category_type->name}}
            </option>
        @endforeach
    </select>
    <button type='submit' class='btn btn-success'>
        Create New Task
    </button>
</form>
