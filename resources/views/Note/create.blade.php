<form method="POST" action="{{ route('note.store') }}" class='inline'>
    {{ csrf_field() }}
    <input type='hidden' name='taskID' value='{{ $task_id }}' />
    <input type='hidden' name='timePeriodID' value='{{ $time_period_id }}' />
    <textarea name='report' class='form-control'></textarea>
    <button type='submit' class='btn btn-info'>
        Add Note
    </button>
</form>
