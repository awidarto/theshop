@layout('public')
@section('content')

<h4 class="headIpaSite">{{$title}}</h4>
<div class="row">
    {{ Form::open('reset') }}
    <!-- check for login errors flash var -->
    @if (Session::has('login_errors'))
        <div class="alert alert-error">
             <button type="button" class="close" data-dismiss="alert"></button>
             Email or password incorrect.
        </div>
    @endif
    <!-- username field -->
    {{ $form->text('email','Email.req','',array('class'=>'text','id'=>'email')) }}
    <!-- password field -->
    <!-- submit button -->
    {{ Form::submit('Reset Password',array('class' => 'button')) }}
    {{ Form::close() }}

    
</div>
@endsection