@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open('attendee/edit/'.$user['_id'],'POST',array('class'=>'custom'))}}

    {{ $form->hidden('id',$user['_id'])}}
    {{ $form->hidden('registrationnumber',$user['registrationnumber'])}}

<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>Personal Information</legend>

                {{ Form::label('salutation','Salutation')}}

                <div class="row-fluid radioInput">
                    <div class="span2">
                      {{ $form->radio('salutation','Mr','Mr')}} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('salutation','Mrs','Mrs')}} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('salutation','Ms','Ms')}} 
                    </div>
                    <div class="span6"></div>
                </div>

                {{ $form->text('firstname','First Name.req','',array('class'=>'text span8','id'=>'firstname')) }}
                
                {{ $form->text('lastname','Last Name.req','',array('class'=>'text span8','id'=>'lastname')) }}
                {{ $form->text('position','Position / Division.req','',array('class'=>'text span8','id'=>'positionname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text span8','id'=>'email')) }}

                {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text span8','id'=>'mobile')) }}

        </fieldset>

        <fieldset>
            <legend>Registration Type</legend>
                <div class="row-fluid">
                    <div class="span6">
                        Professional / Delegate Domestic
                    </div>   
                    <div class="span6">
                      {{ $form->radio('regtype','IDR 4.500.000','PD') }} 
                    </div>   
                </div>

                <div class="row-fluid">
                    <div class="span6">
                        Professional / Delegate Overseas
                    </div>   
                    <div class="span6">
                      {{ $form->radio('regtype','USD 500','PO') }} 
                    </div>   
                </div>

                <div class="row-fluid">
                    <div class="span6">
                        Student Domestic
                    </div>   
                    <div class="span6">
                      {{ $form->radio('regtype','IDR 400.000','SD') }} 
                    </div>   
                </div>

                <div class="row-fluid">
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

        <fieldset>
            <legend>Company Information</legend>
                {{ $form->text('company','Company / Institution.req','',array('class'=>'text span6','id'=>'company')) }}
                {{ $form->text('npwp','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text span6','id'=>'company')) }}


                {{ $form->text('companyphone','Phone Number.req','',array('class'=>'text span6','id'=>'companyphone')) }}
                {{ $form->text('companyfax','Fax Number.req','',array('class'=>'text span6','id'=>'companyfax')) }}

                {{ $form->text('address','Address.req','',array('class'=>'text span9','id'=>'address','placeholder'=>'Company Address')) }}


                <div class="row-fluid inputInline">
                    
                        {{ $form->text('city','','',array('class'=>'text span12','id'=>'city','placeholder'=>'City')) }}
                    
                    
                        {{ $form->text('zip','','',array('class'=>'text span3','id'=>'zip','placeholder'=>'ZIP Code')) }}
                    
                </div>

                {{$form->select('country','Country of Origin',Config::get('country.countries'),null)}}

        </fieldset>

        <fieldset>
            <legend>Invoice address same with Company Address ?</legend>
                <div class="row-fluid">
                    <div class="span2">
                      {{ $form->radio('invoiceaddress','Yes','Yes') }} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('invoiceaddress','No','No') }} 
                    </div>   
                    <div class="span8"></div>
                </div>
        </fieldset>

        <fieldset>
            <legend>Will attend the Industrial Dinner on 16 May 2012</legend>

                <div class="row-fluid">
                    <div class="span2">
                      {{ $form->radio('attenddinner','Yes','Yes') }} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('attenddinner','No','No') }} 
                    </div>   
                    <div class="span8"></div>
                </div>

        </fieldset>

    </div>
</div>

<hr />

<div class="row right">
{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
{{ Form::reset('Reset',array('class'=>'button'))}}
</div>
{{$form->close()}}

<script type="text/javascript">
  $('select').select2({
    width : 'resolve'
  });

  $('#field_role').change(function(){
      //alert($('#field_role').val());
      // load default permission here
  });
</script>

@endsection