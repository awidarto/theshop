<h2 class="StepTitle">EXHIBITOR PASS (FREE)</h2>   
    <div id="boothcontractor">
      <br/>
      <p>Exhibitors have an entitlement for certain number of FREE Exhibitor Pass as indicated below</p>
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
          <td>>45</td>
          <td>Sqm booth space for</td>
          <td>:</td>
          <td>10</td>
          <td>people</td>
        </tr>
      </table>
      <div class="clear"></div>
      <?php
       
        $sizebooth = $booth['size'];

        if($sizebooth >= 9 && $sizebooth <= 18){
          $pass = 2;
        }else if($sizebooth >= 18 && $sizebooth <= 27){
          $pass = 4;
        }else if($sizebooth >= 27 && $sizebooth <= 36){
          $pass = 6;
        }else if($sizebooth >= 36 && $sizebooth <= 45){
          $pass = 8;
        }else if($sizebooth >= 45){
          $pass = 10;
        }else{
          $pass = 10;
        }
        
      ?>
      <p><strong>If your booth size is in between those explained number, kindly ask your Hall coordinator for assistance.</strong></p>
      <p> Your Booth Number is : <strong>{{$booth['boothno']}}</strong> and you have <strong>{{ $pass }}</strong> persons to register
      <p>Please list below the names of EXHIBITOR’S PASS HOLDERS you wish to register:</p>
      <table id="order-table">
        <thead>
          <tr>
            <th>No.</th>            
            <th>Names of Exhibitor’s Pass Holders</th>
          </tr>
        </thead>
        <tbody>
          @for($i=1;$i<=$pass;$i++)
            <tr>
              <td>{{ $i }}. </td>
              <td>{{ $form->text('freepassname'.$i,'','',array('class'=>'passholderbooth','placeholder'=>'Type name here')) }}</td>
            </tr>
          @endfor
          
        </tbody>
      </table>
      <br/>
      <strong>Terms & Conditions:</strong><br/>
      <ol>
        <li>The Exhibitor Passes entitle holders for coffee break and lunch during 3 days of exhibition</li>
        <li>Maximum 10 Exhibitor Passes per company</li>
        <li>Please register the names of your exhibitor pass holders by filling the registration form (form 5 & 6)</li>
        <li>Exhibitor pass does not include free entry to the <u>Plenary Session, but holder may attend TPC.</u></li>
      </ol>
      <br/>
      <br/>
    </div>