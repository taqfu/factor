<form method="POST" action="{{ route('TimePeriodNote.store') }}"
  class='inline'>
    {{ csrf_field() }}
    <input type='hidden' name='timePeriodID' 
      value='{{ $id }}' />
    <textarea name='newTimePeriodNote' class='form-control'></textarea>
    <button type='submit' class='btn btn-info'>
        Add Note
    </button>
</form>
<button id='hideNewTimePeriodNote{{$id}}' 
  class='hideNewTimePeriodNote btn btn-info'>
    Cancel
</button>
