<form method="POST" action="{{ route('note.destroy', ['id'=>$note->id]) }}" 
  class='text-muted {{$type}} inline'><i>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type='submit' class='delete btn btn-danger'>
        x
    </button>
    <span id='note-report{{$note->id}}' class='note-report'>
        {{ $note->report }}
    </span>
</i></form>
