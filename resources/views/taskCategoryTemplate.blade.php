
<div>
    <form method="POST" action=" {{ route('TaskType.destroy', ['id'=>$task_type->id]) }}" style='float:left;'
        onsubmit="return confirm('Are you sure you want to delete \'{{ $task_type->name }}\'');">
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <input type='submit' value='x' class='textButton delete' />
    {{ $task_type->name }}
    </form>
    @foreach ($task_type->categories as $task_type_category)
    <div style='float:left;margin-left:16px;margin-right:8px;font-style:italic;color:grey;'>
            @if ($task_type_category->type->id!=1)
            <form method='POST' action="{{ route('TaskCategory.destroy', ['id'=>$task_type_category->id]) }}" style='float:left;'>
                {{csrf_field() }}
                {{ method_field('DELETE') }}
                <input type='submit' value='x' class='textButton delete' />
                {{ $task_type_category->type->name }} 
            </form>
            @endif
    </div>
    <div id='newTaskCategory{{ $task_type->id}}' class='newTaskCategory clear' style='margin-bottom:8px;'> 
        <form method="POST" action="{{ route('TaskCategory.store') }}" style=''>
        {{ csrf_field() }}
        <input type='hidden' name='newTaskTypeID' value='{{ $task_type->id }}' />
        <select name='newTaskCategoryTypeID'>
        @foreach ($task_category_types as $task_category_type)
            <option value='{{ $task_category_type->id }}'>
                {{ $task_category_type->name }}
            </option>
        @endforeach
        </select>
        <input type='submit' value='Add' />
        <input type='button' id='hideNewTaskCategory{{ $task_type->id }}' class='hideNewTaskCategory textButton' value='[ Hide ]' />
        </form>
    </div>
    @endforeach 
    <input type='button' id='showNewTaskCategory{{ $task_type->id }}' class='showNewTaskCategory textButton' value='[ New ]' />
</div>
