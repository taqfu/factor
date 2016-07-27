<form method="POST" action="{{ route('time.destroy', 
  ['id'=>$time_period->id]) }}" class='inline' >
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type='submit' class='btn btn-danger' />
        x
    </button>
    {{ date("H:i", strtotime($time_period->start)) }} - 
</form>
