@layout('master')

@section('content')
<!--<div class="tableHeader">
	@if($title != '')
		<h3>{{$title}}</h3>
	@endif
	@if(isset($addurl) && $addurl != '')
		<a class="foundicon-add-doc button right newdoc action clearfix" href="{{URL::to($addurl)}}">&nbsp;&nbsp;<span>{{$newbutton}}</span></a>
	@endif
</div>
-->
<div class="span12">
   
    <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->

    <div id="content-filters" class="row-fluid" style="display:none;">
       <div class="span12">
          <h5>Filter Data</h5>
          <ul class="nav nav-pills">
             <li class="dropdown">
                <a class="dropdown-toggle accent-color" data-toggle="dropdown" href="#">
                   All projects
                   <b class="caret" href="#"></b>
                </a>
                <ul id="projects-filter" class="dropdown-menu">
                   <li><a href="#">All projects</a></li>
                   <li><a href="#">ACME</a></li>
                   <li><a href="#">Surface</a></li>
                   <li><a href="#">OSX</a></li>
                   <li><a href="#">WinRT</a></li>
                </ul>
             </li>
             <li class="dropdown">
                <a class="dropdown-toggle accent-color" data-toggle="dropdown" href="#">
                   All budgets
                   <b class="caret" href="#"></b>
                </a>
                <ul id="budget-filter" class="dropdown-menu">
                   <li><a href="#">All budgets</a></li>
                   <li><a href="#">Budget &lt; 1.000</a></li>
                   <li><a href="#">Budget 1.000 - 10.000</a></li>
                   <li><a href="#">Budget 10.000 - 45.000</a></li>
                   <li><a href="#">Budget 45.000 - 100.000</a></li>
                   <li><a href="#">Budget &gt; 100.000</a></li>
                </ul>
             </li>
             <li class="">
                <a>&nbsp;|&nbsp;</a><span>Sort by&nbsp;</span>
             </li>
             <li class="dropdown">

                <a class="dropdown-toggle accent-color" data-toggle="dropdown" href="#">
                   Project name
                   <b class="caret" href="#"></b>
                </a>
                <ul id="sort-filter" class="dropdown-menu">
                   <li><a href="#">Project name</a></li>
                   <li><a href="#">Budget Cost</a></li>
                   <li><a href="#">Duration</a></li>
                </ul>
             </li>
          </ul>
       </div>
    </div>

    <div class="row-fluid">
       <div class="span12">
<!--<<<<<<< 
          <table class="table table-condensed masterDataTable">
             <thead>
             <tr>
                <th class="span1">ID</th>
                <th>Company</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th class="span4">Email</th>
                <th class="span1">Phone</th>
                <th class="span1">Reg.Date</th>
                <th class="span4 text align-center">Status</th>
                <th>Industrial Dinner</th>
                <th class="span2">Action</th>
                
             </tr>
             </thead>
=======-->
          <table class="table table-condensed dataTable">

			    <thead>
			        <tr>
			        	<?php
				        	if(!isset($colclass)){
				        		$colclass = array();
				        	}
			        		$hid = 0;
			        	?>
			        	@foreach($heads as $head)
			        		<th 
			        			@if(isset($colclass[$hid]))
			        				class="{{$colclass[$hid]}}"
			        			@endif
			        			<?php $hid++ ?>
			        		>
			        			{{ $head }}
			        		</th>
			        	@endforeach
			        </tr>
			    </thead>

             <tbody>
             <tr>
                <td class="span1"><a href="#myModal" data-toggle="modal">2707</a></td>
                <td class="nationality">VICO Indonesia<br/><small>Indonesia</small></td>
                <td>Mohammad</td>
                <td>Irvan</td>
                <td class="span4">mohammadirvan@yahoo.com</td>
                <td class="span1">423423499</td>
                <td class="span1">08-05-2012 05:05:34</td>
                <td class="span4 align-center">Professional Overseas<br/><span class="fontGreen fontBold">PAID</span></td>
                <td class="icon- fontGreen align-center"><small>&#xe20c;</small></td>
                <td class="span2">
                   <a class="icon-" href="#"><i>&#xe14c;</i><span>Print Badge</span></a>
                   <a class="icon-" href="#"><i>&#xe164;</i><span>Edit Profile</span></a>
                </td>
                
             </tr>
             
             

             <tr>
                <td class="span1"><a href="#myModal2" data-toggle="modal">2707</a></td>
                <td class="nationality">VICO Indonesia<br/><small>Indonesia</small></td>
                <td>Mohammad</td>
                <td>Irvan</td>
                <td class="span4">mohammadirvan@yahoo.com</td>
                <td class="span1">423423499</td>
                <td class="span1">08-05-2012 05:05:34</td>
                <td class="span4 align-center">Professional Domestic<br/><span class="fontRed fontBold">UNPAID</span></td>
                <td class="icon- fontGreen align-center"><small>&#xe20c;</small></td>
                <td class="span2">
                   <a class="icon-" href="#"><i>&#xe14c;</i><span>Print Badge</span></a>
                   <a class="icon-" href="#"><i>&#xe164;</i><span>Edit Profile</span></a>
                </td>
             </tr>
             <tr>
                <td class="span1"><a href="#myModal" data-toggle="modal">2707</a></td>
                <td class="nationality">VICO Indonesia<br/><small>Indonesia</small></td>
                <td>Mohammad</td>
                <td>Irvan</td>
                <td class="span4">mohammadirvan@yahoo.com</td>
                <td class="span1">423423499</td>
                <td class="span1">08-05-2012 05:05:34</td>
                <td class="span4 align-center">Professional Domestic<br/><span class="fontGreen fontBold">PAID</span></td>
                <td class="icon- fontGreen align-center"><small>&#xe20c;</small></td>
                <td class="span2">
                   <a class="icon-" href="#"><i>&#xe14c;</i><span>Print Badge</span></a>
                   <a class="icon-" href="#"><i>&#xe164;</i><span>Edit Profile</span></a>
                </td>
             </tr>

             </tbody>
		    	@if($searchinput)
				    <tfoot>
					    <tr>
				    	@foreach($searchinput as $in)
				    		@if($in)
				        		<td><input type="text" name="search_{{$in}}" id="search_{{$in}}" value="Search {{$in}}" class="search_init" /></td>
				    		@else
				        		<td>&nbsp;</td>
				    		@endif
				    	@endforeach
					    </tr>
				    </tfoot>
			    @endif

          </table>

       </div>
    </div>

 </div>
