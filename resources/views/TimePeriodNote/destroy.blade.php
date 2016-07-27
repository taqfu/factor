<form method="POST" action="{{ route('TimePeriodNote.destroy', 
  ['id'=>$time_period_note->id]) }}" class='margin-left-3 bg-info text-muted'>
    {{ csrf_field () }}
    {{ method_field('DELETE') }}
    <button type='submit' class='delete btn btn-danger'>
        x
    </button>
    <span class='timePeriodNote'>
        {{ $time_period_note->report }} 
        <span class='timePeriodNoteInfo'>
            (Created: 
            {{ date("m/d/y g:i", strtotime($time_period_note->created_at)) }})
        </span>
    </span>
</form>
