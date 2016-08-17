@foreach ($person_types as $person_type)
    <form method="POST" action="{{route('person.store')}}" class='inline'>
        {{csrf_field()}}
        <input type='hidden' name='personTypeID' value='{{$person_type->id}}'/>
        <input type='hidden' name='timePeriodID' value='{{$time_period_id}}' />
        <input type='hidden' name='taskID' value='{{$task_id}}' />
        <input type='submit' value='{{$person_type->name}}' class='btn btn-success'>
    </form>
@endforeach
