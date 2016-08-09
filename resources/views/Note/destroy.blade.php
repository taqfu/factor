<form method="POST" action="{{ route('note.destroy', ['id'=>$note->id]) }}" 
  class='text-muted {{$type}} inline clearfix'><i>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type='submit' class='delete btn btn-danger'>
        x
    </button>
    {{ $note->report }}
    <span class='small'>
        ( Created - 
        {{ date("m/d/y g:i", strtotime($note->created_at)) }} )
    </span>
</i></form>
