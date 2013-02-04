@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('attendee/add','POST',array('class'=>'custom'))}}

<div class="row">
    <div class="span6">
        <fieldset>
            <legend>Personal Information</legend>

                {{ Form::label('salutation','Salutation')}}

                <div class="row">
                    <div class="span2">
                      {{ $form->radio('salutation','Mr','Mr',true)}} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('salutation','Mrs','Mrs')}} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('salutation','Ms','Ms')}} 
                    </div>
                    <div class="span6"></div>
                </div>


                {{ $form->text('firstname','First Name.req','',array('class'=>'text span6','id'=>'firstname')) }}
                {{ $form->text('lastname','Last Name.req','',array('class'=>'text span6','id'=>'lastname')) }}
                {{ $form->text('position','Position / Division.req','',array('class'=>'text span6','id'=>'positionname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text span6','id'=>'email')) }}

                {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text span6','id'=>'mobile')) }}

        </fieldset>

    </div>

    <div class="span6">

        <fieldset>
            <legend>Company Information</legend>
                {{ $form->text('company','Company / Institution.req','',array('class'=>'text span6','id'=>'company')) }}
                {{ $form->text('npwp','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text span6','id'=>'company')) }}


                {{ $form->text('companyphone','Phone Number.req','',array('class'=>'text span6','id'=>'companyphone')) }}
                {{ $form->text('companyfax','Fax Number.req','',array('class'=>'text span6','id'=>'companyfax')) }}

                {{ Form::label('invoiceaddress','Invoice address same with Company Address ?') }}

                <div class="row">
                    <div class="span2">
                      {{ $form->radio('invoiceaddress','Yes','Yes',true) }} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('invoiceaddress','No','No') }} 
                    </div>   
                    <div class="span8"></div>
                </div>


        </fieldset>

    </div>
</div>

<div class="row">
    <div class="span6">
        <fieldset>
            <legend>Registration Type</legend>
                <div class="row">
                    <div class="span6">
                        Professional / Delegate Domestic
                    </div>   
                    <div class="span6">
                      {{ $form->radio('regtype','IDR 4.500.000','PD',true) }} 
                    </div>   
                </div>

                <div class="row">
                    <div class="span6">
                        Professional / Delegate Overseas
                    </div>   
                    <div class="span6">
                      {{ $form->radio('regtype','USD 500','PO') }} 
                    </div>   
                </div>

                <div class="row">
                    <div class="span6">
                        Student Domestic
                    </div>   
                    <div class="span6">
                      {{ $form->radio('regtype','IDR 400.000','SD') }} 
                    </div>   
                </div>

                <div class="row">
                    <div class="span6">
                        Student Overseas
                    </div>   
                    <div class="span6">
                      {{ $form->radio('regtype','USD 120','SO') }} 
                    </div>   
                </div>
        </fieldset>
    </div>
    <div class="span6">
             

                {{ Form::label('attenddinner','I will attend the Industrial Dinner on 16 May 2012') }}

                <div class="row">
                    <div class="span4">
                      {{ $form->radio('attenddinner','Yes','Yes',true) }} 
                    </div>   
                    <div class="span4">
                      {{ $form->radio('attenddinner','No','No') }} 
                    </div>   
                    <div class="span8"></div>
                </div>
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