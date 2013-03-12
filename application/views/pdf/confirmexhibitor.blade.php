<html>
<head>
<style>

body{
	font-size: 11px;
	font-family: 'Verdana','Helvetica','Arial',serif;
}
.row{
	width: 100%;
	position: relative;
	font-size:12px;
}
#logo{
	width:130px;
}
#header h2,#header h3,#header h5{
	margin:0;
	padding:0;
}
#header h2{
	font-size: 17px;
	margin-top: 6px;
}
#header h3{
	font-size: 15px;	
}
#header h5{
		font-size: 12px;	
}
.big{
	width:200px;
}
.aligntop{
	vertical-align: top;
}
.alignright{
	text-align: right;
}
.aligncenter{
	text-align: center;
}
hr{
	background-color: #d2d2d2;
	color: #d2d2d2;
	margin:0 0 15px 0;
}
.headrow td{
	background-color:#a8a8a8; 
	padding:20px;
	color: #fff;
	margin:0;
}
.bigheader{
	width: 180px;
}
.detailheader{
	width: 210px;
}
#detail-request{
	margin-top: 15px;
}
.floatleft{
	float: left;
	text-align: left;
}
.contentrow td{
	padding:8px;
	margin:0;

}
.odd td{
	background-color: #dadada;
}
</style>
</head>

<body>
<?php 
	setlocale(LC_MONETARY, "en_US");
	$subtotalall = $data['electricsubtotal']+$data['phonesubtotal']+ $data['addboothsubtotal']+ $data['advertsubtotal']+$data['furnituresubtotal']+ $data['internetsubtotal']+ $data['kiosksubtotal'];
	$lateorderfee = 0;
	$onsitefee = 0;
	$ppn = (10 * $subtotalall)/100;
	$grandtotal = $subtotalall+$lateorderfee+$onsitefee+$ppn;
?>

	<table id="header">
		<tr>
			<td rowspan="3" id="logo"><img src="http://localhost/eventreg/public/images/ipa-logo.jpg"></td>
		</tr>
		<tr colspan="15">
			<td><h2>CONFIRMATION OF OPERATIONAL FORMS</h2>
			<h3 >THE 37TH IPA CONVENTION AND EXHIBITION 2013</h3>
			<h5>JAKARTA CONVENTION CENTER, 15-17 MAY 2013</h5>
		</tr>
		
	</table>
	<hr/>
	<table id="personalinfo">
		<tr>
			<td class="big aligntop">
				Company PIC
			</td>
			<td class="aligntop">
			Name
			</td>
			<td>:</td>
			<td>{{ $user['salutation']}}. {{ $user['firstname'].' '.$user['lastname'] }}<br/>
				{{ $user['position']}}<br/>
				{{ $user['company']}}<br/>
				{{ $user['address_1']}},<br/>
				{{ $user['address_2']}},<br/>
				{{ $user['city']}} - {{ $user['zip']}}<br/>
				{{ $user['country']}}<br/>
			</td>
			<td class="big aligntop alignright">{{ $user['registrationnumber']}}</td>
		</tr>

		<tr >
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>

		<tr >
			<td>&nbsp;</td>
			<td>Telephone</td>
			<td>:</td>
			<td>{{ $user['companyphonecountry']}}-{{ $user['companyphonearea']}}-{{ $user['companyphone']}}</td>
			<td>&nbsp;</td>
		</tr>
		<tr >
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>Fax</td>
			<td>:</td>
			<td>{{ $user['companyfaxcountry']}}-{{ $user['companyfaxarea']}}-{{ $user['companyfax']}}</td>
			<td>&nbsp;</td>
		</tr>

	</table>
	

	<div class="clear"></div>

	<table id="detail-request">
		<tr class="headrow">
			<td class="bigheader">FORMS</td>
			<td>Filled (Y/N)</td>
			<td class="detailheader">Details</td>
			<td>Sub-Total (US$)</td>
		</tr>
		<tr class="contentrow">
			<td>Electricity Instalation</td>
			<td class="aligncenter">
				@if( $data['electricsubtotal']!='' && $data['electricsubtotal']!=0)
					Y
				@else
					N
				@endif
			</td>
			<td>&nbsp;</td>
			<td class="alignright">
				<span class="floatleft">USD</span>
				<?php
				if($data['electricsubtotal']!= 0 && $data['electricsubtotal']!= ''):
					echo number_format($data['electricsubtotal'], 2, ',', ' ');
				endif;?>
			</td>
		</tr>

		<tr class="contentrow odd">
			<td>Telephone Instalation</td>
			<td class="aligncenter">
				@if( $data['phonesubtotal']!='' && $data['phonesubtotal']!=0)
					Y
				@else
					N
				@endif
			</td>
			<td>&nbsp;</td>
			<td class="alignright">
				<span class="floatleft">USD</span>
				<?php
				if($data['phonesubtotal']!= 0 && $data['phonesubtotal']!= ''):
					echo number_format($data['phonesubtotal'], 2, ',', ' ');
				endif;?>
			</td>
		</tr>
	</table>
	
	<div >
		<ul >
			<li > -  PLEASE CHECK AGAIN IF THIS RECIEPT IS MATCH YOUR NEEDS</li>
			<li > -  PLEASE SIGNED THIS CONFIRMATION LETTER AND SEND IT BACK TO THE ORGANIZER</li>
			<li >  - AFTER WE RECEIVE THE CONFIRMATION LETTER, WE WILL SEND YOU THE INVOICE</li>
		</ul>
		
	</div>



</body>
</html>
