<div id='edit-note{{$note->id}}' class='hidden edit-note'>
    <form method="POST" action="{{ route('note.update', ['id'=>$note->id]) }}"/>

        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <textarea name='newReport' class='form-control'>{{ $note->report }}</textarea>
        <div class='text-right'>
        <input type='submit' class='btn btn-info' value='Submit' />
        <input type='button' id='cancel-edit-note{{$note->id}}' class='cancel-edit-note btn btn-info' value='Cancel' />
        </div>
    </form>
</div>
