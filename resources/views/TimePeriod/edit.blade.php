@if ($when=="now")
    <form method="POST" action="{{ route('time.update', 
      ['id'=>$time_period->id]) }}" class='inline'>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type='hidden' name='when' value='now' />
        <input type='submit' class='btn btn-default' value="Now"/>
    </form>
@elseif ($when=="specify")
    <form  method="POST" action="{{ route('time.update', 
      ['id'=>$time_period->id]) }}" class='pull-left'>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        @include ('timeSelect', ["timestamp_type"=>"newEnd", 'radio'=>false])
        <input type='hidden' name='when' value='timestamp' />
        <input type='submit' value='Submit' class='pull-left'/>
    </form>
@endif
