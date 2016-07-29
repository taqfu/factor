@foreach ($task_types as $task_type)
    <div class='clearfix'>
        <div class='bg-primary clearfix'>
            @include('TaskType.destroy')
            <button id='showNewTaskCategory{{ $task_type->task_type_id }}' 
              class='showNewTaskCategory btn btn-success'>
                New
            </button>
            <button id='hideNewTaskCategory{{ $task_type->task_type_id }}'
              class='hideNewTaskCategory btn btn-success hidden'>
                Hide
            </button>
        </div>
        @include ('TaskCategory.store')
        @foreach ($task_type->categories as $task_type_category)
            @if ($task_type_category->type->id!=1)
                @include('TaskCategory.destroy')
            @endif
        @endforeach 
    </div>
@endforeach

