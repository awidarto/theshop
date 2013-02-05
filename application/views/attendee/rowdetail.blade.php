@section('row')
		var extra = aData['extra'];
		sOut += '<tr class="irc_pc"></tr>';
	    sOut += '<tr><td>Company Address </td><td>&nbsp;&nbsp;&nbsp;&nbsp;: '+ extra.address + ',' + extra.city + ',' + extra.country +'</td></tr>';
	    sOut += '<tr><td>Company Phone </td><td>&nbsp;&nbsp;&nbsp;&nbsp;: '+ extra.companyphone+'</td></tr>';
	    sOut += '<tr><td>Company Fax </td><td>&nbsp;&nbsp;&nbsp;&nbsp;: '+ extra.companyfax+'</td></tr>';
	    sOut += '<tr><td>Industrial Dinner</td><td class="icon- fontGreen align-center">&nbsp;&nbsp;&nbsp;&nbsp;<small>&#xe20c;</small></td></tr>';
	    
@endsection