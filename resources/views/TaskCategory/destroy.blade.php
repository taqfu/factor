<form method='POST' action="{{ route('TaskCategory.destroy', 
  ['id'=>$task_type_category->id]) }}" class='clearfix margin-left-3 text-muted'>
    {{csrf_field() }}
    {{ method_field('DELETE') }}
    <button type='submit' class='btn btn-danger'>
        x
    </button>
    {{ $task_type_category->type->name }}  
</form>
