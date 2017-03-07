<form method="POST" action="{{ route('note.destroy', ['id'=>$note->id]) }}"
  class='text-muted {{$type}} inline hidden'><i>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type='submit' class='delete btn btn-danger'>
        x
    </button>

</i></form>
