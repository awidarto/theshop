@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('register','POST',array('class'=>'custom'))}}

<div class="row">
    <div class="twelve columns">

        <fieldset>
            <legend>Personal Information</legend>

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

                {{ $form->password('pass','Password (required to access your profile).req','',array('class'=>'text')) }}
                {{ $form->password('repass','Repeat Password.req','',array('class'=>'text')) }}

                {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text','id'=>'mobile')) }}

        </fieldset>

        <fieldset>
            <legend>Company Information</legend>
                {{ $form->text('company','Company / Institution.req','',array('class'=>'text','id'=>'companyName')) }}
                {{ $form->text('npwp','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text','id'=>'companyNPWP')) }}

                {{ $form->text('companyphone','Phone Number.req','',array('class'=>'text','id'=>'companyPhone')) }}
                {{ $form->text('companyfax','Fax Number.req','',array('class'=>'text','id'=>'companyFax')) }}

                {{ $form->text('address','Address.req','',array('class'=>'text','id'=>'address','placeholder'=>'Company Address')) }}

                <div class="row">
                    <div class="eight columns">
                        {{ $form->text('city','','',array('class'=>'text','id'=>'city','placeholder'=>'City')) }}
                    </div>
                    <div class="three columns">
                        {{ $form->text('zip','','',array('class'=>'text','id'=>'zip','placeholder'=>'ZIP Code')) }}
                    </div>
                </div>

                {{$form->select('country','Country of Origin',Config::get('country.countries'),array('class'=>'four'))}}

                <!--{{ Form::label('invoiceaddress','Invoice address same with Company Address ?') }}

                <div class="row">
                    <div class="two columns">
                      {{ $form->radio('invoiceaddress','Yes','Yes',true) }} 
                    </div>   
                    <div class="two columns">
                      {{ $form->radio('invoiceaddress','No','No') }} 
                    </div>   
                    <div class="eight columns"></div>
                </div>-->
                <div class="row">
                  <label for="checkbox2"><input type="checkbox" style="display: none;"><span class="custom checkbox" id="invoiceSame" ></span> Invoice address same with Company Address</label>
                </div>
                


        </fieldset>

        <fieldset>
            <legend>Invoice Address</legend>
                {{ $form->text('companyInvoice','Company / Institution.req','',array('class'=>'text invAdress','id'=>'companyNameInv')) }}
                {{ $form->text('npwpInvoice','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text invAdress','id'=>'companyNPWPInv')) }}

                {{ $form->text('companyphoneInvoice','Phone Number.req','',array('class'=>'text invAdress','id'=>'companyPhoneInv')) }}
                {{ $form->text('companyfaxInvoice','Fax Number.req','',array('class'=>'text invAdress','id'=>'companyFaxInv')) }}

                {{ $form->text('addressInvoice','Address.req','',array('class'=>'text invAdress','id'=>'addressInv','placeholder'=>'Company Address')) }}

                <div class="row">
                    <div class="eight columns">
                        {{ $form->text('cityInvoice','','',array('class'=>'text invAdress','id'=>'cityInv','placeholder'=>'City')) }}
                    </div>
                    <div class="three columns">
                        {{ $form->text('zipInvoice','','',array('class'=>'text invAdress','id'=>'zipInv','placeholder'=>'ZIP Code')) }}
                    </div>
                </div>

                {{$form->select('countryInvoice','Country of Origin',Config::get('country.countries'),array('class'=>'four'))}}

                


        </fieldset>

        <fieldset>
            <legend>Registration Type</legend>
                <div class="row">
                    <div class="four columns">
                        &nbsp;
                    </div>   
                    <div class="three columns">
                      <span><strong>EARLY BIRD</strong></span></br>
                      <span>Until 15 March 2013</span>
                    </div>   
                    <div class="three columns">
                      <span><strong>NORMAL RATE</strong></span></br>
                      <span>After 15 March 2013</span>
                    </div>
                </div>

                <div class="row">
                    <div class="four columns">
                        Professional / Delegate Domestic
                    </div>   
                    <div class="three columns">
                      {{ $form->radio('regtype','IDR 4.500.000','PD',true,array('class'=>'regType professional')) }} 
                    </div>   
                    <div class="three columns">
                      {{ $form->radio('regtypeNormal','IDR 5.000.000','PD',false,array('class'=>'disableRadio')) }} 
                    </div>
                </div>

                <div class="row">
                    <div class="four columns">
                        Professional / Delegate Overseas
                    </div>   
                    <div class="three columns">
                      {{ $form->radio('regtype','USD 500','PO',false,array('class'=>'regType professional')) }} 
                    </div>
                    <div class="three columns">
                      {{ $form->radio('regtypeNormal','USD 550','PD',false,array('class'=>'disableRadio')) }} 
                    </div>   
                    
                </div>

                <div class="row">
                    <div class="four columns">
                        Student Domestic
                    </div>   
                    <div class="three columns">
                      {{ $form->radio('regtype','IDR 400.000','SD',false,array('class'=>'regType student')) }} 
                    </div>
                    <div class="three columns">
                      {{ $form->radio('regtypeNormal','IDR 400.000','PD',false,array('class'=>'disableRadio')) }} 
                    </div>
                </div>

                <div class="row">
                    <div class="four columns">
                        Student Overseas
                    </div>   
                    <div class="three columns">
                      {{ $form->radio('regtype','USD 120','SO',false,array('class'=>'regType student')) }} 
                    </div>   
                    <div class="three columns">
                      {{ $form->radio('regtypeNormal','USD 120','PD',false,array('class'=>'disableRadio')) }} 
                    </div>
                </div>
        </fieldset>

        <fieldset>
          <legend>The registration fee includes:</legend>
          <div class="row">
              <p>Admission to all Plenary and Technical sessions, Conference Kits, entrance to exhibition area, Opening Ceremony, Lunches, Coffee Breaks, Exhibition Cocktail, Industry Dinner, and Closing Ceremony.</p>
          </div>

        </fieldset>

        <fieldset>
          <legend>I will attend the Industrial Dinner on 16 May 2013</legend>
          <div class="row">
              <div class="two columns">
                {{ $form->radio('attenddinner','Yes','Yes',true) }} 
              </div>   
              <div class="two columns">
                {{ $form->radio('attenddinner','No','No') }} 
              </div>   
              <div class="eight columns"></div>
          </div>

        </fieldset>

      @if($golfcount < Config::get('eventreg.golfquota'))


        <fieldset id="golfEvent">
          <legend>Golf Tournament</legend>
            

            <div class="row">
                <div class="four columns">
                    
                    PONDOK INDAH GOLF<br/>
                    (12 May 2013)<br/><br/>
                    IDR 2.500.000,-/person<br/>
                    <br/>
                    Golf quota remaining: <strong>{{ Config::get('eventreg.golfquota') - $golfcount }}</strong>
                    <br/>
                    <br/>
                </div>   

                <div class="three columns">
                  {{ $form->radio('golf','Yes','Yes',false,array('class'=>'field_golfType golfYes')) }} 
                </div>
                <div class="three columns">
                  {{ $form->radio('golf','No','No',true,array('class'=>'field_golfType golfNo')) }} 
                </div>   
                
            </div>
        </fieldset>

      @endif


        <fieldset>

              
              <h4>PAYMENT METHOD</h4>
              <span><strong>Bank Transfer</strong></span>
              <div class="row">
                <div class="six columns mobile-six">
                  <p><strong>IDR Account:</strong><br/>
                  BCA - Mangga Dua Branch<br/>
                  Acc. No. : 335.302.7677<br/>
                  Acc. Name : PT Dyandra Promosindo<br/>
                  </p>
                </div>

                <div class="six columns mobile-six">
                  <p><strong>USD Account:</strong><br/>
                  BCA - Wisma Nusantara Branch<br/>
                  Acc. No. : 734.038.5700<br/>
                  Acc. Name : PT Dyandra Promosindo<br/>
                  Swiftcode : CENAIDJA
                  </p>
                </div>
                <div class="twelve columns">
                  <strong><i>Payment should be made in FULL AMOUNT. Please change your payment status and upload copy of your bank transfer once the payment settled.</i></strong>
                </div>
              </div>
              <hr/>
              <h4>IMPORTANT NOTES</h4>
              <ol>
                <li><strong>Early Bird scheme applies to those who have registered and have settled payment by 15 March 2013 at the latest.</strong> Normal rate will be applied for the registration payment after 15 March 2013.</li>
                <li>Registration Forms received without registration fees will not be processed. </li>
                <li><strong>No refund will be granted for cancellation after 14 April 2013.</strong> All cancellations must be made in writing to the Convention Secretariat and the refund for cancellations before 14 April 2013 will be made after the convention.</li>
                <li><strong>Convention registration payment deadline is 30 April 2013.</strong></li>
                <li>For those who <strong>participate in golf tournament, the payment must be settled before 14 April 2013.</strong></li>
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

