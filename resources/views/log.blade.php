@extends ('master')

@section ('content')
<div>
<a href="{{ route('log') }}">[ Today ]</a>
<a href="{{ route('log', ['period'=>'yesterday']) }}">[ Yesterday ]</a>
<a href="{{ route('log', ['period'=>'week']) }}">[ Week ]</a>
<a href="{{ route('log.all') }}">[ All ]</a>
</div>
<a href="{{ route('time') }} ">Time Log </a>
<div class='newLog'>
<form method="POST" action="{{ route('log.store') }}" class='newLog'>
    {{ csrf_field () }}
    <textarea name='newEntry' class='newLog'></textarea>
    <input type='submit' value='New Log Entry' class='newLog' />
</form>
</div>
<input type='button' id='showNewTagTypes' class='textButton' value='[ Show New Tags ]' />
<div id='listOfNewTagTypes'>
<input type='button' id='hideNewTagTypes' class='textButton' value='[ Hide New Tags ]' />
<form method='POST' action="{{ route('TagType.store') }}">
    {{ csrf_field() }}
    <input type='text' name='newTagName' />
    <input type='submit' value='New Tag' />
</form>
@foreach ($tag_types as $tag_type)
    <div class='clear'>
    <form method="POST" action="{{ route('TagType.destroy', ['id'=>$tag_type->id]) }}" class='delete'>
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type='submit' value='x' class='textButton delete' />
    </form>
    <div style='float:left'>
    {{ $tag_type->name }}
    </div>
    </div>
@endforeach
</div>
<?php 
    $old_date = 0;
    $old_time = 0;
?>
@foreach ($log_entries as $log)
    <a name='log{{$log->id}}'></a>
    <?php 
        $date = date("m/d/y", strtotime($log->created_at));
        $time = date("H:i", strtotime($log->created_at));
    ?>
    @if ($date!=$old_date)
        <h2 class='clear'> {{ $date }} </h2>
        <?php $old_date = $date ?>
    @endif
    @if ($time!=$old_time)
        <h3> {{ $time }} </h3>
        <?php $old_time = $time ?>
    @endif
    <div class='clear'>
        <form method="POST" action="{{ route('log.destroy', ["id"=>$log->id]) }}" class='deleteLog'>
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type='submit' value='x' class='textButton deleteLog'/>
        </form>
        <div class='logEntry'>
            {!! nl2br(rtrim($log->entry)) !!}
            <div class='logDate'>
            </div>
        </div>
        @include ('tags')
    </div>
@endforeach

@endsection
