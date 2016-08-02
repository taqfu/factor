<form method="POST" action="{{ route('note.store') }}" class='inline'>
    {{ csrf_field() }}
    <input type='hidden' name='taskID' value='{{ $task_id }}' />
    <input type='hidden' name='timePeriodID' value='{{ $time_period_id }}' />
    <textarea name='report' class='form-control'></textarea>
    <button type='submit' class='btn btn-info'>
        Add Note
    </button>
</form>
<button id='
  @if ($time_period_id>0)
      hideNewTimePeriodNote{{$time_period_id}}' class='hideNewTimePeriodNote
  @elseif($task_id>0)
      hideNewTaskNote{{$task_id}}' class='hideNewTaskNote
  @endif
  btn btn-info'>
    Cancel
</button>
