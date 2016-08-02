<form method="POST" action="{{ route('note.destroy', ['id'=>$note->id]) }}" 
  class='bg-info text-muted {{$type}} inline clearfix'>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type='submit' class='delete btn btn-danger'>
        x
    </button>
    {{ $note->report }}
    <i class='small'>
        ( Created - 
        {{ date("m/d/y g:i", strtotime($note->created_at)) }} )
    </i>
</form>
