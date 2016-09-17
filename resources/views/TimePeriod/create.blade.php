<form id='createTimePeriod' method="POST" action="{{ route('time.store') }}"
  class='menu-top ' role='form'>
    {{ csrf_field() }}
    <div class='container clear'>
        <div id='startTimestamp' class='container col-lg-3 col-xs-12 '>
            <h3 class='text-center'>Start</h3>
            <div>
                <input type='radio' name='startWhen' value='now' checked />
                Now -xyz
            </div>
            <div>
                @include ('timeSelect', ["timestamp_type"=>"start", 'radio'=>true])
            </div>
        </div>
        <div id='endTimestamp' class='container col-lg-3  '>
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
        <div class='col-lg-5 text-center col-xs-12'>
            <input type='hidden' name='test' value='test' />
            <button id='createNewTimePeriod' type='submit' class='btn btn-default'>
                Create New Time Period
            </button>
        </div>
    </div>
</form>
