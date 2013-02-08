<p><?php
	echo 'Jakarta, '.date('l jS F Y');
?>
</p>

<p>Attention to: <br/>
Name : {{ $data['firstname'].' '.$data['lastname'] }}<br/>
Position : {{ $data['position'] }}<br/>
Company : {{ $data['company'] }}<br/>
Address : {{ $data['address'].' '.$data['city'].' '.$data['zip'] }}<br/>
Registration Number : <strong>{{ $data['registrationnumber'] }}</strong></p>

<p>Dear Sir/Madam,
Thank you for register in 37th IPA Convention & Exhibition. Please find below summary of your registration:</p>

<p><strong><u>CONVENTION REGISTRATION</u></strong></p>

<p>Type of registration fee 
	@if($data['regtype'] == 'PO')
		(Professional / Delegate Overseas)
	@elseif($data['regtype'] == 'PD')
		(Professional / Delegate Domestic)
	@elseif($data['regtype'] == 'SD')
		(Student Domestic)
	@elseif($data['regtype'] == 'SO')
		(Student Overseas)
	@endif : 
	@if($data['regtype'] == 'PO')
		USD 500
	@elseif($data['regtype'] == 'PD')
		IDR 4.500.000,-
	@elseif($data['regtype'] == 'SD')
		IDR 400.000,-
	@elseif($data['regtype'] == 'SO')
		USD 120
	@endif
<br/>
Attend on Industrial Dinner (16 May 2012): {{ $data['attenddinner'] }}
</p>

<p><i>*Convention registration fee includes admission to all Plenary & Technical Sessions, Conference Kits, Opening and
Closing Ceremony, Lunches, Coffee Breaks, Industrial Cocktail, Industrial Dinner, and Entrance to Exhibition Area.</i></p>

<p>For the registration payment, you can settle it by bank transfer to:</p>

<p>IDR Account:<br/>
BCA - Mangga Dua Branch<br/>
Acc. No.  : 335.302.7677<br/>
Acc. Name : PT Dyandra Promosindo</p>

<p>USD Account:<br/>
BCA - Wisma Nusantara Branch<br/>
Acc. No.  : 734.038.5700<br/>
Acc. Name : PT Dyandra Promosindo<br/>
Swiftcode : CENAIDJA</p>

<p>Please send us copy of your bank transfer to our secretariat by email to conventionipa2013@dyandra.com or
fax 62-21-31997176. Confirmation of Registration will be sent once the payment received. Please bring the
confirmation of registration to the registration counter when you re-register on the conference day.</p>


<p><strong><u>IMPORTANT NOTES</u></strong></p>
<ol>
	<li style="margin:3px;">Early Bird rates only valid for both registration and payment received until 15 March 2013 at the latest.
Normal rate will be applied for the registration with payment settlement after 15 March 2013.</li>
	<li style="margin:3px;">Registration is subject to acceptance on a first-come-first-served basis.</li>
	<li style="margin:3px;">Registration Forms received without registration fees will not be processed.</li>
	<li style="margin:3px;">No refund will be granted for cancellation after 14 April 2013. All cancellations must be made in writing to the
Secretariat and the refund will be made after the conference.</li>
	<li style="margin:3px;">If billing address for sending the invoice is different from participant’s company information, please send
billing address information along with the registration form.</li>
	<li style="margin:3px;">Registration counter will be open in front of JCC Main Lobby on:
		<ul>
			<li><span style="margin:6px;display:inline-block;width:20%;">Monday</span> <span style="display:inline-block;width:20%;">13 May 2013</span><span style="display:inline-block;width:30%;">10.00 AM – 03.00 PM</span></li>
			<li><span style="margin:6px;display:inline-block;width:20%;">Tuesday</span> <span style="display:inline-block;width:20%;">14 May 2013</span><span style="display:inline-block;width:30%;">10.00 AM – 03.00 PM</span></li>
			<li><span style="margin:6px;display:inline-block;width:20%;">Wednesday</span> <span style="display:inline-block;width:20%;">15 May 2013</span><span style="display:inline-block;width:30%;">08.00 AM – 03.00 PM</span></li>
			<li><span style="margin:6px;display:inline-block;width:20%;">Thursday</span> <span style="display:inline-block;width:20%;">16 May 2013</span><span style="display:inline-block;width:30%;">08.00 AM – 03.00 PM</span></li>
			<li><span style="margin:6px;display:inline-block;width:20%;">Friday</span> <span style="display:inline-block;width:20%;">17 May 2013</span><span style="display:inline-block;width:30%;">08.00 AM – 12.00 PM</span></li>
		</ul>
	</li>
	<li>Registered participants must wear ID badges all the times for sessions and function access</li>

</ol>

<p>If you need further information regarding the conference, please feel free to contact us.
Thank you very much for your participation and we look forward to see you on 37 th IPA Convex.</p>

<p>Regards,<br/>
37th IPA Convex Secretariat<br/>
PT Dyandra Promosindo<br/>
The City Tower, 7th Floor | Jl. M.H. Thamrin No. 81 | Jakarta 10310 - Indonesia<br/>
T. +62-21-31996077, 31997174 (direct) | F. +62-21-31997176<br/>
E. ipaconvention@dyandra.com | W. www.ipaconvex.com</p>
