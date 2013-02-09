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

                <div class="row">
                  <span class="labelInline">Salutation</span>
                  <span class="">: {{ $user['salutation'] }}</span>
                </div>
                <div class="row">
                  <span class="labelInline">First Name</span>
                  <span class="">: {{ $user['firstname'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Last Name</span>
                  <span class="">: {{ $user['lastname'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Position / Division</span>
                  <span class="">: {{ $user['position'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Email</span>
                  <span class="">: {{ $user['email'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Mobile Phone Number</span>
                  <span class="">: {{ $user['mobile'] }}</span>
                </div>
                <br/>
                <br/>

        </fieldset>

        <fieldset>
            <legend>Payment Information</legend>
                {{ $form->text('transferdate','Date Transferred.req','',array('class'=>'text','id'=>'transferdate','placeholder'=>'yyyy/mm/dd')) }}
                {{ $form->text('totalpayment','Total Payment.req','',array('class'=>'text','id'=>'totalpayment')) }}

                <h4>Transfer To</h4>
                <span><strong>Bank Transfer</strong></span>
                <div class="row">
                  <div class="six columns mobile-six">
                    <p>
                    {{ $form->radio('transferto','IDR Account','BCA - Mangga Dua Branch (IDR Account)',true) }}<br /><br />
                    BCA - Mangga Dua Branch<br/>
                    Acc. No. : 335.302.7677<br/>
                    Acc. Name : PT Dyandra Promosindo<br/>
                    </p>
                  </div>

                  <div class="six columns mobile-six">
                    <p>
                    {{ $form->radio('transferto','USD Account','BCA - Wisma Nusantara Branch (USD Account)') }}<br /><br />
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