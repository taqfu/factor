<?php 
    use App\User;
?>
<form id='destroy-time-period{{$time_period->id}}' method="POST" action="{{ route('time.destroy',
  ['id'=>$time_period->id]) }}" class='inline'  >
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type='button' id='delete-element-destroy-time-period{{$time_period->id}}' class='btn btn-danger delete-element-button' value="x"/>
    {{ date("H:i", User::local_time(Auth::user()->timezone, strtotime($time_period->start)))  }} -

</form>
