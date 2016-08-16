<form method="POST" action="{{route('PersonType.destroy', ['id'=>$person_type->id])}}" class='inline margin-right'>
    {{csrf_field()}}
    {{method_field("delete")}}
    <input type='submit' class='btn btn-danger' value='x' />
    {{$person_type->name}}
</form>
