<div id='taskTypeSection'class='fix-clear bg-info hidden'>
    @include ('TaskType.store')
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
        @include ('TaskCategoryType.store')
    </div>
    <div id='listOfNewTaskTypes'>
    </div>
</div>
