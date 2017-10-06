
<form id='createTimePeriod' method="POST" action="{{ route('time.store') }}" class='hidden'
  role='form'>
    {{ csrf_field() }}
    <div class='row clear'>
        <div class='col-md-2'></div>
        <div class='col-md-2'>
            <button type='button' id='hideNewTimePeriod' class='btn btn-danger  btn-hide'>Hide</button>
        </div>
        <div id='startTimestamp' class='col-md-2'>
            <h3 class='text-center'>Start</h3>
            <div>
                <input type='radio' name='startWhen' value='now' checked />
                Now
            </div>
            <div>
                @include ('timeSelect', ["timestamp_type"=>"start", 'radio'=>true])
            </div>
        </div>
        <div id='endTimestamp' class='container col-md-2 '>
            <h3 class='text-center'>End</h3>
            <div>
                <input type='radio' name='endWhen' value='now' />
                Now
            </div>
            <div>
                <input type='radio' name='endWhen' value='unspecific' checked/>
                Specify Later
            </div>
            <div>
                @include ('timeSelect', ["timestamp_type"=>"end", 'radio'=>true])
            </div>
        </div>
        <div class='col-md-2 text-center '>
            <input type='hidden' name='test' value='test' />
            <button id='createNewTimePeriod' type='submit' class='btn btn-success'>
                Create
            </button>
        </div>
        <div class='col-md-2'></div>
    </div>
</form>
