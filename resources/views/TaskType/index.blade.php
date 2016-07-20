<div id='taskTypeSection'class='fix-clear bg-info hidden'>
    <form method="POST" action="{{ route('TaskType.store') }}" role='form'>
        {{ csrf_field () }}
        <input type='text' name='newTaskName' />
        <input type='submit' value='Create New Task' />
    </form>
    <div class='text-center'>
        <button id='taskCategoryType1' 
          class='btn-link activeTaskCategoryType taskCategoryType'>
            [ All ]
        </button>
        @foreach ($task_category_types as $task_category_type)
        <button id='taskCategoryType{{$task_category_type->id}}'
          class='btn-link taskCategoryType'>
            [ {{ $task_category_type->name }} ]
        </button>
        @endforeach
            <button id='showNewTaskCategoryType' class='btn-link'>
                [ New Task Category ]
            </button>
    </div>
    <form id='newTaskCategoryType' method='POST' 
      action="{{ route('TaskCategoryType.store') }}" role='form' 
      class='hidden pull-left'>
        {{ csrf_field() }}
        <input type='text' name='newTaskCategoryTypeName' />
        <button type='submit'>
            Create Task Category
        </button>
    </form>
        <button id='hideNewTaskCategoryType' class='hidden pull-left'>
            Cancel
        </button>
    <div id='listOfNewTaskTypes'>
    </div>
</div>