<footer class="win-ui-dark win-commandlayout navbar-fixed-bottom">
  <div class="container">
     <div class="row">
        <div class="span6 align-left">
           <a class="win-command" href="{{ URL::base()}}">
              <span class="win-commandimage win-commandring">!</span>
              <span class="win-label">Home</span>
           </a>

           <hr class="win-command" />

           <button class="win-command" onclick="toggle_visibility('content-filters');">
              <span class="win-commandimage win-commandring">&#x0067;</span>
              <span class="win-label">Filter</span>
           </button>
<!--<<<<<<< 
           	@if(isset($addurl) && $addurl != '')
				<a class="win-command" href="{{URL::to($addurl)}}">
					<span class="win-commandimage win-commandring">&#xe03e;</span>
              		<span class="win-label">Add</span>
				</a>
			@endif
           
-->

		   	@if(isset($addurl) && $addurl != '')
				<a class="win-command" href="{{URL::to($addurl)}}">
					<span class="win-commandimage win-commandring">&#xe03e;</span>
					<span class="win-label">Add</span>
				</a>
			@endif


        </div>
        
     </div>
  </div>
</footer>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
   <h3 id="myModalLabel">Attendee Details</h3>
 </div>
 <div class="modal-body">
 	<div class="attendeeDetails">
 		<span class="paidStatus"><strong>PAID</strong></span>
 		<div class="row-fluid">
 			{{ HTML::image('images/2705_bar.png','bar',array('class'=>'barcode')) }}
 		</div>
		<div class="row-fluid">
			<div class="span4">Registration Number</div>
			<div class="span8">: 10-00-002147</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Name</div>
			<div class="span8">: Mr Hazman Hazman</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Cellphone</div>
			<div class="span8">: 081932416264</div>
		</div>
		<div class="row-fluid">
			<div class="span4">E-mail Address</div>
			<div class="span8">: vicohh@email.com</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Nationality</div>
			<div class="span8">: Domestic</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Company</div>
			<div class="span8">: VICO Indonesia</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Company Address</div>
			<div class="span8">: VICO Indonesia Wisma Mulia, 48th - 49th Floor Jl. Jend. Gatot Subroto No. 42, , Jakarta 12710, Indonesia</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Company Phone</div>
			<div class="span8">: (021) 523-6000</div>
		</div>
	</div>
 </div>
 <div class="modal-footer">
   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
   <button class="btn btn-primary">Save changes</button>
 </div>
</div>


<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
   <h3 id="myModalLabel">Attendee Details</h3>
 </div>
 <div class="modal-body">

 	<div class="attendeeDetails">
 		{{ HTML::image('images/2705_bar.png','bar',array('class'=>'barcode2')) }}
 		<span class="paidStatus unpaid"><strong>UNPAID</strong></span>
		<div class="row-fluid">
			<div class="span4">Registration Number</div>
			<div class="span8">: 10-00-002147</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Name</div>
			<div class="span8">: Mr Hazman Hazman</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Cellphone</div>
			<div class="span8">: 081932416264</div>
		</div>
		<div class="row-fluid">
			<div class="span4">E-mail Address</div>
			<div class="span8">: vicohh@email.com</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Nationality</div>
			<div class="span8">: Domestic</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Company</div>
			<div class="span8">: VICO Indonesia</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Company Address</div>
			<div class="span8">: VICO Indonesia Wisma Mulia, 48th - 49th Floor Jl. Jend. Gatot Subroto No. 42, , Jakarta 12710, Indonesia</div>
		</div>
		<div class="row-fluid">
			<div class="span4">Company Phone</div>
			<div class="span8">: (021) 523-6000</div>
		</div>
	</div>
 </div>
 <div class="modal-footer">
   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
   <button class="btn btn-primary">Save changes</button>
 </div>
