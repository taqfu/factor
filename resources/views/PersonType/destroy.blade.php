<form method="POST" action="{{route('PersonType.destroy', ['id'=>$person_type->id])}}" class='inline margin-right'>
    {{csrf_field()}}
    {{method_field("delete")}}
    <input type='submit' class='btn btn-danger' value='x' />
    <a href="{{route('PersonType.show', ['id'=>$person_type->id])}}">
        {{$person_type->name}}
    </a>
</form>
