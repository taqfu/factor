<form method="POST" action="{{ route('TaskNote.destroy', 
  ['id'=>$note->id]) }}"  
  class='taskNote bg-info text-muted margin-left-7'>
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
