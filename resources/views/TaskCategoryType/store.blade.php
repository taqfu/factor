<form  method='POST' action="{{ route('TaskCategoryType.store') }}" 
  role='form'>
    {{ csrf_field() }}
    <input type='text' name='newTaskCategoryTypeName'/>
    <button type='submit' class='btn btn-success'>
        Create Task Category
    </button>
</form>
