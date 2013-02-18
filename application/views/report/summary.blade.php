@layout('master')

@section('content')
<div class="metro span12">
	<div class="metro-sections">

	   <div id="section1" class="metro-section tile-span-8">
	   		<div class="blockseparate">
		      <h2>Convention Registration</h2>
		     <!-- <h5>Convention Registration</h5> -->
		      <a class="tile imagetext bg-color-blue statistic" href="#">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['PO']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Professional</div>
		            <div class="text">Overseas</div>
		            <div class="text">Participants</div>
		         </div>   
		      </a>
		      <a class="tile imagetext bg-color-purple statistic" href="#">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['PD']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Professional</div>
		            <div class="text">Domestic</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
		      <a class="tile imagetext bg-color-red statistic" href="#">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['SO']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Student</div>
		            <div class="text">Overseas</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
		      <a class="tile imagetext bg-color-orange statistic" href="#">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['SD']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Student</div>
		            <div class="text">Domestic</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
		      <a class="tile wide imagetext greenDark statistic" href="#">
		         <div class="image-wrapper">
		            <div class="text-biggest">{{ $stat['Attendee']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total Convention</div>
		            <div class="text">Registration</div>
		         </div>
		         <span class="app-label">(not including FOC)</span>
		      </a>
		      <a class="tile app bg-color-empty" href="#"></a>
	  		</div>
	      <div class="clear"></div>

	      <div class="separateMetro">
		      <h2>Paid & Unpaid </h2>
		      <a class="tile imagetext bg-color-greenDark statistic" href="#">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['paidAttendee']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total</div>
		            <div class="text">Paid</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
		      <a class="tile imagetext bg-color-red statistic" href="#">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['unpaidAttendee']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total</div>
		            <div class="text">Unpaid</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
	      </div>

	      <div class="separateMetro">
		      <h2>Golf & Galla Dinner</h2>

		      <!--<a class="tile wide imagetext bg-color-purple statistic" href="#">
		         <div class="image-wrapper">
		            <div class="text-biggest">{{ $stat['Golf']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total Golf</div>
		            <div class="text">Participants</div>
		         </div>
		         <span class="app-label">(not including FOC)</span>
		      </a>-->

		      <a class="tile imagetext bg-color-blue statistic" href="#">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['Golf']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total</div>
		            <div class="text">Golf</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
		      <a class="tile imagetext bg-color-purple statistic" href="#">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['Dinner']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total</div>
		            <div class="text">Dinner</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
	      </div>
	      <div class="separateMetro">
	      <h2>Registration by Country</h2>
	      <table class="report">
	      	<?php foreach ($country as $key =>$value ) {
	      		if($coutryValue[$value] > 0){?>
		      	<tr>
		      		<td>{{$value}}</td>
		      		<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
		      		<td class="countresult">{{$coutryValue[$value]}}</td>
		      	</tr>
	      	<?php 
	      		}
	      	}
	      	
	      	?>
	      	
	      </table>
	  		</div>
	      <div class="clear"></div>
	      
	   </div>

		
	</div>
</div>


@endsection