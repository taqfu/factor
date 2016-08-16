<form method="POST" action="{{route('PersonType.store')}}">
    {{csrf_field()}}
    <input type='text' name='name' />
    <input type='submit' class='btn btn-success' value='Create New Person'/>
</form>
