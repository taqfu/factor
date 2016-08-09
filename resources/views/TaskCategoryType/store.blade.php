<form  method='POST' action="{{ route('TaskCategoryType.store') }}" role='form' class='inline'>
    {{ csrf_field() }}
    <input type='text' name='newTaskCategoryTypeName'/>
    <input type='button' id='hideNewTaskCategoryType' class='btn btn-success hidden' 
      value='Cancel' />
    <button type='submit' class='btn btn-success'>
        Create Task Category
    </button>
</form>
