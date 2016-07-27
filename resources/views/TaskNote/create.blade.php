<form method="POST" action="{{ route('TaskNote.store') }}" class='inline'>
    {{ csrf_field() }} 
    <input type='hidden' name='taskID' value='{{ $id }}' />
    <textarea name='newTaskNote' class='form-control'></textarea>
    <button type='submit' class='btn btn-info'>
        Create Note
    </button>
</form>
<button id='hideNewTaskNotes{{ $id }}' 
  class='hideNewTaskNotes btn btn-info'>
    Cancel
</button>
