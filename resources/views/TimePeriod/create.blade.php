
<form method="POST" action="{{ route('TimePeriod.store') }}" >
{{ csrf_field() }}
<div id='startTimestamp'>
    <div class='timestampHeader'>
    Start
    </div>
    <div>
        <input type='radio' name='startWhen' value='now' checked/> Now
    </div>
    <div>
        <input id='startTimestampSelect' type='radio' name='startWhen' value='timestamp' />
        @include ('timeSelect', ["timestamp_type"=>"start"])
    </div>
</div>
<div id='endTimestamp'>
    <div class='timestampHeader'>
    End
    </div>
    <div>
        <input type='radio' name='endWhen' value='now' /> Now
    </div>
    <div>
        <input type='radio' name='endWhen' value='unspecific' checked/> Specify Later
    </div>
    <div>
        <input id='endTimestampSelect' type='radio' name='endWhen' value='timestamp' />
        @include ('timeSelect', ["timestamp_type"=>"end"])
    </div>
</div>
<input type='hidden' name='test' value='test' />
<input id='createNewTimePeriod' type='submit' value='Create New Time Period' />
</form>
