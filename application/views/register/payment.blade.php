@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('payment','POST',array('class'=>'custom'))}}

    {{ $form->hidden('id',$user['_id'])}}
    {{ $form->hidden('registrationnumber',$user['registrationnumber'])}}

<div class="row">
    <div class="twelve columns">

        <fieldset>
            <legend>Attendee Information</legend>

                {{ Form::label('salutation','Salutation')}}

                <div class="row">
                    <div class="two columns">
                      {{ $form->radio('salutation','Mr','Mr',true)}} 
                    </div>   
                    <div class="two columns">
                      {{ $form->radio('salutation','Mrs','Mrs')}} 
                    </div>   
                    <div class="two columns">
                      {{ $form->radio('salutation','Ms','Ms')}} 
                    </div>
                    <div class="six columns"></div>
                </div>


                {{ $form->text('firstname','First Name.req','',array('class'=>'text','id'=>'firstname')) }}
                {{ $form->text('lastname','Last Name.req','',array('class'=>'text','id'=>'lastname')) }}
                {{ $form->text('position','Position / Division.req','',array('class'=>'text','id'=>'positionname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text','id'=>'email')) }}

                {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text','id'=>'mobile')) }}

        </fieldset>

        <fieldset>
            <legend>Payment Information</legend>
                {{ $form->text('transferdate','Date Transferred.req','',array('class'=>'text','id'=>'transferdate')) }}
                {{ $form->text('totalpayment','Total Payment.req','',array('class'=>'text','id'=>'totalpayment')) }}

                <h4>Transfer To</h4>
                <span><strong>Bank Transfer</strong></span>
                <div class="row">
                  <div class="six columns mobile-six">
                    <p>
                    {{ $form->radio('attenddinner','IDR Account','IDR',true) }}<br /><br />
                    BCA - Mangga Dua Branch<br/>
                    Acc. No. : 335.302.7677<br/>
                    Acc. Name : PT Dyandra Promosindo<br/>
                    </p>
                  </div>

                  <div class="six columns mobile-six">
                    <p>
                    {{ $form->radio('attenddinner','USD Account','USD') }}<br /><br />
                    BCA - Wisma Nusantara Branch<br/>
                    Acc. No. : 734.038.5700<br/>
                    Acc. Name : PT Dyandra Promosindo<br/>
                    Swiftcode : CENAIDJA
                    </p>
                  </div>
                </div>


                {{ $form->text('fromaccountname','Account Name.req','',array('class'=>'text','id'=>'companyphone')) }}
                <div class="row">
                    <div class="three columns">
                        {{ $form->text('fromaccnumber','','',array('class'=>'text','id'=>'zip','placeholder'=>'Account number')) }}
                    </div>
                    <div class="seven columns right">
                        {{ $form->text('frombank','','',array('class'=>'text','id'=>'city','placeholder'=>'Bank Name')) }}
                    </div>
                </div>
        </fieldset>

        <fieldset>
            <legend>Important Notes</legend>

              <h4>The registration fee includes:</h4>
              <p>Admission to all Plenary and Technical sessions, Conference Kits, entrance to exhibition area, Opening Ceremony, Lunches, Coffee Breaks, Exhibition Cocktail, Industry Dinner, and Closing Ceremony.</p>

              <ol>
                <li>Early Bird rates only valid for both registration and payment received until 15 March 2013 at the latest. Normal rate will be applied for the registration with payment settlement after 15 March 2013.
                  <li>Registration Forms received without registration fees will not be processed.</li>
                  <li>No refund will be granted for cancellation after 14 April 2013. All cancellations must be made in writing to the Secretariat and the
                        refund will be made after the conference.</li>
              </ol>

        </fieldset>

    </div>
</div>

<hr />

<div class="row right">
{{ Form::submit('Submit',array('class'=>'button'))}}&nbsp;&nbsp;
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