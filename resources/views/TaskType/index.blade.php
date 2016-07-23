<div id='taskTypeSection'class='fix-clear bg-info hidden'>
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
    <div class='text-center'>
        <button id='taskCategoryType1' 
          class='btn-link activeTaskCategoryType taskCategoryType'>
            All
        </button>
        @foreach ($task_category_types as $task_category_type)
        <button id='taskCategoryType{{$task_category_type->id}}'
          class='btn-link taskCategoryType'>
            {{ $task_category_type->name }}
        </button>
        @endforeach
            <button id='showNewTaskCategoryType' class='btn-link'>
                [ New Task Category ]
            </button>
    </div>
    <div id='newTaskCategoryType' class='hidden text-center margin-top'>
        <form  method='POST' action="{{ route('TaskCategoryType.store') }}" 
          role='form'>
            {{ csrf_field() }}
            <input type='text' name='newTaskCategoryTypeName'/>
            <button type='submit' class='btn btn-success'>
                Create Task Category
            </button>
        </form>
        <button id='hideNewTaskCategoryType' class='hidden pull-left'>
            Cancel
        </button>
    </div>
    <div id='listOfNewTaskTypes'>
    </div>
</div>
