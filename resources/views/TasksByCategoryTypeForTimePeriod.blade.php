<input type='hidden' id='timePeriodIDForListOfNewTasks' value='{{ $time_period_id }}' />
<div style='text-align:center;margin-top:16px;margin-bottom:8px;'>
    @foreach ($task_category_types as $task_category_type)
        @if ($task_category_type->id == $active_task_category_type_id)
            <input type='button' id='taskCategoryTypeForTimePeriod{{$task_category_type->id}}' 
                class='textButton activeTaskCategoryTypeForTimePeriod' value='[ {{ $task_category_type->name }} ]' />
        @else
            <input type='button' id='taskCategoryTypeForTimePeriod{{$task_category_type->id}}' 
                class='textButton taskCategoryTypeForTimePeriod' value='[ {{ $task_category_type->name }} ]' />
        @endif
    @endforeach
</div>
<div style='margin-bottom:16px;'>
@foreach ($task_categories as $task_category)
    <form method='POST' action="{{ route('task.store') }}" >   
    {{ csrf_field () }}
    <input type='hidden' name='timePeriodID' value='{{ $time_period_id }}'/>
    <input type='hidden' name='typeID' value='{{ $task_category->task_type->id }}' />
    <input type='submit' value='{{ $task_category->task_type->name }}' class='textButton' />
    </form>
@endforeach
</div>