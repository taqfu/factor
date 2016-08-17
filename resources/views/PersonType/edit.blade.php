<form method="POST" action="{{route('PersonType.update', ['id'=>$person_type->id])}}" role='form' 
  id='edit-name' class='hidden text-center'>
    {{csrf_field()}}
    {{method_field("PUT")}}
    <textarea name="name" class='form-control text-center'>{{$person_type->name}}</textarea>
    <div class='form-group'>
        <div class='col-xs-6'>
            <input type='button' value='Cancel' class='btn btn-default form-control' 
              id='hide-edit-name'/>
        </div>
        <div class='col-xs-6'>
            <input type='submit' value='Change Name' class='btn btn-default col-xs-6 form-control'/>
        </div>
    </div>
</form>
