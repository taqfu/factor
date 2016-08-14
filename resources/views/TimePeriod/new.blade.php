<form method="POST" action="{{route('time.store')}}" 
  class='inline' role='form'>
    {{csrf_field()}}
    <input type='hidden' name='startWhen' value='timestamp'/>
    <input type='hidden' name='endWhen' value='unspecific' />
    <input type='hidden' name='startYear' 
      value="{{date('Y', strtotime($time_period->end))}}" />
    <input type='hidden' name='startMonth' 
      value="{{date('m', strtotime($time_period->end))}}" />
    <input type='hidden' name='startDay'
      value="{{date('d', strtotime($time_period->end))}}" />
    <input type='hidden' name='startHour'
      value="{{date('H', strtotime($time_period->end))}}" />
    <input type='hidden' name='startMinute'
      value="{{date('i', strtotime($time_period->end))}}" />
    <button class='btn btn-primary'>
        New
    </button>
</form>
