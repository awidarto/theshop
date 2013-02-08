@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('register/payment','POST',array('class'=>'custom'))}}
<div class="row">
  <div class="twelve columns left">
    
    {{ $form->text('registNumberConfirm','Registration Number.req','',array('class'=>'auto_userdata text','id'=>'emp_fullname')) }}
    {{ $form->text('participantNameConfirm','Participant Name.req','',array('class'=>'auto_userdata text','id'=>'emp_fullname')) }}
    {{ $form->text('participantEmailConfirm','Participant Email.req','',array('class'=>'auto_userdata text','id'=>'emp_fullname')) }}
    {{ Form::label('toaccount','To Account')}}
    {{$form->select('toaccount','',Config::get('kickstart.accountpayment'),null,array('class'=>'four','id'=>'emp_department'))}}

    {{ Form::label('fromaccount','From Account')}}
    {{ $form->text('fromBankName','','',array('class'=>'text invAdress','id'=>'cityInv','placeholder'=>'Account Name')) }}
    {{ $form->text('fromBankNumber','','',array('class'=>'text invAdress','id'=>'cityInv','placeholder'=>'Account Number')) }}
    {{ $form->text('fromBankName','','',array('class'=>'text invAdress','id'=>'cityInv','placeholder'=>'Bank Name')) }}
    {{ $form->text('fromBankBranch','','',array('class'=>'text invAdress','id'=>'cityInv','placeholder'=>'Branch')) }}

  </div>
  
</div>
<hr />
<div class="row right">
{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
{{ Form::reset('Reset',array('class'=>'button'))}}
</div>
{{$form->close()}}

<script type="text/javascript">
  $('select').select2();

  $('#field_role').change(function(){
      //alert($('#field_role').val());
      // load default permission here
  });
</script>

@endsection