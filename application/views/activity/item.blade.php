<?
$doc_photo = getavatar($doc['creator_id'],$doc['creator_name'],'ten');

if($doc['event'] == 'document.create'){
	$main_photo = getavatar($doc['creator_id'],$doc['creator_name'],'ten');
	$body = $doc['creator_name'].' have updated '.$doc['doc_title'];
}
elseif($doc['event'] == 'document.share'){
	$main_photo = getavatar($doc['sharer_id'],$doc['sharer_name'],'ten');
	$body = $doc['sharer_name'].' have updated '.$doc['doc_title'];
}
elseif($doc['event'] == 'document.update'){
	$main_photo = getavatar($doc['updater_id'],$doc['updater_name'],'ten');	
	$body = $doc['updater_name'].' have updated '.$doc['doc_title'];
}
elseif($doc['event'] == 'request.approval'){
	$main_photo = getavatar($doc['requester_id'],$doc['requester_name'],'ten');
	if($doc['approvalby'] == Auth::user()->email){
		$body = $doc['requester_name'].' have requested document approval from you, please review : <span class="metaview" id="'.$doc['_id'].'">'.$doc['doc_title'].'</span>';
	}else{
		$body = 'You have requested document approval to '.$doc['approvalby'].' for document : <span class="metaview" id="'.$doc['_id'].'">'.$doc['doc_title'].'</span>';
	}
}

/*
if($doc['event'] == 'document.create')

	<p>
		You have created new document,<br />
		Review Document : {{$doc['doc_id']}}
	</p>

elseif($doc['event'] == 'document.share')

	<p>
		A document has been shared to you, <br />
		Review Document : {{$doc['doc_id']}}
	</p>

elseif($doc['event'] == 'document.update')

	<p>

		A document has been updated, <br />
		Review Document : {{$doc['doc_id']}}
	</p>

elseif($doc['event'] == 'document.delete')

	<p>
		A document has been deleted, <br />
		Document : {{$doc['doc_id']}}
	</p>

elseif($doc['event'] == 'project.create')

	<p>
		A project has been created, <br />
		Review Project : {{$doc['doc_id']}}
	</p>

elseif($doc['event'] == 'project.update'){

}

	<p>
		A project has been updated, <br />
		Review Project : {{$doc['doc_id']}}
	</p>

elseif($doc['event'] == 'project.delete')

	<p>
		A project has been deleted, <br />
		Project : {{$doc['doc_id']}}
	</p>
	
elseif($doc['event'] == 'request.approval')

	<p>
		Your approval is required for : <br />
		Document : {{$doc['doc_id']}}
	</p>

endif

*/
?>


<div class="row">
	<div class="two columns">{{ $main_photo }}</div>
	<div class="ten columns">
	  <p>
	  	<span class="timestamp">{{date('Y-m-d H:i:s',$doc['timestamp']->sec)}}</span> <strong>{{$doc['title']}}</strong><br />
	  	{{ $body }}<hr />
	  <div class="row">
	    <div class="two columns">{{ $doc_photo }}</div>
	    <div class="ten columns">
	    	<p>
				<span class="metaview" id="{{$doc['_id']}}">{{$doc['doc_title']}}</span>
	    	</p>
	    </div>
	  </div>
	  </p>
	  <ul class="inline-list">
	    <li><a href="">Reply</a></li>
	    <li><a href="">Share</a></li>
	  </ul>

	<!--
	  <h6>2 Comments</h6>
	  <div class="row">
	    <div class="two columns"><img src="http://placehold.it/50x50&text=[img]" /></div>
	    <div class="ten columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>
	  </div>
	  <div class="row">
	    <div class="two columns"><img src="http://placehold.it/50x50&text=[img]" /></div>
	    <div class="ten columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>
	  </div>

	-->
	</div>
</div>

