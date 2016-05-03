<div id='taskTypeSection' style=''>
    <form method="POST" action="{{ route('TaskType.store') }}" >
        {{ csrf_field () }}
        <input type='text' name='newTaskName' />
        <input type='submit' value='Create New Task' />
    </form>
    <input type='button' id='taskCategoryType1' class='textButton activeTaskCategoryType taskCategoryType' value='[ All ]' />
    @foreach ($task_category_types as $task_category_type)
    <input type='button' id='taskCategoryType{{$task_category_type->id}}' 
        class='textButton taskCategoryType' value='[ {{ $task_category_type->name }} ]' />
    @endforeach
    <input id='showNewTaskCategoryType' type='button' class='textButton' value='[ New Task Category ]' />
    <input id='hideNewTaskCategoryType' type='button' class='textButton' value='[ Cancel ]' />
    <form id='newTaskCategoryType' method='POST' action="{{ route('TaskCategoryType.store') }}">
        {{ csrf_field() }}
        <input type='text' name='newTaskCategoryTypeName' />
        <input type='submit' value='Create Task Category' />
    </form>
<div id='listOfNewTaskTypes'>
@foreach ($task_types as $task_type)
@include ('taskCategoryTemplate')
@endforeach
</div>
</div>
