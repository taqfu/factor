
<form method="POST" action="{{ route('time.store') }}" role='form' >
{{ csrf_field() }}
<div id='startTimestamp' class='inline'>
    <h3>
    Start
    </h3>
    <div>
        <input type='radio' name='startWhen' value='now' checked/> Now
    </div>
    <div>
        @include ('timeSelect', ["timestamp_type"=>"start"])
    </div>
</div>
<div id='endTimestamp' class='inline'>
    <h3>
    End
    </h3>
    <div>
        <input type='radio' name='endWhen' value='now' /> Now
    </div>
    <div>
        <input type='radio' name='endWhen' value='unspecific' checked/> Specify Later
    </div>
    <div>
        @include ('timeSelect', ["timestamp_type"=>"end"])
    </div>
</div>
<input type='hidden' name='test' value='test' />
<div class='inline text-center'>
    <input id='createNewTimePeriod' type='submit' value='Create New Time Period' />
</div>
</form>
