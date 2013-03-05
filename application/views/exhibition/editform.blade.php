@layout('publicnoside')
@section('content')
<div class="tableHeader">
    <h3>{{$title}}</h3>
</div>
{{$form->open('exhibition/editform','POST',array('class'=>'addAttendeeForm'))}}
{{ $form->hidden('id',$data['_id'])}}
<div id="wizard" class="swMain">
  <ul>
    <li><a href="#step-1">
          <small>step</small>
          <label class="stepNumber">1</label>
      </a></li>
    <li><a href="#step-2">
          <small>step</small>
          <label class="stepNumber">2</label>
      </a></li>
    <li><a href="#step-3">
          <small>step</small>
          <label class="stepNumber">3</label>
       </a></li>
    <li><a href="#step-4">
          <small>step</small>
          <label class="stepNumber">4</label>
      </a>
    </li>
    <li>
      <a href="#step-5">
          <small>step</small>
          <label class="stepNumber">5</label>
      </a>
    </li>
    <li>
      <a href="#step-6">
          <small>step</small>
          <label class="stepNumber">6</label>
      </a>
    </li>
    <li>
      <a href="#step-7">
          <small>step</small>
          <label class="stepNumber">7</label>
      </a>
    </li>
    <li>
      <a href="#step-8">
          <small>step</small>
          <label class="stepNumber">8</label>
      </a>
    </li>
    <li>
      <a href="#step-9">
          <small>step</small>
          <label class="stepNumber">9</label>
      </a>
    </li>
    <li>
      <a href="#step-10">
          <small>step</small>
          <label class="stepNumber">10</label>
      </a>
    </li>
    <li>
      <a href="#step-11">
          <small>step</small>
          <label class="stepNumber">11</label>
      </a>
    </li>
    <li>
      <a href="#step-12">
          <small>step</small>
          <label class="stepNumber">12</label>
      </a>
    </li>
    <li>
      <a href="#step-13">
          <small>step</small>
          <label class="stepNumber">13</label>
      </a>
    </li>
    <li>
      <a href="#step-14">
          <small>step</small>
          <label class="stepNumber">14</label>
      </a>
    </li>

  </ul>

  
  <div id="step-1">
   <h2 class="StepTitle"></h2>
    <div id="page-wrap">
      <div id="boothcontractor">
          <h4>Terms & Conditions:</h4>
          <ol>
            <li>Please check your booth requirements  to your booth contractor or organizer.</li>
            <li>Only filled the required forms.</li>
            <li>Remember only to submit if your requirements are final. <strong>The forms cannot be modified if already submitted.</strong></li>
            <li>The organizer will issue an invoice of the total amount of the additional facilities request based on filled forms after the exhibitors finalize it.</li>
          </ol>
      </div>
      <table id="order-table" class="withborder">
        <tr>
          <th colspan="4">USEFUL CONTACTS</th>
        </tr>
        <tr class="odd">
          <td rowspan="2">1.</td>
          <td rowspan="2">Operational</td>
          <td>Raymond</td>
          <td>raymond@dyandra.com</td>
        </tr>
        <tr class="odd">
          <td>Rain</td>
          <td>rain.januardo@dyandra.com</td>
        </tr>

        <tr class="odd">
          <td rowspan="2">2.</td>
          <td rowspan="2">Hall A</td>
          <td>Rain</td>
          <td>rain.januardo@dyandra.com</td>
        </tr>
        <tr class="odd">
          <td>Tia</td>
          <td>tia.hamidah@dyandra.com</td>
        </tr>

         <tr class="odd">
          <td>3.</td>
          <td>Hall B</td>
          <td>Raymond</td>
          <td>raymond@dyandra.com</td>
        </tr>

        <tr class="odd">
          <td>4.</td>
          <td>Cendrawasih Room</td>
          <td>Trias</td>
          <td>trias.nugrahasanah@dyandra.com</td>
        </tr>
        
        <tr class="odd">
          <td>5.</td>
          <td>Plenary Hall & Convention</td>
          <td>Ati</td>
          <td>luh.ariati@dyandraconvex.com</td>
        </tr>
        <tr class="odd">
          <td>6.</td>
          <td>Main Lobby</td>
          <td>Trisa</td>
          <td>trisa@dyandra.com</td>
        </tr>
        <tr class="odd">
          <td>7.</td>
          <td>Assembly Hall</td>
          <td>Dian</td>
          <td>dian@dyandra.com</td>
        </tr>

        <tr class="odd">
          <td rowspan="2">8.</td>
          <td rowspan="2">PR Department</td>
          <td>Mirna</td>
          <td>mirna@dyandra.com</td>
        </tr>
        <tr class="odd">
          <td>Putri</td>
          <td>diahputri@dyandra.com</td>
        </tr>
      </table>
      <br/>
      <br/>
      <br/>
    </div>
  </div>

  <div id="step-2">

    <h2 class="StepTitle">ELECTRICITY INSTALLATION</h2>
    <div id="page-wrap">
        <table id="order-table">
            <tr>
                 <th>No.</th>
                 <th>ELECTRICITY</th> 
                 <th>PRICE (USD)</th>
                 <th>QUANTITY</th>
                 <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            <tr class="odd">
                <td>1</td>
                <td class="product-title">2A / 1 ph / 440 Watt</td>
                <td class="price-per-pallet">USD <span>89</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="sparkle-num-pallets" name="electric1" value="{{ $data['electric1'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="sparkle-row-total" disabled="disabled" value="{{ $data['rowelectric1'] }}"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric1" value="{{ $data['rowelectric1'] }}"></input>
                </td>
                
            </tr>
            <tr class="even">
                <td>2</td>
                <td class="product-title">4A / 1 ph / 880 Watt</td>
                <td class="price-per-pallet">USD <span>177</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-mvp-num-pallets" name="electric2" value="{{ $data['electric2'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-mvp-row-total" disabled="disabled" value="{{ $data['rowelectric2'] }}"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric2" value="{{ $data['rowelectric2'] }}"></input>
                </td>
            </tr>
            <tr class="odd">
                <td>3</td>
                <td class="product-title">6A / 1 ph / 1.320 Watt</td>
                <td class="price-per-pallet">USD <span>265</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-pro-league-num-pallets" name="electric3" value="{{ $data['electric3'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-pro-league-row-total" disabled="disabled" value="{{ $data['rowelectric3'] }}"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric3" value="{{ $data['rowelectric3'] }}"></input>
                </td>
            </tr>
           
            <tr class="odd">
                <td>4</td>
                <td class="product-title">10A / 1 ph / 2.200 Watt</em></td>
                <td class="price-per-pallet">USD <span>442</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-quick-dry-num-pallets" name="electric4" value="{{ $data['electric4'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-quick-dry-row-total" disabled="disabled" value="{{ $data['rowelectric4'] }}"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric4" value="{{ $data['rowelectric4'] }}"></input>
                </td>
            </tr>
            <tr class="even">
                <td>5</td>
                <td class="product-title">16A / 1 ph / 3.520 Watt</td>
                <td class="price-per-pallet">USD <span>706</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-mound-clay-red-num-pallets" name="electric5" value="{{ $data['electric5'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-mound-clay-red-row-total" disabled="disabled" value="{{ $data['rowelectric5'] }}"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric5" value="{{ $data['rowelectric5'] }}"></input>
                </td>
            </tr>
            <tr class="odd">
                <td>6</td>
                <td class="product-title">32A / 1 ph / 7.040 Watt</td>
                <td class="price-per-pallet">USD <span>1412</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-red-num-pallets" name="electric6" value="{{ $data['electric6'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-red-row-total" disabled="disabled" value="{{ $data['rowelectric6'] }}"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric6" value="{{ $data['rowelectric6'] }}"></input>
                </td>
            </tr>
            <tr class="even">
                <td>7</td>
                <td class="product-title">16A / 3 ph / 10.560 Watt</td>
                <td class="price-per-pallet">USD <span>2118</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-drying-agent-num-pallets" name="electric7" value="{{ $data['electric7'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-drying-agent-row-total" disabled="disabled" value="{{ $data['rowelectric7'] }}"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric7" value="{{ $data['rowelectric7'] }}"></input>
                </td>
            </tr>
            <tr class="odd">
                <td>8</td>
                <td class="product-title">32A / 3 ph / 21.120 Watt</em></td>
                <td class="price-per-pallet">USD <span>4235</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-professional-num-pallets" name="electric8" value="{{ $data['electric8'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-professional-row-total" disabled="disabled" value="{{ $data['rowelectric8'] }}"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric8" value="{{ $data['rowelectric8'] }}"></input>
                </td>
            </tr>
            <tr class="even">
                <td>9</td>
                <td class="product-title">60A / 3 ph / 39.600 Watt</td>
                <td class="price-per-pallet">USD <span>7941</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-top-dressing-num-pallets" name="electric9" value="{{ $data['electric9'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-top-dressing-row-total" disabled="disabled" value="{{ $data['rowelectric9'] }}"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric9" value="{{ $data['rowelectric9'] }}"></input>

                </td>
            </tr>
            <!--<tr>
                <td colspan="5" style="text-align: right;">
                    Product SUBTOTAL: <input type="text" class="total-box" value="$0" id="product-subtotal" disabled="disabled"></input>
                </td>
            </tr>-->
        </table>

        <table id="operationalfee" class="orderform">
            <tr>
                 <th class="instalationfee" colspan"2">INSTALLATION FEE*</th> 
                 <th class="priceinstall">PRICE (USD)</th>
                 <th class="qinstall">QUANTITY</th>
                 <th class="subinstall" style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            <tr class="odd">
                <td class="instalationfee" colspan"2" style="padding-left:30px;">Installation fee</td>
                <td class="textcentertable">USD 30</td>
                <td class="textcentertable">1</td>
                <td class="textcentertable">USD 30</td>
                <input type="hidden" id="operationalfeeelectric" value="30" name="electricinstallfee" value="{{ $data['electricinstallfee'] }}"></input>
            </tr>
        </table>

        <table id="total-electric">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="product-subtotal">{{ $data['electricsubtotal'] }}</span></td>
            <input type="hidden" id="electricsubtotal" name="electricsubtotal" value="{{ $data['electricsubtotal'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" id="electriclate" name="electriclate" value="{{ $data['electriclate'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" id="electriconsite" name="electriconsite" value="{{ $data['electriconsite'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="product-tax">{{ $data['electrictax'] }}</span></td>
            <input type="hidden" id="electrictax" name="electrictax" value="{{ $data['electrictax'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="order-total">{{ $data['electricgrandtotal'] }}</span></td>
            <input type="hidden" id="electricgrandtotal" name="electricgrandtotal" value="{{ $data['electricgrandtotal'] }}"></input>
          </tr>
        </table>
        
        <div class="clear"></div>

        <div>
            <h4>Terms & Conditions:</h4>
            <ol>
              <li>Every order of the electricity power will be charged with Installation fee. </li>
              <li>Rental price during the exhibition starts at 9.00 am until 9.00 pm.</li>
              <li>Every on-site order request for electricity installation must be paid in cash.</li>
              <li>24 hours electrical requirement will be charged double.</li>
              <li>Orders without payment will not be executed.</li>
              <li>As stocks are limited, late orders will be subjected to a 30% surcharge after 14 April 2013 and 50% surcharge for onsite orders.</li>
            </ol>
        </div>
        
    </div>
  </div>

  <div id="step-3">
    <h2 class="StepTitle">TELEPHONE INSTALLATION</h2>
    <div id="page-wrap">
        <table id="order-table">
            <tr>
                 <th>No.</th>
                 <th>TELEPHONE TYPE</th> 
                 <th>PRICE/UNIT</th>
                 <th>QUANTITY</th>
                 <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            <tr class="odd">
                <td>1</td>
                <td class="product-title"><strong>Dial 9</strong><br/>
                • Service coverage: local call only (within Jakarta).<br/>
                • Price includes call credit & installation.
                </td>
                <td class="price-per-pallet">USD <span>250</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input-phone" id="sparkle-num-pallets" name="phone1" value="{{$data['phone1']}}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-phone" id="sparkle-row-total" disabled="disabled" value="{{$data['rowphone1']}}"></input>
                  <input type="hidden" class="row-total-input" id="" name="rowphone1" value="{{$data['rowphone1']}}"></input>
                </td>
            </tr>
            <tr class="even">
                <td>2</td>
                <td class="product-title"><Strong>Hotline</strong><br/>
                • Service coverage: local, national, mobile phone, credit or debit card authorization.<br/>
                • Commonly used for EDC / credit card purchasing.<br/>
                • Price includes call credit & installation.<br/>
                • Call back is not applicable.<br/></td>
                
                <td class="price-per-pallet">USD <span>400</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input-phone" id="turface-mvp-num-pallets" name="phone2" value="{{$data['phone2']}}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-phone" id="turface-mvp-row-total" disabled="disabled" value="{{$data['rowphone2']}}"></input>
                  <input type="hidden" class="row-total-input" id="" name="rowphone2" value="{{$data['rowphone2']}}"></input>
                </td>
            </tr>
            
        </table>

        <table class="total-table">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalPhone">{{$data['phonesubtotal']}}</span></td>
            <input type="hidden" class="" id="phonesubtotal" name="phonesubtotal" value="{{$data['phonesubtotal']}}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="phonelate" value="{{$data['phonelate']}}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="phoneonsite" value="{{$data['phoneonsite']}}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="faxTotalPhone">{{$data['phonetax']}}</span></td>
            <input type="hidden" class="" id="phonetax" name="phonetax" value="{{$data['phonetax']}}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="grandTotalPhone">{{$data['phonegrandtotal']}}</span></td>
            <input type="hidden" class="" id="phonegrandtotal" name="phonegrandtotal" value="{{$data['phonegrandtotal']}}"></input>
          </tr>
        </table>
        
        <div class="clear"></div>

        <div>
            <h4>Terms & Conditions:</h4>
            <ol>
              <li>Rental price during the exhibition starts at 9.00 am until 9.00 pm. </li>
              <li>Please submit a drawing which indicates specific location for the telephone.</li>
              <li>Telephone handset must be returned after the exhibition ends</li>
              <li>On-site order for telephone cannot be granted</li>
              <li>Orders without payment will not be executed</li>
              <li>As stocks are limited, late orders will be subject to a 30% surcharge after 14 April 2013</li>
            </ol>
        </div>
        
    </div>
  </div>

  <div id="step-4">
      <h2 class="StepTitle">BOOTH CONTRACTOR (SPECIAL DESIGN ONLY)</h2>   
      <div id="boothcontractor">
        <br/>
        <p>I (as the exhibitor) hereby inform you the details of contractor that will be responsible for my booth construction:</p>
        {{ $form->text('companyContractor','Company','',array('class'=>'text','id'=>'firstname')) }}
        <div class="clear"></div>
        {{ $form->text('picContractor','Person in Charge','',array('class'=>'text')) }}
        <div class="clear"></div>
        {{ $form->text('adress','Address','',array('class'=>'text')) }}
        <div class="clear"></div>
        {{ $form->text('phone','Phone','',array('class'=>'text')) }}
        <div class="clear"></div>
        {{ $form->text('fax','Fax','',array('class'=>'text')) }}
        <div class="clear"></div>
        {{ $form->text('mobile','Mobile Phone','',array('class'=>'text')) }}
        <div class="clear"></div>
        {{ $form->text('email','Email','',array('class'=>'text')) }}
        <div class="clear"></div>
        <br/>
        <div>
          We (as the exhibitor) assure that:<br/>
          <ol>
            <li>We hereby agree to comply with the Organizing Committee Terms and Conditions regarding Personnel Protective  Equipment</li>
            <li>We shall be responsible for any damages of the exhibition venue caused by our booth construction, displayed products/materials, or casualties/injuries that reflects our negligence on safety and security.</li>
            <li>We shall pay 50% from the total value on the application form (Form A) if our design and construction breaks the rule and regulation written on the exhibition manual book.</li>
          </ol>
        </div>
        <hr/>
        <br/>
        <br/>
        <div class="terms">
           <strong>Terms & Conditions:</strong>
            <ol>
              <li>Exhibitor or booth contractor must submit a copy of complete booth design before <strong>14 April 2013</strong></li>
              <li>The design must be approved both by the organizer and IPA committee before going to production phase.</li>
              <li>Contractors are obliged to wear contractor’s own uniform during Set Up and Dismantling period.</li>
            </ol>
        </div>

      </div>
  </div>

  <div id="step-5">
    <h2 class="StepTitle">FASCIA NAME (STANDARD BOOTH ONLY)</h2>   
    <div id="boothcontractor">
      <br/>
      <p>If your company will be using standard booth (standard shell scheme) as illustrated below:</p>
      {{ HTML::image('images/exhibitor/stdBooth.png','',array('class'=>'booothImage')) }}
      <ol class="left boothDetail">
        <li>Wall partition (1mL x 2.49mH) for in-line / <br/>standard (non-corner) booth </li>
        <li>Aluminum system fascia board (0.35mH)  </li>
        <li>2 (two) units standard folded chairs. </li>
        <li>1 MCB 2A/Single/Phase and 1 single electrical power outlet </li>
        <li>1 (one) aluminum system reception desk <br/>(1.030mL x 0.50mW x 0.75mH)  </li>
        <li>Standard light illumination.  </li>
        <li>1 (one) waste paper basket </li>
        <li>Needle punch carpet (grey colors) </li>
        <li>1 (one) Standing Brochure Rack A4 </li>
        <li>Additional / costum requirements will be charged separately</li>
      </ol>
      <div class="clear"></div>
      Please write the company name to appear on fascia name (maximum 26 characters).<br/><br/>
      {{ $form->text('fascianame','','',array('id'=>'fascianame','class'=>'blockDisplay')) }}
      <div class="clear"></div>
      <span id="text_counter"></span>
      <br/>
      <small>* Please fill-in the details by typing in block letters, the organizer won’t be held responsible for illegible handwriting.</small><br/>
      <small>* Please inform us, if you have special enquiries for your standard shell booth.</small>
      <br/>
      <br/>
    </div>                     
  </div>

  <div id="step-6">
    <h2 class="StepTitle">FREE EXHIBITOR PASS</h2>   
    <div id="boothcontractor">
      <br/>
      <p>Exhibitors have an entitlement for a certain number of free “Barcode ID CARD” as indicated here-below:</p>
      <table class="regularTable exhibitorpass">
        <tr>
          <td style="width:30px;">9</td>
          <td style="width:150px;">Sqm booth space for</td>
          <td style="width:20px;">:</td>
          <td style="width:30px;">2</td>
          <td >people</td>
        </tr>
        <tr>
          <td>18</td>
          <td>Sqm booth space for</td>
          <td>:</td>
          <td>4</td>
          <td>people</td>
        </tr>
        <tr>
          <td>27</td>
          <td>Sqm booth space for</td>
          <td>:</td>
          <td>6</td>
          <td>people</td>
        </tr>
        <tr>
          <td>36</td>
          <td>Sqm booth space for</td>
          <td>:</td>
          <td>8</td>
          <td>people</td>
        </tr>
        <tr>
          <td>45</td>
          <td>Sqm booth space for</td>
          <td>:</td>
          <td>10</td>
          <td>people</td>
        </tr>
      </table>
      <div class="clear"></div>
      <p>Please list below the names of EXHIBITOR’S FREE PASS HOLDERS you wish to register and send by email to the hall PIC(s)</p>
      <table id="order-table">
        <thead>
          <tr>
            <th>No.</th>            
            <th>Names of Exhibitor’s Free Pass Holders</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=1;$i<=10;$i++): ?>
          <tr>
            <td>{{$i}}. </td>
            <td>{{ $form->text('freepassname'.$i,'','',array('id'=>'','class'=>'passholderbooth','placeholder'=>'Type name here')) }}</td>
          </tr>
          <?php endfor; ?>
        </tbody>
      </table>
      <br/>
      <strong>Terms & Conditions:</strong><br/>
      <ol>
        <li>Exhibitor Pass entitled lunch and coffee break during 3 days of exhibition</li>
        <li>Exhibitor pass (ID Card) does not include free entry to the <strong>Conference‘s Plenary Session, but can attend the TPC</strong></li>
      </ol>
      <br/>
      <br/>
    </div>                     
  </div>

  <div id="step-7">
    <h2 class="StepTitle">BOOTH ASSISTANT PASS</h2>   
    <div id="boothcontractor">
      <br/>
      <h4>Terms & Conditions:</h4>
      <ol>
        <li>Booth Assistant's Pass is valid for 3 days. </li>
        <li>Booth Assistant's Pass are permitted to assist Exhibitor in Exhibition areas only, and is <strong>not entitled to participate on the Conference‘s Plenary Session nor the  TPC.</strong></li>
        <li>Booth assistants Pass are free of charge (include coffee break, exclude lunch) at the maximum of 10 persons.</li>
        <li>More than 10 will be charged USD 35 per pass (include coffee break, exclude lunch)</li>
        <li>There is no limit to the purchase of the number of Additional Booth Assistant(s).</li>
      </ol>
      <p><strong>Please list below the names of BOOTH ASSISTANT PASS HOLDERS you wish to register and send by email to the hall PIC(s)</strong></p>
      <div class="clear"></div>      
      <table id="order-table">
        <thead>
          <tr>
            <th>No.</th>            
            <th>Names of Booth Assistant Pass Holders</th>
          </tr>
        </thead>
        <tbody id="listadditionalbooth">
          
          <?php for($i=1;$i<=10;$i++): ?>
          <tr>
            <td>{{$i}}. </td>
            <td>{{ $form->text('boothassistant'.$i,'','',array('id'=>'','class'=>'passholderbooth','placeholder'=>'Type name here')) }}</td>
          </tr>
          <?php endfor; ?>

          
          <input name="noaddpass" id="noaddpass" type="hidden" value="10"></input>
        </tbody>
      </table>
      <a href="javascript:void(0);" id="add-field" class="buttonBrown">Add field</a>
      
      <br/>
      <br/>
    </div>                     
  </div>
  
  <div id="step-8">
    <h2 class="StepTitle">ADDITIONAL EXHIBITOR PASS</h2>   
    <div id="boothcontractor">
      <br/>
      <h4>Terms & Conditions:</h4>
      <ol>
        <li>Additional Booth Assistant(s) pass is charged USD 35 per pass (include coffee break, exclude lunch)</li>
        <li>Additional Booth Assistant(s) is valid for 3 days. </li>
        <li>Additional Booth Assistant(s)  Pass are permitted to assist Exhibitor in Exhibition areas only, and is <strong>not entitled to participate on the Conference‘s Plenary Session nor the TPC.</strong></li>
        <li>Booth assistants are free of charge (include coffee break, exclude lunch) at the maximum of 10 persons.</li>
      </ol>

      <table id="order-table">
          <tr>
               <th>Price/UNIT</th>
               <th>QUANTITY</th>
               <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
          </tr>
          <tr class="odd">
              
              <td class="price-per-pallet">USD <span>35</span></td>
              <td class="num-pallets"><input type="text" class="num-pallets-input-phone" name="totaladdbooth" id="totaladdboothinput" value="{{ $data['totaladdbooth'] }}"></input></td>
              <td class="row-total" style="text-align:right;float:right;"><input type="text" class="row-total-input-addBooth" id="sparkle-row-total" disabled="disabled" value="{{ $data['rowaddbooth'] }}"></input>
                <input type="hidden" class="row-total-input" id="" name="rowaddbooth" value="{{ $data['rowaddbooth'] }}"></input>
              </td>
          </tr>
          
          
      </table>

      

      <table id="total-addbooth" class="total-table">
        <tr>
          <td class="grayTable alignRight">Total (USD)</td>
          <td class="result">USD <span id="subTotalAddbooth">{{ $data['addboothsubtotal'] }}</span></td>
          <input type="hidden" class="" id="addboothsubtotal" name="addboothsubtotal" value="{{ $data['addboothsubtotal'] }}"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">Late Order Surcharge 30%</td>
          <td class="result">USD</td>
          <input type="hidden" class="" id="" name="addboothlate" value="{{ $data['addboothlate'] }}"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
          <td class="result">USD</td>
          <input type="hidden" class="" id="" name="addboothonsite" value="{{ $data['addboothonsite'] }}"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
          <td class="result">USD<span id="faxTotalAddbooth">{{ $data['addboothtax'] }}</span></td>
          <input type="hidden" class="" id="addboothtax" name="addboothtax" value="{{ $data['addboothtax'] }}"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">Grand Total</td>
          <td class="result">USD<span id="grandTotalAddbooth">{{ $data['addboothgrandtotal'] }}</span></td>
          <input type="hidden" class="" id="addboothgrandtotal" name="addboothgrandtotal" value="{{ $data['addboothgrandtotal'] }}"></input>
        </tr>
      </table>
      <div class="clear"></div>
      <br/>
      <br/>
      <p><strong>Please list below the names of Additional Booth Assistant you wish to register and return by email to each Hall PIC(s).</strong></p>
      <div class="clear"></div>
      <table id="order-table">
        <thead>
          <tr>
            <th style="width:150px;">No.</th>
            <th>Names of Additional Booth Assistant Pass Holders</th>
          </tr>
        </thead>
        <tbody id="listaddboothedit">

          <?php for($i=1;$i<=$data['totaladdbooth'];$i++): ?>
          <tr>
            <td>{{$i}}. </td>
            <td>{{ $form->text('addboothname'.$i,'','',array('id'=>'','class'=>'passholderbooth','placeholder'=>'Type name here')) }}</td>
          </tr>
          <?php endfor; ?>

          
        </tbody>
      </table>
      
      <br/>
      <br/>
    </div>                     
  </div>

  <div id="step-9">
    <h2 class="StepTitle">BOOTH PROGRAM SCHEDULE</h2>   
    <div id="boothcontractor">
      <br/>
      <p>In order to ensure the best possible environment for exhibitors and attendees, please indicate here-below the activities that you intend to hold during the exhibition</p>
      <div class="clear"></div>
      <table id="order-table">
        <thead>
          <tr>
            <th style="width:50px;">No.</th>
            <th>Booth Program</th>
            <th style="width:130px;">Date</th>
            <th style="width:130px;">Time</th>
          </tr>
        </thead>
        <tbody>

          <?php for($i=1;$i<=6;$i++): ?>
          <tr>
            <td>{{$i}}. </td>
            <td>{{ $form->text('programdetail'.$i,'','',array('id'=>'','class'=>'passholderbooth','placeholder'=>'Details here')) }}</td>
            <td>{{ $form->text('programdate'.$i,'','',array('id'=>'','class'=>'passholderbooth date','placeholder'=>'dd-mm-yyyy')) }}</td>
            <td>{{ $form->text('programtime'.$i,'','',array('id'=>'','class'=>'passholderbooth date','placeholder'=>'2:00 PM')) }}</td>
          </tr>
          <?php endfor; ?>
          
          
        </tbody>
      </table>


      <table id="order-table">
        <thead>
          <tr>
            <th style="width:50px;">No.</th>
            <th>Cocktail Party Program</th>
            <th style="width:130px;">Date</th>
            <th style="width:130px;">Time</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=1;$i<=3;$i++): ?>
          <tr>
            <td>{{$i}}. </td>
            <td>{{ $form->text('cocktaildetail'.$i,'','',array('id'=>'','class'=>'passholderbooth','placeholder'=>'Details here')) }}</td>
            <td>{{ $form->text('cocktaildate'.$i,'','',array('id'=>'','class'=>'passholderbooth date','placeholder'=>'dd-mm-yyyy')) }}</td>
            <td>{{ $form->text('cocktailtime'.$i,'','',array('id'=>'','class'=>'passholderbooth date','placeholder'=>'2:00 PM')) }}</td>
          </tr>
          <?php endfor; ?>
          
        </tbody>
      </table>
      <br/>
      <br/>
      <div class="terms">
        <strong>Terms & Conditions:</strong>
        <ol>
          <li><u>This form is only applied after Program Technical Meeting for each hall.</u></li>
          <li><u>Live Performance may only start <u>after 4 PM</u> on the first day during cocktail hour.</u></li>
          <li>Every on-site order request for electricity installation must be paid in cash.</li>
          <li><u>NO LIVE PERFORMANCE</u> is allowed on the 2nd and 3rd day.</li>
          <li>Compliance with this requirement will become an element in the best booth judgment.</li>
        </ol>
        <br/>
        <strong>Regulation for noise level:</strong>
        <ol>
          <li>There will be 3 (three) times warning if exhibitor produces sound volume more than the maximum limit.(maximum 80 db)</li>
          <li>If exhibitor still ignores the warning, then the Organizer has the right to cut off the exhibitor’s electrical power.</li>
        </ol>
        <span>Please sign below indicating that you have read and understood the regulation above.</span>
      </div>      
      <br/>
      <br/>
    </div>                     
  </div>

  <div id="step-10">
    <h2 class="StepTitle">ADVERTISING</h2>
    <div id="page-wrap">
        <table id="order-table">
            <tr>
                 <th>No.</th>
                 <th>TYPE</th> 
                 <th>PRICE/UNIT</th>
                 <th>QUANTITY</th>
                 <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            <tr class="odd">
                <td>1</td>
                <td class="product-title"><strong>Hanging Banner – Above the booth</strong><br/><br/>
                &nbsp;&nbsp;&nbsp;• Size : 1,05m x 4m (portrait).<br/>
                </td>
                <td class="price-per-pallet">USD <span>200</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input-advert" id="sparkle-num-pallets" name="advert" value="{{ $data['advert'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-advert" id="sparkle-row-total" disabled="disabled" value="{{ $data['rowadvert'] }}"></input>
                  <input type="hidden" class="row-total-advert" id="" name="rowadvert" value="{{ $data['rowadvert'] }}"></input>
                </td>
            </tr>
            
            
        </table>

        

        <table id="total-electric">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalAdvert">{{ $data['advertsubtotal'] }}</span></td>
            <input type="hidden" class="" id="advertsubtotal" name="advertsubtotal" value="{{ $data['advertsubtotal'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="advertlate" value="{{ $data['advertlate'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="advertonsite" value="{{ $data['advertonsite'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="faxTotalAdvert">{{ $data['adverttax'] }}</span></td>
            <input type="hidden" class="" id="adverttax" name="adverttax" value="{{ $data['adverttax'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="grandTotalAdvert">{{ $data['advertgrandtotal'] }}</span></td>
            <input type="hidden" class="" id="advertgrandtotal" name="advertgrandtotal" value="{{ $data['advertgrandtotal'] }}"></input>
          </tr>
        </table>
        
        <div class="clear"></div>

        <div>
            <h4>Terms & Conditions:</h4>
            <ol>
              <li>Exhibitors must provide their own promotional material.</li>
              <li>First come first serve basis is applied.</li>
              <li>Payment must be in cash on setup days or the showdays.</li>
              <li>The placement of hanging banner above the exhibitor’s booth depends on the availability of the roof hanger point, makes reservation before order.</li>
            </ol>
        </div>
        
    </div>
  </div>

  <div id="step-11">
    <h2 class="StepTitle">FURNITURE RENTAL</h2>   
    <div id="boothcontractor">
      <br/>
      <p>Please fill in the box with the quantity of your order:</p>
      <div class="clear"></div>


      <div class="furniturelistcontainer">
        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Folding chair white</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture1.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="20">
            {{ $form->text('furniture1','','',array('id'=>'furnitureinput1','class'=>'num-pallets-input-furniture','placeholder'=>'0')) }}
            <br/>
            <span      id="furnitureprice1" class="furnitureprice" >USD 20/Unit</span>
            <input type="hidden" class="row-total-input-furniture" id="" name="rowfurniture1" value="{{ $data['rowfurniture1'] }}"></input>

          </div>
        </div>

        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Upright chair red</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture2.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="20">
            {{ $form->text('furniture2','','',array('id'=>'furnitureinput1','class'=>'num-pallets-input-furniture','placeholder'=>'0')) }}
            <br/>
            <span     id="furnitureprice1" class="furnitureprice">USD 20/Unit</span>
            <input type="hidden" class="row-total-input-furniture" id="" name="rowfurniture2" value="{{ $data['rowfurniture2'] }}"></input>

          </div>
        </div>

        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Barstool with backrest</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture3.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="55">
            {{ $form->text('furniture3','','',array('id'=>'furnitureinput3','class'=>'num-pallets-input-furniture','placeholder'=>'0')) }}
            <br/>
            <span      id="furnitureprice1" class="furnitureprice">USD 55/Unit</span>
            <input type="hidden" class="row-total-input-furniture" id="" name="rowfurniture3" value="{{ $data['rowfurniture3'] }}"></input>

          </div>
        </div>
      </div>

      <div class="clear"></div>

      <div class="furniturelistcontainer">
        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Reception desk</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture4.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="25">
            {{ $form->text('furniture4','','',array('id'=>'furnitureinput4','class'=>'num-pallets-input-furniture','placeholder'=>'0')) }}
            <br/>
            <span      id="furnitureprice1" class="furnitureprice" >USD 25/Unit</span>
            <input type="hidden" class="row-total-input-furniture" id="" name="rowfurniture4" value="{{ $data['rowfurniture4'] }}"></input>

          </div>
        </div>

        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Lockable cupboard</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture5.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="20">
            {{ $form->text('furniture5','','',array('id'=>'furnitureinput5','class'=>'num-pallets-input-furniture','placeholder'=>'0')) }}
            <span      id="furnitureprice1" class="furnitureprice" >USD 20/Unit</span>
            <input type="hidden" class="row-total-input-furniture" id="" name="rowfurniture5" value="{{ $data['rowfurniture5'] }}"></input>

          </div>
        </div>

        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Round table with glass top</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture6.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="55">
            {{ $form->text('furniture6','','',array('id'=>'furnitureinput6','class'=>'num-pallets-input-furniture','placeholder'=>'0')) }}
            <span      id="furnitureprice1" class="furnitureprice">USD 55/Unit</span>
            <input type="hidden" class="row-total-input-furniture" id="" name="rowfurniture6" value="{{ $data['rowfurniture6'] }}"></input>

          </div>
        </div>
      </div>
      <div class="clear"></div>
      <br/>
      <br/>
      <table id="total-furniture" class="total-table">
        <tr>
          <td class="grayTable alignRight">Total (USD)</td>
          <td class="result">USD <span id="subTotalFurniture">{{ $data['furnituresubtotal'] }}</span></td>
          <input name="furnituresubtotal" id="furnituresubtotal" type="hidden" value="{{ $data['furnituresubtotal'] }}"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">Late Order Surcharge 30%</td>
          <td class="result">USD</td>
          <input name="furniturelate" id="furniturelate" type="hidden" value="{{ $data['furniturelate'] }}"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
          <td class="result">USD</td>
          <input name="furnitureonsite" id="furnitureonsite" type="hidden" value="{{ $data['furnitureonsite'] }}"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
          <td class="result">USD<span id="faxTotalFurniture">{{ $data['furnituresubtotal'] }}</span></td>
          <input name="furnituretax" id="furnituretax" type="hidden" value="{{ $data['furnituretax'] }}"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">Grand Total</td>
          <td class="result">USD<span id="grandTotalFurniture">{{ $data['furnituresubtotal'] }}</span></td>
          <input name="furnituregrandtotal" id="furnituregrandtotal" type="hidden" value="{{ $data['furnituregrandtotal'] }}"></input>
        </tr>
      </table>
      <br/>
      <br/>
      <br/>
      <br/>
    </div>                     
  </div> 

  <div id="step-12">
    <h2 class="StepTitle">INTERNET CONNECTION</h2>
    <div id="page-wrap">
        <table id="order-table">
            <tr>
                 <th>INTERNET CONNECTION (CABLE)</th>
                 <th>PRICE /PACKAGE</th> 
                 <th>QUANTITY</th>
                 <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            <tr class="odd">
                <td><strong>Package : 1 Mbps</strong></td>
                <td class="price-per-pallet">USD <span>380</span></td>
                <td class="num-pallets"><input name="internet1"    type="text" class="num-pallets-input-internet" id="sparkle-num-pallets" value="{{ $data['internet1'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-internet" id="sparkle-row-total" disabled="disabled" value="{{ $data['rowinternet1'] }}"></input>
                  <input name="rowinternet1" class="row-total-input-internet-hidden" type="hidden" id="rowinternet1" value="{{ $data['rowinternet1'] }}"></input>
                </td>
            </tr>
            <tr class="even">
                <td><strong>Package : 2 Mbps</strong></td>
                <td class="price-per-pallet">USD <span>760</span></td>
                <td class="num-pallets"><input name="internet2"    type="text" class="num-pallets-input-internet" id="sparkle-num-pallets" value="{{ $data['internet2'] }}"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-internet" id="sparkle-row-total" disabled="disabled" value="{{ $data['rowinternet2'] }}"></input>
                  <input name="rowinternet2" class="row-total-input-internet-hidden" type="hidden" id="rowinternet2" value="{{ $data['rowinternet2'] }}"></input>
                </td>
            </tr>
            <tr class="odd">
                <td><strong>Instalation Fee</strong></td>
                <td class="price-per-pallet">USD <span id="internetinstallfeeperqty">50</span></td>
                <td class="num-pallets"><input type="text" class="internetinstallqty" disabled="disabled" value="{{ $data['internetinstallqty'] }}"></input></td>
                <input name="internetinstallqty" type="hidden" class="internetinstallqty" value="{{ $data['internetinstallqty'] }}"></input>
                <td class="row-total">
                  <input type="text" class="row-total-input-internetfee" id="totalFeeInstallInternet" disabled="disabled" value="{{ $data['internetinstallfee'] }}"></input>
                  <input name="internetinstallfee" type="hidden" id="internetinstallfee" class="row-total-input-internetfee"  value="{{ $data['internetinstallfee'] }}"></input>

                </td>
            </tr>
        </table>

        
        <span class="left" style="margin-top:20px;margin-left:30px;"><small>Our official internet provider for 37th IPA Convex is <br/><strong>PT. Hypernet.</strong></small></span>
        <table id="total-internet" class="total-table">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalInternet">{{ $data['internetsubtotal'] }}</span></td>
            <input name="internetsubtotal" id="internetsubtotal" type="hidden" class="" value="{{ $data['internetsubtotal'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input name="internetlate" id="internetlate" type="hidden" class="" value="{{ $data['internetlate'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input name="internetonsite" id="internetonsite" type="hidden" class="" value="{{ $data['internetonsite'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="faxTotalInternet">{{ $data['internettax'] }}</span></td>
            <input name="internettax" id="internettax" type="hidden" class="" value="{{ $data['internettax'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="grandTotalInternet">{{ $data['internetgrandtotal'] }}</span></td>
            <input name="internetgrandtotal" id="internetgrandtotal" type="hidden" class="" value="{{ $data['internetgrandtotal'] }}"></input>
          </tr>
        </table>
        
        <div class="clear"></div>

        <div>
            <h4>Terms & Conditions:</h4>
            <ol>
              <li>Rental price during the exhibition starts at 9.00 am until 9.00 pm.</li>
              <li>Orders without payment will not be executed.</li>
              <li>Networking, computers, switches and Ethernet card/interface are to be provided by client</li>
              <li>On-site order for internt cannot be granted</li>
            </ol>
        </div>
        
    </div>
  </div>

  <div id="step-13">
    <h2 class="StepTitle">KIOSK RENTAL</h2>
    <div id="page-wrap">
        <table id="order-table">
            <tr>
                 <th>KIOSK RENTAL</th>
                 <th>TYPE</th> 
            </tr>
            <tr>
                <td style="font-size:13px;">Details<br/><br/>
                  • Monitor LCD 17”<br/>
                  • Touchscreen<br/>
                  • CPU Intel Atom, 1GB am, <br/>
                  • 160 GB HDD<br/>
                </td>
                <td class="price-per-pallet">
                  <div class="kiosklist left" style="width:50%;">
                    <span style="display:block;margin-bottom:7px;">Type 1 : Infostar </span>
                    {{ HTML::image('images/exhibitor/kiosk1.png','',array('class'=>'')) }}
                  </div>
                  <div class="kiosklist left">
                    <span style="display:block;margin-bottom:7px;">Type 2 : Elegance </span>
                    {{ HTML::image('images/exhibitor/kiosk2.png','',array('class'=>'')) }}
                  </div>
                </td>
            </tr>
        </table>
        
        <table id="order-table">
            <tr>
                 <th style="width:357px;">PRICE / UNIT</th>
                 <th colspan="2">QUANTITY</th> 
                 <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            
            <tr class="even">
                <td class="price-per-pallet"><strong style="font-size:12.5px;margin-left:20px;">USD <span>480</span>,-</strong></td>
                <td class="num-pallets" style="text-align:center;margin:0 auto;"><span style="display:block;margin-bottom:8px;">Type 1</span><input name="kiosk1" type="text" id="numpalletskiosk1" class="num-pallets-input-kiosk" id="" style="margin:0 auto;margin-bottom:10px;" value="{{ $data['kiosk1'] }}"></input></td>
                <td class="num-pallets" style="text-align:center;margin:0 auto;"><span style="display:block;margin-bottom:8px;">Type 2</span><input name="kiosk2" type="text" id="numpalletskiosk2" class="num-pallets-input-kiosk" id="" style="margin:0 auto;margin-bottom:10px;" value="{{ $data['kiosk2'] }}"></input></td>
                <td class="row-total">
                  <input type="text" class="row-total-input-kiosk" id="" disabled="disabled" style="margin-left:20px;margin-top:20px;" value="{{ $data['rowkiosk'] }}"></input>
                  <input type="hidden" class="row-total-input-kiosk-hidden" name="rowkiosk" value="{{ $data['rowkiosk'] }}"></input>
                </td>
            </tr>
            
        </table>
        <br/>
        <br/>
        <table id="total-kiosk" class="total-table">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalKiosk">{{ $data['kiosksubtotal'] }}</span></td>
            <input type="hidden" name="kiosksubtotal" id="kiosksubtotal" value="{{ $data['kiosksubtotal'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" name="kiosklate" id="kiosklate" value="{{ $data['kiosklate'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" name="kioskonsite" id="kioskonsite" value="{{ $data['kioskonsite'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="faxTotalKiosk">{{ $data['rowkiosk'] }}</span></td>
            <input type="hidden" name="kiosktax" id="kiosktax" value="{{ $data['kiosktax'] }}"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="grandTotalKiosk">{{ $data['kioskgrandtotal'] }}</span></td>
            <input type="hidden" name="kioskgrandtotal" id="kioskgrandtotal" value="{{ $data['kioskgrandtotal'] }}"></input>
          </tr>
        </table>
        
        <div class="clear"></div>

        <div>
            <h4>Terms & Conditions:</h4>
            <ol>
              <li>Software for contents is not included.</li>
              <li>Price is already include PPN</li>
              <li>Limited stock, only 10 pieces  are available (first come first serve)</li>
            </ol>
        </div>
        
    </div>
  </div>

  <div id="step-14">
    <h2 class="StepTitle">REMINDER</h2>
    <div id="page-wrap">
        
        <div id="boothcontractor" style="font-size:13px;">
          <br/>
          <br/>
          <p>Please do re-check before you finalize filling the operational forms.Any changes will takes time to processed.<br/>
          There’s additional charges for changes made after the deadline :<br/>
          Late Order fee 30%<br/>
          On-Site Order 50%</p>

          <p>I, as the PIC, representing my company, have read and shall comply with the provision set forth related to terms and condition explained.</p>

        </div>
        
    </div>
  </div> 

</div>
{{$form->close()}}

<script type="text/javascript">
  $(document).ready(function() {
        $('#wizard').smartWizard({
          transitionEffect: 'slideleft',
          keyNavigation: false,
          enableAllSteps: true
        });
        

        $('.buttonNext').click(function () {
          gotoTop();
        });

        $('.buttonPrevious').click(function () {
          gotoTop();
        });

        function gotoTop(){
          $('body,html').animate({
            scrollTop: 400
          }, 0);
        }
        //character left
        var left = 26
        $('#text_counter').text('Characters left: ' + left);
     
            $('#fascianame').keyup(function () {
     
            left = 26 - $(this).val().length;
     
            if(left < 0){
                $('#text_counter').addClass("overlimit");
            }
            if(left >= 0){
                $('#text_counter').removeClass("overlimit");
            }
     
            $('#text_counter').text('Characters left: ' + left);
        });
  }); 
</script>
{{ HTML::script('js/edit_order.js') }}

<script>
  var index = <?php echo $data['noaddpass'];?>;
  function addfield() {
    index++;
    var appendStr = '<tr>';
    appendStr += '<td>'+index+'. </td>';
    appendStr += '<td><input name="boothassistant'+index+'" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>';
    appendStr +=  '</tr>';
    //var appendStr = '<div class="form-label"><label for="newfield'+index+'">New field no '+index+'</label></div>'
    //appendStr += '<div class="form-field"><input id="newfield'+index+'" name="newfield'+index+'" size="20" class="exit-detect"></div>'
    var stepContainerHeight = $('.stepContainer').height();
    $('#listadditionalbooth').append(appendStr);
    var calculateheight = index*60;
    
    $('.stepContainer').css("height",stepContainerHeight+60);
    //removeStr();
    $('#noaddpass').val(index);
  }

  $(document).ready(function(){

    $('#add-field').live('click', function() {
      addfield();
    });

  });
</script>

<script type="text/javascript">

var stepContainerHeightcurrent;
var stepContainerDefault;
$(document).ready(function() {
  stepContainerDefault = 700;
  $('#step-8').show();
  stepContainerHeightcurrent = $('#step-8').height();
  if(stepContainerHeightcurrent!=null){
    
    $('#step-8').hide();  
  }
});



$('#totaladdboothinput').bind("focus blur change keyup", function(){
    
  // Caching the selector for efficiency 
  var $el = $(this);

  // Grab the new quantity the user entered
  var numPallets = CleanNumber($el.val());
          


  // If the quantity is empty, reset everything back to empty
  if ( (numPallets == '') || (numPallets == 0) ) {

      $el
          .removeClass("warning")
          .parent().parent()
          .find("td.row-total input")
          .val("");
          
      var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
      
      removeName(titleClass);

  // If the quantity is valid, calculate the row total
  } else if ( (IsNumeric(numPallets)) && (numPallets != '') ) {
      
      //var rowTotal = numPallets * multiplier;
      
      /*$el
          .removeClass("warning")
          .parent().parent()
          .find("td.row-total input")
          .val(rowTotal);*/
          
      var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
              
      applyName(titleClass, numPallets);
                                 
  } else {

      $el
          .addClass("warning")
          .parent().parent()
          .find("td.row-total input")
          .val("");
      
      var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
      
      removeName(titleClass);
                                    
  };


  displayinputadditionalboot();
  calcProdSubTotalAddbooth();
  calcTaxAddbooth();
  calcOrderTotalAddbooth();


  });

  function displayinputadditionalboot(){
  
  var totalfields = 0;
  var totalfields = $("#totaladdboothinput").val()|| 0;
  var totalfieldsNum = parseFloat(totalfields);
  var totalfieldsNumtoadd = parseFloat(totalfields-totalfields);
  

  $('.addboothrow').remove();
  var totaladdboothrecent = <?php echo $data['totaladdbooth'];?>
  //alert(totalfields);
  if((totalfieldsNum!=totaladdboothrecent)){
      for(var i=totaladdboothrecent; i<totalfieldsNum; i++){
          console.log(totalfieldsNumtoadd);
          totaladdboothrecent++;
          var appendStr = '<tr class="addboothrow">';
          appendStr += '<td>'+totaladdboothrecent+'. </td>';
          appendStr += '<td><input name="addboothname'+totaladdboothrecent+'" type="text" class="passholderbooth" id="" placeholder="John Dochin"></input></td>';
          appendStr +=  '</tr>';
          //var appendStr = '<div class="form-label"><label for="newfield'+index+'">New field no '+index+'</label></div>'
          //appendStr += '<div class="form-field"><input id="newfield'+index+'" name="newfield'+index+'" size="20" class="exit-detect"></div>'
          var stepContainerHeight = $('.stepContainer').height();
          $('#listaddboothedit').append(appendStr);
      }
      var totalheight = window.stepContainerDefault+(60*totalfieldsNum);
      $('.stepContainer').css("height",totalheight);
      //console.log(window.stepContainerHeightcurrent+(60*totalfieldsNum));
  }else if(totalfieldsNum==totaladdboothrecent){
    $('.stepContainer').css("height",window.stepContainerHeightcurrent);
  }
  /*}else if(totalfieldsNum<totaladdboothrecent){
    $('#totaladdboothinput').val(totaladdboothrecent);
  }*/

  }

  function calcProdSubTotalAddbooth() {

  var prodSubTotal = 0;

  $(".row-total-input-addBooth").each(function() {

      var valString = $(this).val() || 0;
      
      prodSubTotal += parseInt(valString);

      
  });

  $("#subTotalAddbooth").text(CommaFormatted(prodSubTotal));
  $("#addboothsubtotal").val(prodSubTotal);

  }
  function calcTaxAddbooth() {

  var totaltax = 0;

  var productSubtotal = $("#subTotalAddbooth").text() || 0;

  var totaltax = (10 * parseInt(CleanNumber(productSubtotal)))/100;    

  $("#faxTotalAddbooth").text(CommaFormatted(totaltax));
  $("#addboothtax").val(totaltax);

  }

  function calcOrderTotalAddbooth() {

  var orderTotal = 0;

  var productSubtotal = $("#subTotalAddbooth").text() || 0;
  var taxTotal = $("#faxTotalAddbooth").text() || 0;
      
  var orderTotal = parseInt(CleanNumber(productSubtotal)) + parseInt(CleanNumber(taxTotal));    
      
  $("#grandTotalAddbooth").text(CommaFormatted(orderTotal));
  $("#addboothgrandtotal").val(orderTotal);
  //$("#fc-price").attr("value", orderTotal);

  }

</script>
@endsection