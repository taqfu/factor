<form method="POST" action="{{route('person.destroy', ['id'=>$person->id])}}" class='inline'>
    {{csrf_field()}}
    {{method_field('delete')}}
    <input type='submit' value='x' class='btn btn-danger' />
    <a href="{{route('PersonType.show', ['id'=>$person->type->id])}}">
        {{$person->type->name}}
    </a>
</form>
