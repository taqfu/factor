<div class="">
    &nbsp;
    <a href="#">Back</a>
    <a href="#" id="close-time-period-menu"class='pull-right margin-right'>X</a>
</div>
<form method="POST" action="{{ route('note.store') }}" class='inline'>
    {{ csrf_field() }}
    <input type='hidden' name='taskID' value='{{ $task_id }}' />
    <input type='hidden' name='timePeriodID' value='{{ $time_period_id }}' />
    <textarea name='report' class='form-control' rows='16' class="col-xs-10"as></textarea>
    <button type='submit' class='btn btn-info pull-right'>
        Add Note
    </button>
</form>
