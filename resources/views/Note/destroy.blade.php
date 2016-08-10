<form method="POST" action="{{ route('note.destroy', ['id'=>$note->id]) }}" 
  class='text-muted {{$type}} inline clearfix'><i>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type='submit' class='delete btn btn-danger pull-left'>
        x
    </button>
    <div class='col-lg-6'>
        {{ $note->report }}
    </div>
</i></form>
