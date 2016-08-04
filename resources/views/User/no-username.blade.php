@extends('master')

@section('content')
    <form method='post' action="">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <h4 class='text-center'>
            You don't have a username. Please pick one please.
        </h4>
        <label>
            Proposed Username:
            <input type='text' name='new_username' />
        </label>
        <button>
            Claim Username
        </button>
        <input type='button' value="I don't care!" />
        
    </form>
@endsection

