@layout('master')

@section('content')
<div class="metro span12">
	<div class="metro-sections">
		<div id="section1" class="metro-section tile-span-4">
			<h2>Convention Registration</h2>
			<a class="tile square text tilesquareblock reportBlock" href="#">
		       <div class="text-big">{{ $stat['PD'] }}</div>
		       <div class="text">Professional Domestic</div>
		    </a>

		    <a class="tile square text tilesquareblock reportBlock" href="#">
		       <div class="text-big">{{ $stat['PO'] }}</div>
		       <div class="text">Professional Overseas</div>
		    </a>

		    <a class="tile square text tilesquareblock reportBlock" href="#">
		       <div class="text-big">{{ $stat['SD'] }}</div>
		       <div class="text">Student Domestic</div>
		    </a>

		    <a class="tile square text tilesquareblock reportBlock" href="#">
		       <div class="text-big">{{ $stat['SO'] }}</div>
		       <div class="text">Student Overseas</div>
		    </a>

			<a class="tile wide text totalBlockReport" href="#">
	           <div class="text-header">Total &nbsp;&nbsp;&nbsp;</div>
	           <div class="texttotal">{{ $stat['Attendee'] }}</div>
	        </a>
		</div>
		<div id="section2" class="metro-section tile-span-4">
			<h2>&nbsp;</h2>
			<a class="tile square text tilesquareblock reportBlock bg-color-red" href="#">
		       <div class="text-big">{{ $stat['unpaidAttendee'] }}</div>
		       <div class="text">Total Unpaid</div>
		    </a>

		    <a class="tile square text tilesquareblock reportBlock bg-color-purple" href="#">
		       <div class="text-big">{{ $stat['paidAttendee'] }}</div>
		       <div class="text">Total Paid</div>
		    </a>
		</div>
	</div>
</div>


@endsection