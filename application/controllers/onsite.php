<?php

class Onsite_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public $restful = true;

	public $crumb;


	public function __construct(){
		$this->crumb = new Breadcrumb();
		$this->crumb->add('onsite','Dashboard');

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}

	public function get_index()
	{

		$form = new Formly();

		$select_all = $form->checkbox('select_all','','',false,array('id'=>'select_all'));

		$action_selection = $form->select('action','',Config::get('kickstart.actionselection'));

		$btn_add_to_group = '<span class=" add_to_group" id="add_to_group">'.$action_selection.'</span>';


		$heads = array(
			'#',
			//$select_all,
			//'Reg. Number',
			'Reg. Date',
			'Email',
			'First Name',
			'Last Name',
			'Company',
			//'Reg. Type',
			//'Country',
			//'Conv. Status',
			//'Golf. Status',
			//''
		);

		$searchinput = array(
			false,
			//'Reg Number',
			'Reg. Date',
			'Email',
			'First Name',
			'Last Name',
			'Company',
			//false,
			//'Country',
			//false,
			//false,
			//false
		);


		$colclass = array('','span1','span3','span1','span3','span3','span1','span1','span1','','','','','','','','','');

		return View::make('dashboard.onsite')
			->with('title','Master Data')
			->with('newbutton','New Visitor')
			->with('disablesort','0,1')
			->with('addurl','attendee/add')
			->with('colclass',$colclass)
			->with('searchinput',$searchinput)
			->with('ajaxsource',URL::to('onsite'))
			->with('ajaxvisitorsource',URL::to('onsite/visitor'))

			->with('ajaxdel',URL::to('attendee/del'))
			->with('ajaxpay',URL::to('attendee/paystatus'))
			->with('ajaxpaygolf',URL::to('attendee/paystatusgolf'))
			->with('ajaxpaygolfconvention',URL::to('attendee/paystatusgolfconvention'))
			->with('ajaxresendmail',URL::to('attendee/resendmail'))
			->with('printsource',URL::to('attendee/printbadge'))
			->with('form',$form)
			->with('crumb',$this->crumb)
			->with('heads',$heads)
			->with('visitorheads',$heads)
			->nest('row','attendee.rowdetail');

	}

	public function post_index()
	{


		$fields = array('registrationnumber','createdDate','email','firstname','lastname','company','regtype','country','conventionPaymentStatus','golfPaymentStatus');

		$rel = array('like','like','like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both','both','both','both');

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 1;
		$q = array();

		$hilite = array();
		$hilite_replace = array();

		foreach($fields as $field){
			if(Input::get('sSearch_'.$idx))
			{

				$hilite_item = Input::get('sSearch_'.$idx);
				$hilite[] = $hilite_item;
				$hilite_replace[] = '<span class="hilite">'.$hilite_item.'</span>';

				if($rel[$idx] == 'like'){
					if($cond[$idx] == 'both'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'/i');
					}else if($cond[$idx] == 'before'){
						$q[$field] = new MongoRegex('/^'.Input::get('sSearch_'.$idx).'/i');
					}else if($cond[$idx] == 'after'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'$/i');
					}
				}else if($rel[$idx] == 'equ'){
					$q[$field] = Input::get('sSearch_'.$idx);
				}
			}
			$idx++;
		}

		//print_r($q)

		$attendee = new Attendee();

		/* first column is always sequence number, so must be omitted */
		$fidx = Input::get('iSortCol_0');
		if($fidx == 0){
			$fidx = $defsort;
			$sort_col = $fields[$fidx];
			$sort_dir = $defdir;
		}else{
			$fidx = ($fidx > 0)?$fidx - 1:$fidx;
			$sort_col = $fields[$fidx];
			$sort_dir = (Input::get('sSortDir_0') == 'asc')?1:-1;
		}

		$count_all = $attendee->count();

		if(count($q) > 0){
			$attendees = $attendee->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $attendee->count($q);
		}else{
			$attendees = $attendee->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $attendee->count();
		}

		$aadata = array();

		$form = new Formly();

		$messagelog = new Logmessage();

		$counter = 1 + $pagestart;
		foreach ($attendees as $doc) {

			$extra = $doc;

			$select = $form->checkbox('sel_'.$doc['_id'],'','',false,array('id'=>$doc['_id'],'class'=>'selector'));

			if(isset($doc['conventionPaymentStatus'])){
				if($doc['conventionPaymentStatus'] == 'unpaid'){
					$paymentStatus = '<span class="fontRed fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
				}elseif ($doc['conventionPaymentStatus'] == 'pending') {
					$paymentStatus = '<span class="fontOrange fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
				}elseif ($doc['conventionPaymentStatus'] == 'cancel') {
					$paymentStatus = '<span class="fontGray fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';

				}else{
					$paymentStatus = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
				}
			}else{
				$paymentStatus = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['paymentStatus'].'</span>';
			}

			if(isset($doc['golfPaymentStatus'])){
				if($doc['golfPaymentStatus'] == 'unpaid' && $doc['golf'] == 'Yes'){
					$paymentStatusGolf = '<span class="fontRed fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}elseif ($doc['golfPaymentStatus'] == 'pending') {
					$paymentStatusGolf = '<span class="fontOrange fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}elseif ($doc['golfPaymentStatus'] == 'cancel') {
					$paymentStatusGolf = '<span class="fontGray fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}elseif ($doc['golf'] == 'No') {
					$paymentStatusGolf = '<span class="fontGray fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}else{
					$paymentStatusGolf = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}
			}else{
				$paymentStatusGolf = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['paymentStatus'].'</span>';
			}

			if(isset($doc['golf'])){
				if($doc['golf'] == 'Yes'){
					$rowGolfAction = '<a class="icon-"  ><i>&#xe146;</i><span class="paygolf" id="'.$doc['_id'].'" >Golf Status</span>';
				}else{
					$rowGolfAction = '';
				}
			}else{
				$rowGolfAction = '';
			}

			if(isset($doc['golfPaymentStatus']) && isset($doc['conventionPaymentStatus'])){

				if(($doc['golfPaymentStatus'] == 'pending' && $doc['conventionPaymentStatus'] == 'pending') || ($doc['golfPaymentStatus'] == 'unpaid' && $doc['conventionPaymentStatus'] == 'unpaid')){
					$rowBoothAction = '<a class="icon-"  ><i>&#xe1e9;</i><span class="paygolfconvention" id="'.$doc['_id'].'" >Conv & Golf</span>';
				}else{
					$rowBoothAction = '';
				}
			}else{
				$rowGolfAction = '';
			}

			//find message log

			//$rowResendMessage = '';
			//$messagelogs = $messagelog->find(array('user'=>$doc['_id']),array(),array(),array());
			//if(count($messagelogs)>0){

				$rowResendMessage = '<a class="icon-"  ><i>&#xe165;</i><span class="resendmail" id="'.$doc['_id'].'" >Resend Email</span>';
			//}

			$aadata[] = array(
				$counter,
				//$select,
				//(isset($doc['registrationnumber']))?$doc['registrationnumber']:'',
				date('Y-m-d', $doc['createdDate']->sec),
				$doc['email'],
				'<span class="expander" id="'.$doc['_id'].'">'.$doc['firstname'].'</span>',
				$doc['lastname'],
				$doc['company'],
				$doc['regtype'],
				//$doc['country'],
				//$paymentStatus,
				//$paymentStatusGolf,
				//$rowBoothAction.

				//'<a class="icon-"  ><i>&#xe1b0;</i><span class="pay" id="'.$doc['_id'].'" >Convention Status</span>'.
				//$rowGolfAction.

				//'<a class="icon-"  ><i>&#xe14c;</i><span class="pbadge" id="'.$doc['_id'].'" >Print Badge</span>'.
				//'<a class="icon-"  href="'.URL::to('attendee/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update Profile</span>'.
				//$rowResendMessage.
				//'<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$doc['_id'].'" >Delete</span>',

				'extra'=>$extra
			);
			$counter++;
		}


		$result = array(
			'sEcho'=> Input::get('sEcho'),
			'iTotalRecords'=>$count_all,
			'iTotalDisplayRecords'=> $count_display_all,
			'aaData'=>$aadata,
			'qrs'=>$q
		);

		return Response::json($result);
	}


	public function post_visitor()
	{


		$fields = array('registrationnumber','createdDate','email','firstname','lastname','company','regtype','country','conventionPaymentStatus','golfPaymentStatus');

		$rel = array('like','like','like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both','both','both','both');

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 1;
		$q = array();

		$hilite = array();
		$hilite_replace = array();

		foreach($fields as $field){
			if(Input::get('sSearch_'.$idx))
			{

				$hilite_item = Input::get('sSearch_'.$idx);
				$hilite[] = $hilite_item;
				$hilite_replace[] = '<span class="hilite">'.$hilite_item.'</span>';

				if($rel[$idx] == 'like'){
					if($cond[$idx] == 'both'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'/i');
					}else if($cond[$idx] == 'before'){
						$q[$field] = new MongoRegex('/^'.Input::get('sSearch_'.$idx).'/i');
					}else if($cond[$idx] == 'after'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'$/i');
					}
				}else if($rel[$idx] == 'equ'){
					$q[$field] = Input::get('sSearch_'.$idx);
				}
			}
			$idx++;
		}

		//print_r($q)

		$attendee = new Visitor();

		/* first column is always sequence number, so must be omitted */
		$fidx = Input::get('iSortCol_0');
		if($fidx == 0){
			$fidx = $defsort;
			$sort_col = $fields[$fidx];
			$sort_dir = $defdir;
		}else{
			$fidx = ($fidx > 0)?$fidx - 1:$fidx;
			$sort_col = $fields[$fidx];
			$sort_dir = (Input::get('sSortDir_0') == 'asc')?1:-1;
		}

		$count_all = $attendee->count();

		if(count($q) > 0){
			$attendees = $attendee->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $attendee->count($q);
		}else{
			$attendees = $attendee->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $attendee->count();
		}

		$aadata = array();

		$form = new Formly();

		$messagelog = new Logmessage();

		$counter = 1 + $pagestart;
		foreach ($attendees as $doc) {

			$extra = $doc;

			$select = $form->checkbox('sel_'.$doc['_id'],'','',false,array('id'=>$doc['_id'],'class'=>'selector'));

			if(isset($doc['conventionPaymentStatus'])){
				if($doc['conventionPaymentStatus'] == 'unpaid'){
					$paymentStatus = '<span class="fontRed fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
				}elseif ($doc['conventionPaymentStatus'] == 'pending') {
					$paymentStatus = '<span class="fontOrange fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
				}elseif ($doc['conventionPaymentStatus'] == 'cancel') {
					$paymentStatus = '<span class="fontGray fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';

				}else{
					$paymentStatus = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
				}
			}else{
				$paymentStatus = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['paymentStatus'].'</span>';
			}

			if(isset($doc['golfPaymentStatus'])){
				if($doc['golfPaymentStatus'] == 'unpaid' && $doc['golf'] == 'Yes'){
					$paymentStatusGolf = '<span class="fontRed fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}elseif ($doc['golfPaymentStatus'] == 'pending') {
					$paymentStatusGolf = '<span class="fontOrange fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}elseif ($doc['golfPaymentStatus'] == 'cancel') {
					$paymentStatusGolf = '<span class="fontGray fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}elseif ($doc['golf'] == 'No') {
					$paymentStatusGolf = '<span class="fontGray fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}else{
					$paymentStatusGolf = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}
			}else{
				$paymentStatusGolf = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['paymentStatus'].'</span>';
			}

			if(isset($doc['golf'])){
				if($doc['golf'] == 'Yes'){
					$rowGolfAction = '<a class="icon-"  ><i>&#xe146;</i><span class="paygolf" id="'.$doc['_id'].'" >Golf Status</span>';
				}else{
					$rowGolfAction = '';
				}
			}else{
				$rowGolfAction = '';
			}

			if(isset($doc['golfPaymentStatus']) && isset($doc['conventionPaymentStatus'])){

				if(($doc['golfPaymentStatus'] == 'pending' && $doc['conventionPaymentStatus'] == 'pending') || ($doc['golfPaymentStatus'] == 'unpaid' && $doc['conventionPaymentStatus'] == 'unpaid')){
					$rowBoothAction = '<a class="icon-"  ><i>&#xe1e9;</i><span class="paygolfconvention" id="'.$doc['_id'].'" >Conv & Golf</span>';
				}else{
					$rowBoothAction = '';
				}
			}else{
				$rowGolfAction = '';
			}

			//find message log

			//$rowResendMessage = '';
			//$messagelogs = $messagelog->find(array('user'=>$doc['_id']),array(),array(),array());
			//if(count($messagelogs)>0){

				$rowResendMessage = '<a class="icon-"  ><i>&#xe165;</i><span class="resendmail" id="'.$doc['_id'].'" >Resend Email</span>';
			//}

			$aadata[] = array(
				$counter,
				//$select,
				//(isset($doc['registrationnumber']))?$doc['registrationnumber']:'',
				date('Y-m-d', $doc['createdDate']->sec),
				$doc['email'],
				'<span class="expander" id="'.$doc['_id'].'">'.$doc['firstname'].'</span>',
				$doc['lastname'],
				$doc['company'],
				$doc['role'],
				//$doc['country'],
				//$paymentStatus,
				//$paymentStatusGolf,
				//$rowBoothAction.

				//'<a class="icon-"  ><i>&#xe1b0;</i><span class="pay" id="'.$doc['_id'].'" >Convention Status</span>'.
				//$rowGolfAction.

				//'<a class="icon-"  ><i>&#xe14c;</i><span class="pbadge" id="'.$doc['_id'].'" >Print Badge</span>'.
				//'<a class="icon-"  href="'.URL::to('attendee/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update Profile</span>'.
				//$rowResendMessage.
				//'<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$doc['_id'].'" >Delete</span>',

				'extra'=>$extra
			);
			$counter++;
		}


		$result = array(
			'sEcho'=> Input::get('sEcho'),
			'iTotalRecords'=>$count_all,
			'iTotalDisplayRecords'=> $count_display_all,
			'aaData'=>$aadata,
			'qrs'=>$q
		);

		return Response::json($result);
	}


	public function post_del(){
		$id = Input::get('id');

		$user = new Document();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$id = new MongoId($id);


			if($user->delete(array('_id'=>$id))){
				Event::fire('document.delete',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('document.delete',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}


	public function get_add($type = null){

		if(is_null($type)){
			$this->crumb->add('document/add','New Document');
		}else{
			$this->crumb = new Breadcrumb();
			$this->crumb->add('document/type/'.$type,'Document');

			$this->crumb->add('document/type/'.$type,depttitle($type));
			$this->crumb->add('document/add','New Document');
		}


		$form = new Formly();
		return View::make('document.new')
					->with('form',$form)
					->with('type',$type)
					->with('crumb',$this->crumb)
					->with('title','New Document');

	}

	public function post_add($type = null){

		//print_r(Session::get('permission'));

		if(is_null($type)){
			$back = 'document';
		}else{
			$back = 'document/type/'.$type;
		}

	    $rules = array(
	        'title'  => 'required|max:50'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('document/add/'.$type)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
	    	//print_r($data);

			//pre save transform
			unset($data['csrf_token']);

			$data['effectiveDate'] = new MongoDate(strtotime($data['effectiveDate']." 00:00:00"));
			$data['expiryDate'] = new MongoDate(strtotime($data['expiryDate']." 00:00:00"));

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();
			$data['creatorName'] = Auth::user()->fullname;
			$data['creatorId'] = Auth::user()->id;


			$sharelist = explode(',', $data['docShare']);
			if(is_array($sharelist)){
				$usr = new User();
				$shd = array();
				foreach($sharelist as $sh){
					$shd[] = array('email'=>$sh);
				}
				$shared_ids = $usr->find(array('$or'=>$shd),array('id'));

				$data['sharedEmails'] = $sharelist ;
				$data['sharedIds'] = array_values($shared_ids) ;
			}

			$approvallist = explode(',', $data['docApprovalRequest']);
			if(is_array($approvallist)){
				$usr = new User();
				$shd = array();
				foreach($approvallist as $sh){
					$appval[] = array('email'=>$sh);
				}
				$approval_ids = $usr->find(array('$or'=>$appval),array('id','fullname'));

				$data['approvalRequestEmails'] = $approvallist ;
				$data['approvalRequestIds'] = array_values($approval_ids) ;
			}
			
			$docupload = Input::file('docupload');

			$docupload['uploadTime'] = new MongoDate();

			$data['docFilename'] = $docupload['name'];

			$data['docFiledata'] = $docupload;

			$data['docFileList'][] = $docupload;

			$data['tags'] = explode(',',$data['docTag']);

			$document = new Document();

			$newobj = $document->insert($data);


			if($newobj){


				if($docupload['name'] != ''){

					$newid = $newobj['_id']->__toString();

					$newdir = realpath(Config::get('kickstart.storage')).'/'.$newid;

					Input::upload('docupload',$newdir,$docupload['name']);
					
				}

				if(count($data['tags']) > 0){
					$tag = new Tag();
					foreach($data['tags'] as $t){
						$tag->update(array('tag'=>$t),array('$inc'=>array('count'=>1)),array('upsert'=>true));
					}
				}

				$sharedto = explode(',',$data['docShare']);

				if(count($sharedto) > 0  && $data['docShare'] != ''){
					foreach($sharedto as $to){
						Event::fire('document.share',array('id'=>$newobj['_id'],'sharer_id'=>Auth::user()->id,'shareto'=>$to));
					}
				}

				$approvalby = explode(',',$data['docApprovalRequest']);

				if(count($approvalby) > 0 && $data['docApprovalRequest'] != ''){
					foreach($approvalby as $to){
						Event::fire('request.approval',array('id'=>$newobj['_id'],'approvalby'=>$to));
					}
				}

				Event::fire('document.create',array('id'=>$newobj['_id'],'result'=>'OK','department'=>Auth::user()->department,'creator'=>Auth::user()->id));

		    	return Redirect::to($back)->with('notify_success','Document saved successfully');
			}else{
				Event::fire('document.create',array('id'=>$id,'result'=>'FAILED'));
		    	return Redirect::to($back)->with('notify_success','Document saving failed');
			}

	    }

		
	}

	public function get_edit($id = null,$type = null){

		if(is_null($type)){
			$this->crumb->add('document/add','Edit',false);
		}else{
			$this->crumb = new Breadcrumb();
			$this->crumb->add('document/type/'.$type,'Document');

			$this->crumb->add('document/type/'.$type,depttitle($type),false);
			$this->crumb->add('document/edit/'.$id,'Edit',false);
		}


		$doc = new Document();

		$id = (is_null($id))?Auth::user()->id:$id;

		$id = new MongoId($id);

		$doc_data = $doc->get(array('_id'=>$id));

		$doc_data['oldTag'] = $doc_data['docTag'];

		$doc_data['effectiveDate'] = date('Y-m-d', $doc_data['effectiveDate']->sec);
		$doc_data['expiryDate'] = date('Y-m-d', $doc_data['expiryDate']->sec);


		if(is_null($type)){
			$this->crumb->add('document/edit/'.$id,$doc_data['title']);
		}else{
			$this->crumb->add('document/edit/'.$id.'/'.$type,$doc_data['title']);
		}

		$form = Formly::make($doc_data);

		return View::make('document.edit')
					->with('doc',$doc_data)
					->with('form',$form)
					->with('type',$type)
					->with('crumb',$this->crumb)
					->with('title','Edit Document');

	}


	public function post_edit($id,$type = null){

		//print_r(Session::get('permission'));

		if(is_null($type)){
			$back = 'document';
		}else{
			$back = 'document/type/'.$type;
		}

	    $rules = array(
	        'title'  => 'required|max:50'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('document/edit/'.$id.'/'.$type)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			$id = new MongoId($data['id']);

			$data['effectiveDate'] = new MongoDate(strtotime($data['effectiveDate']." 00:00:00"));
			$data['expiryDate'] = new MongoDate(strtotime($data['expiryDate']." 00:00:00"));
			$data['lastUpdate'] = new MongoDate();

			unset($data['csrf_token']);

			$docId = $data['id'];
			unset($data['id']);

			$sharelist = explode(',', $data['docShare']);
			if(is_array($sharelist)){
				$usr = new User();
				$shd = array();
				foreach($sharelist as $sh){
					$shd[] = array('email'=>$sh);
				}
				$shared_ids = $usr->find(array('$or'=>$shd),array('id'));

				$data['sharedEmails'] = $sharelist ;
				$data['sharedIds'] = array_values($shared_ids) ;
			}

			$approvallist = explode(',', $data['docApprovalRequest']);
			if(is_array($approvallist)){
				$usr = new User();
				$shd = array();
				foreach($approvallist as $sh){
					$appval[] = array('email'=>$sh);
				}
				$approval_ids = $usr->find(array('$or'=>$appval),array('id','fullname'));

				$data['approvalRequestEmails'] = $approvallist ;
				$data['approvalRequestIds'] = array_values($approval_ids) ;
			}


			$data['tags'] = explode(',',$data['docTag']);

			$doc = new Document();

			//print_r($data);
			$oldtags = explode(',',$data['oldTag']);

			if(count($data['tags']) > 0){
				$tag = new Tag();
				foreach($data['tags'] as $t){
					if(in_array($t, $oldtags)){
						$add = 0;
					}else{
						$add = 1;
					}
					$tag->update(array('tag'=>$t),array('$inc'=>array('count'=>$add)),array('upsert'=>true));
				}
			}

			unset($data['oldTag']);

			// upload new file , additive

			$docupload = Input::file('docupload');

			$withfile = false;

			if($docupload['name'] != ''){

				$docupload['uploadTime'] = new MongoDate();

				$dirname = $docId;

				$dirname = realpath(Config::get('kickstart.storage')).'/'.$dirname;

				$uploadresult = Input::upload('docupload',$dirname,$docupload['name']);

				if($uploadresult){

					$data['docFilename'] = $docupload['name'];

					$data['docFiledata'] = $docupload;

					$withfile = true;

				}

			}

			if($withfile == true){
				$updatequery = array('$set'=>$data,'$push'=>array('docFileList'=>$docupload));
			}else{
				$updatequery = array('$set'=>$data);
			}

			//print_r($data);

			if($doc->update(array('_id'=>$id),$updatequery)){

				Event::fire('document.update',array('id'=>$id,'result'=>'OK'));

				$sharedto = explode(',',$data['docShare']);

				if(count($sharedto) > 0  && $data['docShare'] != ''){
					foreach($sharedto as $to){
						Event::fire('document.share',array('id'=>$id,'sharer_id'=>Auth::user()->id,'shareto'=>$to));
					}
				}

				$approvalby = explode(',',$data['docApprovalRequest']);

				if(count($approvalby) > 0 && $data['docApprovalRequest'] != ''){
					foreach($approvalby as $to){
						Event::fire('request.approval',array('id'=>$id,'approvalby'=>$to));
					}
				}				

		    	return Redirect::to($back)->with('notify_success','Document saved successfully');
			}else{

				Event::fire('document.update',array('id'=>$id,'result'=>'FAILED'));

		    	return Redirect::to($back)->with('notify_success','Document saving failed');
			}

	    }

		
	}


	public function get_type($type = null)
	{
		$this->crumb = new Breadcrumb();
		$this->crumb->add('document/type/'.$type,'Document');
		$this->crumb->add('document/type/'.$type,depttitle($type));

		$heads = array('#','Title','Created','Last Update','Creator','Access','Attachment','Tags','Action');
		$searchinput = array(false,'title','created','last update','creator','access','filename','tags',false);

		$dept = Config::get('kickstart.department');

		$title = $dept[$type];

		$doc = new Document();

		//check is shared
		$sharecriteria = new MongoRegex('/'.Auth::user()->email.'/i');
		$shared = $doc->count(array('docDepartment'=>$type,'docShare'=>$sharecriteria));

		//check if creator
		$created = $doc->count(array('docDepartment'=>$type,'creatorId'=>Auth::user()->id));

		$permissions = Auth::user()->permissions;

		$can_open = false;

		if(	Auth::user()->role == 'root' || 
			Auth::user()->role == 'super' || 
			Auth::user()->department == $title || 
			$permissions->{$type}->read == true ||
			$shared > 0 ||
			$created > 0
		){
			$can_open = true;
		}

		if( $can_open == true ){


			if($permissions->{$type}->create == 1 || Auth::user()->department == $type ){
				$addurl = 'document/add/'.$type;
			}else{
				$addurl = '';
			}

			return View::make('tables.simple')
				->with('title',$title)
				->with('newbutton','New Document')
				->with('disablesort','0,5,6')
				->with('addurl',$addurl)
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('document/type/'.$type))
				->with('ajaxdel',URL::to('document/del'))
				->with('crumb',$this->crumb)
				->with('heads',$heads);			
		}else{
			return View::make('document.restricted')
				->with('crumb',$this->crumb)
				->with('title',$title);
		}

	}

	public function post_type($type = null)
	{

		$fields = array('title','createdDate','lastUpdate','creatorName','docFilename','docTag');

		$rel = array('like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both');

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 0;
		$q = array();

		$hilite = array();
		$hilite_replace = array();

		foreach($fields as $field){
			if(Input::get('sSearch_'.$idx))
			{

				$hilite_item = Input::get('sSearch_'.$idx);
				$hilite[] = $hilite_item;
				$hilite_replace[] = '<span class="hilite">'.$hilite_item.'</span>';

				if($rel[$idx] == 'like'){
					if($cond[$idx] == 'both'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'/i');
					}else if($cond[$idx] == 'before'){
						$q[$field] = new MongoRegex('/^'.Input::get('sSearch_'.$idx).'/i');						
					}else if($cond[$idx] == 'after'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'$/i');						
					}
				}else if($rel[$idx] == 'equ'){
					$q[$field] = Input::get('sSearch_'.$idx);
				}
			}
			$idx++;
		}

		//print_r($q)
		if(!is_null($type)){
			$q['docDepartment'] = $type;
		}

		$sharecriteria = new MongoRegex('/'.Auth::user()->email.'/i');
		
		if(Auth::user()->department == $type){
			$q['$or'] = array(
				array('access'=>'general'),
				array('docShare'=>$sharecriteria)
			);
		}else{
			$q['docShare'] = $sharecriteria;
		}

		$permissions = Auth::user()->permissions;

		$document = new Document();

		/* first column is always sequence number, so must be omitted */
		$fidx = Input::get('iSortCol_0');
		if($fidx == 0){
			$fidx = $defsort;			
			$sort_col = $fields[$fidx];
			$sort_dir = $defdir;
		}else{
			$fidx = ($fidx > 0)?$fidx - 1:$fidx;
			$sort_col = $fields[$fidx];
			$sort_dir = (Input::get('sSortDir_0') == 'asc')?1:-1;
		}

		$count_all = $document->count();

		if(count($q) > 0){
			$documents = $document->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count($q);
		}else{
			$documents = $document->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count();
		}




		$aadata = array();

		$counter = 1 + $pagestart;
		foreach ($documents as $doc) {


			if(isset($doc['tags'])){
				$tags = array();

				foreach($doc['tags'] as $t){
					$tags[] = '<span class="tagitem">'.$t.'</span>';
				}

				$tags = implode('',$tags);

			}else{
				$tags = '';
			}

			$doc['title'] = str_ireplace($hilite, $hilite_replace, $doc['title']);
			$doc['creatorName'] = str_ireplace($hilite, $hilite_replace, $doc['creatorName']);


			if($doc['creatorId'] == Auth::user()->id || $doc['docDepartment'] == Auth::user()->department){
				$edit = '<a href="'.URL::to('document/edit/'.$doc['_id'].'/'.$type).'">'.
						'<i class="foundicon-edit action"></i></a>&nbsp;';
				$del = '<i class="foundicon-trash action del" id="'.$doc['_id'].'"></i>';
			}else{
				if($permissions->{$type}->edit == 1){
					$edit = '<a href="'.URL::to('document/edit/'.$doc['_id'].'/'.$type).'">'.
							'<i class="foundicon-edit action"></i></a>&nbsp;';
				}else{
					$edit = '';
				}

				if($permissions->{$type}->delete == 1){
					$del = '<i class="foundicon-trash action del" id="'.$doc['_id'].'"></i>';
				}else{
					$del = '';
				}
			}

			$aadata[] = array(
				$counter,
				'<span class="metaview" id="'.$doc['_id'].'">'.$doc['title'].'</span>',
				date('Y-m-d H:i:s', $doc['createdDate']->sec),
				isset($doc['lastUpdate'])?date('Y-m-d H:i:s', $doc['lastUpdate']->sec):'',
				$doc['creatorName'],
				isset($doc['access'])?ucfirst($doc['access']):'',
				isset($doc['docFilename'])?'<span class="fileview" id="'.$doc['_id'].'">'.$doc['docFilename'].'</span>':'',
				$tags,
				$edit.$del
				/*
				'<a href="'.URL::to('document/edit/'.$doc['_id'].'/'.$type).'">'.
				'<i class="foundicon-edit action"></i></a>&nbsp;'.
				'<i class="foundicon-trash action del" id="'.$doc['_id'].'"></i>'
				*/
			);
			$counter++;
		}

		
		$result = array(
			'sEcho'=> Input::get('sEcho'),
			'iTotalRecords'=>$count_all,
			'iTotalDisplayRecords'=> $count_display_all,
			'aaData'=>$aadata,
			'qrs'=>$q
		);

		return Response::json($result);
	}


	public function __get_type($type = null)
	{
		$menutitle = array(
			'opportunity'=>'Opportunity',
			'tender'=>'Tender',
			'commbid'=>'Commercial Bid',
			'proposal'=>'Tech Proposal',
			'techbid'=>'Tech Bid',
			'contract'=>'Contracts',
			'legal'=>'Legal Docs',
			'qc'=>'QA / QC',
			'warehouse'=>'Warehouse'
			);

		$heads = array('#','Title','Created','Creator','Owner','Tags','Action');
		$fields = array('seq','title','created','creator','owner','tags','action');
		$searchinput = array(false,'title','created','creator','owner','tags',false);

		return View::make('tables.simple')
			->with('title',(is_null($type))?'Document - All':'Document - '.$menutitle[$type])
			->with('newbutton','New Document')
			->with('disablesort','0,5,6')
			->with('addurl','document/add')
			->with('searchinput',$searchinput)
			->with('ajaxsource',URL::to('document/type/'.$type))
			->with('ajaxdel',URL::to('document/del'))
			->with('heads',$heads);
	}

	public function __post_type($type = null)
	{
		$fields = array('title','createdDate','creatorName','creatorName','tags');

		$rel = array('like','like','like','like','equ');

		$cond = array('both','both','both','both','equ');

		$idx = 0;
		$q = array();
		foreach($fields as $field){
			if(Input::get('sSearch_'.$idx))
			{
				if($rel[$idx] == 'like'){
					if($cond[$idx] == 'both'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'/');
					}else if($cond[$idx] == 'before'){
						$q[$field] = new MongoRegex('/^'.Input::get('sSearch_'.$idx).'/');						
					}else if($cond[$idx] == 'after'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'$/');						
					}
				}else if($rel[$idx] == 'equ'){
					$q[$field] = Input::get('sSearch_'.$idx);
				}
			}
			$idx++;
		}

		//print_r($q)

		$document = new Document();

		/* first column is always sequence number, so must be omitted */
		$fidx = Input::get('iSortCol_0');
		$fidx = ($fidx > 0)?$fidx - 1:$fidx;
		$sort_col = $fields[$fidx];
		$sort_dir = (Input::get('sSortDir_0') == 'asc')?1:-1;

		$count_all = $document->count();

		if(count($q) > 0){
			$documents = $document->find($q,array(),array($sort_col=>$sort_dir));
			$count_display_all = $document->count($q);
		}else{
			$documents = $document->find(array(),array(),array($sort_col=>$sort_dir));
			$count_display_all = $document->count();
		}




		$aadata = array();

		$counter = 1;
		foreach ($documents as $doc) {
			$aadata[] = array(
				$counter,
				$doc['title'],
				date('Y-m-d h:i:s',$doc['createdDate']),
				$doc['creatorName'],
				$doc['creatorName'],
				implode(',',$doc['tag']),
				'<i class="foundicon-edit action"></i>&nbsp;<i class="foundicon-trash action"></i>'
			);
			$counter++;
		}

		
		$result = array(
			'sEcho'=> Input::get('sEcho'),
			'iTotalRecords'=>$count_all,
			'iTotalDisplayRecords'=> $count_display_all,
			'aaData'=>$aadata,
			'qrs'=>$q
		);

		print json_encode($result);
	}


	public function get_view($id){
		$id = new MongoId($id);

		$document = new Document();

		$doc = $document->get(array('_id'=>$id));

		return View::make('pop.docview')->with('profile',$doc);
	}

	public function get_fileview($id){
		$_id = new MongoId($id);

		$document = new Document();

		$doc = $document->get(array('_id'=>$_id));

		//$file = URL::to(Config::get('kickstart.storage').$id.'/'.$doc['docFilename']);

		$file = URL::base().'/storage/'.$id.'/'.$doc['docFilename'];

		return View::make('pop.fileview')->with('doc',$doc)->with('href',$file);
	}

	public function get_approve($id){
		$id = new MongoId($id);

		$document = new Document();

		$doc = $document->get(array('_id'=>$id));

		$form = new Formly();

		$file = URL::base().'/storage/'.$id.'/'.$doc['docFilename'];
		
		return View::make('pop.approval')->with('doc',$doc)->with('form',$form)->with('href',$file);
	}	

}