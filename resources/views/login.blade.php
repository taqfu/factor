<div id='login' class='margin-top'>
    <form role="form" method="POST" action="{{ url('/login') }}" class='text-center hidden' id='email-login'>
        {{csrf_field()}}
        <div class="row form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <label class="col-md-5 text-right control-label">Username</label>
    
            <div class="col-md-2">
                <input type="text" class="form-control" name="username" 
                  value="{{ old('username') }}">
    
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
    <div class='text-center'>
        Log In Using:
        <a href="redirect/facebook">Facebook</a> / 
        <a href="redirect/twitter">Twitter</a> /
        <a href="redirect/google" >Google</a> /
        <a href="#"  id='show-email-login'
          onclick="
            $('#email-login').removeClass('hidden');
            $('#hide-email-login').removeClass('hidden');
            $('#show-email-login').addClass('hidden');
          ">E-mail</a>
        <a href="#"  id='hide-email-login' class='hidden'
          onclick="
            $('#email-login').addClass('hidden');
            $('#hide-email-login').addClass('hidden');
            $('#show-email-login').removeClass('hidden');
          ">Hide E-mail</a>
        
    </div>        
</div>
