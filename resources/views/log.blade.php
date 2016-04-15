@extends ('master')

@section ('content')
<div class='newLog'>
<form method="POST" action="{{ route('log.store') }}" class='newLog'>
    {{ csrf_field () }}
    <textarea name='newEntry' class='newLog'></textarea>
    <input type='submit' value='New Log Entry' class='newLog' />
</form>
</div>


@foreach ($log_entries as $log)
    <div>
        <form method="POST" action="{{ route('log.destroy', ["id"=>$log->id]) }}" class='deleteLog'>
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type='submit' value='x' class='textButton deleteLog'/>
        </form>
        <div class='logEntry'>
            {{ $log->entry }}
            <div class='logDate'>
                {{ date("y/m/d g:i", strtotime($log->created_at)) }}
            </div>
        </div>
    </div>
@endforeach

@endsection