</div>

<script type="text/javascript">

	var oTable;

	function toggle_visibility(id) {
		$('#' + id).toggle();
	}

	/* Formating function for row details */
	function fnFormatDetails ( nTr )
	{
	    var aData = oTable.fnGetData( nTr );

	    console.log(aData);

	    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

	    @yield('row')

	    sOut += '</table>';
	     
	    return sOut;
	}

    $(document).ready(function(){

		$('.activity-list').tooltip();

		var asInitVals = new Array();
        
        oTable = $('.dataTable').DataTable(
			{
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{$ajaxsource}}",
				"oLanguage": { "sSearch": "Search "},
				"sPaginationType": "full_numbers",
				"sDom": 'lfrpitT',
				"oTableTools": {
					"sSwfPath": "assets/swf/copy_csv_xls_pdf.swf"
				},
				"aoColumnDefs": [ 
				    { "bSortable": false, "aTargets": [ {{ $disablesort }} ] }
				 ],
			    "fnServerData": function ( sSource, aoData, fnCallback ) {
		            $.ajax( {
		                "dataType": 'json', 
		                "type": "POST", 
		                "url": sSource, 
		                "data": aoData, 
		                "success": fnCallback
		            } );
		        }
			}
        );

		$('.dataTable tbody td .expander').live( 'click', function () {

			console.log('click');

		    var nTr = $(this).parents('tr')[0];
		    if ( oTable.fnIsOpen(nTr) )
		    {
		        /* This row is already open - close it */
		        //this.src = "../examples_support/details_open.png";
		        oTable.fnClose( nTr );
		    }
		    else
		    {
		        /* Open this row */
		        //this.src = "../examples_support/details_close.png";
		        oTable.fnOpen( nTr, fnFormatDetails(nTr), 'details-expand' );
		    }
		} );        

		$('tfoot input').keyup( function () {
			/* Filter on the column (the index) of this element */
			oTable.fnFilter( this.value, $('tfoot input').index(this) );
		} );

		/*
		 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
		 * the footer
		 */
		$('tfoot input').each( function (i) {
			asInitVals[i] = this.value;
		} );

		$('tfoot input').focus( function () {
			if ( this.className == 'search_init' )
			{
				this.className = '';
				this.value = '';
			}
		} );

		$('tfoot input').blur( function (i) {
			if ( this.value == '' )
			{
				this.className = 'search_init';
				this.value = asInitVals[$('tfoot input').index(this)];
			}
		} );




		$('.filter input').keyup( function () {
			/* Filter on the column (the index) of this element */
			oTable.fnFilter( this.value, $('.filter input').index(this) );
		} );

		/*
		 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
		 * the footer
		 */
		$('.filter input').each( function (i) {
			asInitVals[i] = this.value;
		} );

		$('.filter input').focus( function () {
			if ( this.className == 'search_init' )
			{
				this.className = '';
				this.value = '';
			}
		} );

		$('.filter input').blur( function (i) {
			if ( this.value == '' )
			{
				this.className = 'search_init';
				this.value = asInitVals[$('.filter input').index(this)];
			}
		} );

		$('table.dataTable').click(function(e){

			if ($(e.target).is('.del')) {
				var _id = e.target.id;
				var answer = confirm("Are you sure you want to delete this item ?");
				if (answer){
					$.post('{{ URL::to($ajaxdel) }}',{'id':_id}, function(data) {
						if(data.status == 'OK'){
							//redraw table
							oTable.fnDraw();
							alert("Item id : " + _id + " deleted");
						}
					},'json');
				}else{
					alert("Deletion cancelled");
				}
		   	}

			if ($(e.target).is('.pop')) {
				var _id = e.target.id;
				var _rel = $(e.target).attr('rel');

				$.fancybox({
					type:'iframe',
					href: '{{ URL::base() }}' + '/' + _rel + '/' + _id,
					autosize: true
				});

		   	}	

			if ($(e.target).is('.fileview')) {
				var _id = e.target.id;

				console.log(e);

				$.fancybox({
					type:'iframe',
					href: '{{ URL::base().'/storage/' }}' + _id + '/' + e.target.innerHTML,
					autosize: true
				});

		   	}		   			   	

			if ($(e.target).is('.metaview')) {
				var doc_id = e.target.id;

				$.fancybox({
					type:'iframe',
					href: '{{ URL::to("document/view/") }}' + doc_id,
					autosize: true
				});
			}

			if ($(e.target).is('.approvalview')) {
				var doc_id = e.target.id;

				$.fancybox({
					type:'iframe',
					width:'1000',
					href: '{{ URL::to("document/approve/") }}' + doc_id,
					autosize: false
				});
			}

		});

    });
  </script>

@endsection