<form id='register' method="POST" action="{{url('/register')}}" class='text-center hidden'>
    @if (count($errors)>0)
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
    {{ csrf_field() }}
    <div class="row form-group{{ $errors->has('username') ? ' has-error' : '' }}">
        <label class="col-md-5 text-right control-label">Username</label>

        <div class="col-md-2">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}">

            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
        <div class='col-md-5'></div>
    </div>

    <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="col-md-5 text-right control-label">E-Mail Address</label>

        <div class="col-md-2">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class='col-md-5'></div>
    </div>

    <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="col-md-5 text-right control-label">Password</label>

        <div class="col-md-2">
            <input type="password" class="form-control" name="password">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class='col-md-5'></div>
    </div>

    <div class="row form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label class="col-md-5 text-right control-label">Confirm Password</label>

        <div class="col-md-2">
            <input type="password" class="form-control" name="password_confirmation">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
        <div class='col-md-5'></div>
    </div>

    <input type='button' id='hide-sign-up' class='btn' value='Cancel'>
    <button class='btn' type='submit'>
        Sign Up
    </button>
    
</form>