<script type="text/javascript">
$(function() {

  $("#s2id_field_countryInvoice").select2("val", "ID");
  $("#s2id_field_country").select2("val", "ID");
  
  function fillsame(){
    var companyName = $("#companyName").val();
    var companyNPWP = $("#companyNPWP").val();
    var companyPhone = $("#companyPhone").val();
    var companyFax = $("#companyFax").val();
    var companyAddress = $("#address").val();
    var companyCity = $("#city").val();
    var companyZip = $("#zip").val();
    var companyCountry = $("#s2id_field_country").select2("val");

    $("#companyNameInv").val(companyName);
    $("#companyNPWPInv").val(companyNPWP);
    $("#companyPhoneInv").val(companyPhone);
    $("#companyFaxInv").val(companyFax);
    $("#addressInv").val(companyAddress);
    $("#cityInv").val(companyCity);
    $("#zipInv").val(companyZip);
    $("#s2id_field_countryInvoice").select2("val", companyCountry);
  }

  function resetinput(){
    $('.invAdress')
     .not(':button, :submit, :reset, :hidden')
     .val('')
     .removeAttr('checked')
     .removeAttr('selected');
      $("#s2id_field_countryInvoice").select2("val", "");
  }
  
  $("#invoiceSame").live("click", function(){
    if($('#invoiceSame').hasClass('checked')){
      fillsame();
      
    }else{
      resetinput();
    }
  });
  $(".disableRadio").next('span').addClass('radioDisable');

  $(".radioDisable").live("click", function(){
    $(this).removeClass('checked');
  });

  $(".regType").next('span').addClass('regTypeRecord');
  $('.field_golfType').next('span').addClass('golfCheckBox');
  $('.golfNo').next('span').addClass('golfNoCheckBox');
  $('.golfYes').next('span').addClass('golfYesCheckBox');
  
  $(".professional").next('span').addClass('professional');
  $(".student").next('span').addClass('student');
  
  $(".regTypeRecord").live("click", function(){
    if($(this).hasClass('checked' && 'student')){
      $('.golfNoCheckBox').addClass('checked');
      //$('.golfYesCheckBox').removeClass('checked');
      $('.golfYesCheckBox').addClass('radioDisable');
      $('.golfYesCheckBox').addClass('studentSelected');
      $('.golfYesCheckBox').removeClass('checked');
      $('.golfNoCheckBox').addClass('checked');
    }else{
      if($('.golfNoCheckBox').hasClass('checked')){
        $('.golfNoCheckBox').addClass('checked');
        $('.golfYesCheckBox').removeClass('checked');
      }else{
        $('.golfNoCheckBox').removeClass('checked');
        $('.golfYesCheckBox').addClass('checked');
      }
      $('.golfCheckBox').removeClass('radioDisable');
      $('.golfYesCheckBox').addClass('profSelected');
      $('.golfYesCheckBox').removeClass('studentSelected');
    }
  });

  $(".golfYesCheckBox").live("click", function(){
    if($(this).hasClass('studentSelected')){
      $('.golfYesCheckBox').removeClass('checked');
      $('.golfNoCheckBox').addClass('checked');
    }
  });

  
  

  
});

</script>

@endsection