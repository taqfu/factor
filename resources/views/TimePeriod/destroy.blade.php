<?php
    use App\User;
?>
<form id='destroy-time-period{{$time_period->id}}' method="POST" action="{{ route('time.destroy',
  ['id'=>$time_period->id]) }}" class='inline'  >
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input id="delete-element-destroy-time-period{{$time_period->id}}" type="button" class="btn-danger pull-left delete-element-button" value="Delete">

</form>
