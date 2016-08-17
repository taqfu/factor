<form method="POST" action="{{route('PersonType.store')}}" class='bg-info'>
    {{csrf_field()}}
    <input type='text' name='name' />
    <input type='submit' class='btn btn-success' value='Create New Person'/>
</form>
