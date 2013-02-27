@layout('public')
@section('content')
<div class="tableHeader">
    <h3>{{$title}}</h3>
</div>

<div id="wizard" class="swMain">
  <ul>
    <li><a href="#step-1">
          <label class="stepNumber">1</label>
      </a></li>
    <li><a href="#step-2">
          <label class="stepNumber">2</label>
      </a></li>
    <li><a href="#step-3">
          <label class="stepNumber">3</label>
       </a></li>
    <li><a href="#step-4">
          <label class="stepNumber">4</label>
      </a></li>
  </ul>
  <div id="step-1">

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
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="sparkle-num-pallets"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="sparkle-row-total" disabled="disabled"></input></td>
            </tr>
            <tr class="even">
                <td>2</td>
                <td class="product-title">4A / 1 ph / 880 Watt</td>
                <td class="price-per-pallet">USD <span>177</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-mvp-num-pallets"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-mvp-row-total" disabled="disabled"></input></td>
            </tr>
            <tr class="odd">
                <td>3</td>
                <td class="product-title">6A / 1 ph / 1.320 Watt</td>
                <td class="price-per-pallet">USD <span>265</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-pro-league-num-pallets" ></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-pro-league-row-total" disabled="disabled"></input></td>
            </tr>
           
            <tr class="odd">
                <td>4</td>
                <td class="product-title">10A / 1 ph / 2.200 Watt</em></td>
                <td class="price-per-pallet">USD <span>442</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-quick-dry-num-pallets" ></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-quick-dry-row-total" disabled="disabled"></input></td>
            </tr>
            <tr class="even">
                <td>5</td>
                <td class="product-title">16A / 1 ph / 3.520 Watt</td>
                <td class="price-per-pallet">USD <span>706</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-mound-clay-red-num-pallets"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-mound-clay-red-row-total" disabled="disabled"></input></td>
            </tr>
            <tr class="odd">
                <td>6</td>
                <td class="product-title">32A / 1 ph / 7.040 Watt</td>
                <td class="price-per-pallet">USD <span>1412</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-red-num-pallets" ></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-red-row-total" disabled="disabled"></input></td>
            </tr>
            <tr class="even">
                <td>7</td>
                <td class="product-title">16A / 3 ph / 10.560 Watt</td>
                <td class="price-per-pallet">USD <span>2118</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-drying-agent-num-pallets"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-drying-agent-row-total" disabled="disabled"></input></td>
            </tr>
            <tr class="odd">
                <td>8</td>
                <td class="product-title">32A / 3 ph / 21.120 Watt</em></td>
                <td class="price-per-pallet">USD <span>4235</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-professional-num-pallets" ></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-professional-row-total" disabled="disabled"></input></td>
            </tr>
            <tr class="even">
                <td>9</td>
                <td class="product-title">60A / 3 ph / 39.600 Watt</td>
                <td class="price-per-pallet">USD <span>7941</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-top-dressing-num-pallets"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-top-dressing-row-total" disabled="disabled"></input></td>
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
                <td class="textcentertable">USD 50</td>
                <td class="textcentertable">1</td>
                <td class="textcentertable">USD 50</td>
            </tr>
        </table>

        <table id="total-electric">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="product-subtotal"></span></td>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="product-tax"></span></td>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="order-total"></span></td>
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
  <div id="step-2">
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
                <td class="price-per-pallet">USD <span>252</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input-phone" id="sparkle-num-pallets"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="sparkle-row-total" disabled="disabled"></input></td>
            </tr>
            <tr class="even">
                <td>2</td>
                <td class="product-title"><Strong>Hotline</strong><br/>
                • Service coverage: local, national, mobile phone, credit or debit card authorization.<br/>
                • Commonly used for EDC / credit card purchasing.<br/>
                • Price includes call credit & installation.<br/>
                • Call back is not applicable.<br/></td>
</td>
                <td class="price-per-pallet">USD <span>402</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input-phone" id="turface-mvp-num-pallets"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-mvp-row-total" disabled="disabled"></input></td>
            </tr>
            
        </table>

        

        <table id="total-electric">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalPhone"></span></td>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="faxTotalPhone"></span></td>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="grandTotalPhone"></span></td>
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
  <div id="step-3">
      <h2 class="StepTitle">Step 3 Title</h2>   
       <!-- step content -->
  </div>
  <div id="step-4">
      <h2 class="StepTitle">Step 4 Title</h2>   
       <!-- step content -->                         
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
        $('#wizard').smartWizard();
  }); 
</script>
{{ HTML::script('js/order.js') }}
@endsection