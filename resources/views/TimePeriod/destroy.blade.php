<form method="POST" action="{{ route('time.destroy', 
  ['id'=>$time_period->id]) }}" class='inline' >
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type='submit' class='btn btn-danger' value="x"/>
    {{ date("H:i", strtotime($time_period->start)) }} - 
</form>
