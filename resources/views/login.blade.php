<form id='login' role="form" method="POST" action="{{ url('/login') }}" class='text-center'>
    {{csrf_field()}}
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
    <input type='button' id='sign-up-button' class='btn' value='Sign Up' />
    <button class='btn'>
        Login
    </button>
</form>
<div>
    <a href="redirect">FB Login</a>
</div>        