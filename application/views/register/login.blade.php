@layout('public')
@section('content')

<h4 class="headIpaSite">Login Form</h4>
<div class="row">
    {{ Form::open('attendee/login') }}
    <!-- check for login errors flash var -->
    @if (Session::has('login_errors'))
        <div class="alert alert-error">
             <button type="button" class="close" data-dismiss="alert"></button>
             Email or password incorrect.
        </div>
    @endif
    <!-- username field -->
    {{ Form::label('username', 'Email') }}
    {{ Form::text('username') }}
    <!-- password field -->
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}
    <!-- submit button -->
    {{ Form::submit('Login',array('class' => 'button')) }}
    {{ Form::close() }}

    
</div>
@endsection