<?php

class Attendee_Controller extends Base_Controller {

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
		$this->crumb->add('attendee','Attendees');

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}

	public function get_index()
	{
		//$this->crumb->add('attendee','Master Data');

		//print_r(Auth::user());

		$form = new Formly();

		$select_all = $form->checkbox('select_all','','',false,array('id'=>'select_all'));

		$btn_add_to_group = '<span class=" add_to_group" id="add_to_group">Add selected to group</span>';

/*<<<<<<< HEAD*/

		$heads = array('#',$select_all,'Reg. Number','Registered Date','Email','First Name','Last Name','Company','Reg. Type','Country','Conv. Status','Golf. Status',$btn_add_to_group);





		$searchinput = array(false,false,'Reg Number','Reg. Date','Email','First Name','Last Name','Company',false,'Country',false,false,false);


		//$colclass = array('','span1','span1','span1','span1','span1','span1','span1','','','','','');
		$colclass = array('','span1','span3','span1','span3','span3','span1','span1','span1','','','','','','','','','');

		//$searchinput = false; // no searchinput form on footer

		if(Auth::user()->role == 'root' || Auth::user()->role == 'super'){
			return View::make('tables.simple')
				->with('title','Master Data')
				->with('newbutton','New Visitor')
				->with('disablesort','0,1,9,12')
				->with('addurl','attendee/add')
				->with('colclass',$colclass)
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('attendee'))
				->with('ajaxdel',URL::to('attendee/del'))
				->with('ajaxpay',URL::to('attendee/paystatus'))
				->with('ajaxpaygolf',URL::to('attendee/paystatusgolf'))
				->with('printsource',URL::to('attendee/printbadge'))
				->with('crumb',$this->crumb)
				->with('heads',$heads)
				->nest('row','attendee.rowdetail');
		}else{
			return View::make('attendee.restricted')
							->with('title',$title);			
		}
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

		$counter = 1 + $pagestart;
		foreach ($attendees as $doc) {

			$extra = $doc;

			$select = $form->checkbox('sel_'.$doc['_id'],'','',false,array('id'=>$doc['_id'],'class'=>'selector'));

/*<<<<<<< HEAD*/
			if($doc['conventionPaymentStatus'] == 'unpaid'){
				$paymentStatus = '<span class="fontRed fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
			}elseif ($doc['conventionPaymentStatus'] == 'pending') {
				$paymentStatus = '<span class="fontOrange fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
			}elseif ($doc['conventionPaymentStatus'] == 'cancel') {
				$paymentStatus = '<span class="fontGray fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
			
			}else{
				$paymentStatus = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
			}

			if($doc['golfPaymentStatus'] == 'unpaid'){
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

			if($doc['golf'] == 'Yes'){
				$rowGolfAction = '<a class="icon-"  ><i>&#xe146;</i><span class="paygolf" id="'.$doc['_id'].'" >Golf Status</span>';
			}else{
				$rowGolfAction = '';

			}

/*=======
			if(isset($doc['paymentStatus'])){
				$status = ($doc['paymentStatus'] == 'unpaid')?'<span class="fontRed fontBold">UNPAID</span>':'<span class="fontGreen fontBold">PAID</span>';
			}else{
				$status = '<span class="fontRed fontBold">-</span>';
			}

>>>>>>> b59a7166cd34d09f3b78b47914a6e072c67392fb*/
			$aadata[] = array(
				$counter,
				$select,
				(isset($doc['registrationnumber']))?$doc['registrationnumber']:'',
				date('Y-m-d', $doc['createdDate']->sec),
				$doc['email'],
				'<span class="expander" id="'.$doc['_id'].'">'.$doc['firstname'].'</span>',
				$doc['lastname'],
				$doc['company'],
/*<<<<<<< HEAD*/
				$doc['regtype'],
				$doc['country'],
				//$doc['mobile'],
				$paymentStatus,
				$paymentStatusGolf,
				//'<span class="fontRed fontBold">UNPAID</span>',
				//$doc['companyphone'],
				//$doc['companyfax'],
				//date('Y-m-d H:i:s', $doc['createdDate']->sec),
				//isset($doc['lastUpdate'])?date('Y-m-d H:i:s', $doc['lastUpdate']->sec):'',
				//date('Y-m-d', $doc['createdDate']->sec),
				//isset($doc['lastUpdate'])?date('Y-m-d', $doc['lastUpdate']->sec):'',
				'<a class="icon-"  ><i>&#xe1b0;</i><span class="pay" id="'.$doc['_id'].'" >Convention Status</span>'.
				$rowGolfAction.
				'<a class="icon-"  ><i>&#xe14c;</i><span class="pbadge" id="'.$doc['_id'].'" >Print Badge</span>'.
				'<a class="icon-"  href="'.URL::to('attendee/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update Profile</span>'.
				'<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$doc['_id'].'" >Delete</span>',
/*=======
				$doc['position'],
				$status,
				$doc['mobile'],
				//$doc['companyphone'],
				//$doc['companyfax'],
				//date('Y-m-d H:i:s', $doc['createdDate']->sec),
				date('Y-m-d', $doc['createdDate']->sec),
				isset($doc['lastUpdate'])?date('Y-m-d', $doc['lastUpdate']->sec):'',
				'<a class="action icon-"  ><i>&#xe164;</i><span class="action pay" id="'.$doc['_id'].'" >Payment Status</span>'.
				'<a class="action icon-"  ><i>&#xe14c;</i><span class="action pbadge" id="'.$doc['_id'].'" >Print Badge</span>'.
				'<a class="action icon-"  href="'.URL::to('attendee/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update Profile</span>'.
				'<a class="action icon-"><i>&#xe001;</i><span class="action del" id="'.$doc['_id'].'" >Delete</span>',
>>>>>>> b59a7166cd34d09f3b78b47914a6e072c67392fb*/
				
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

		$user = new Attendee();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$id = new MongoId($id);


			if($user->delete(array('_id'=>$id))){
				Event::fire('attendee.delete',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('attendee.delete',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}

	public function post_paystatus(){
		$id = Input::get('id');
		$paystatus = Input::get('paystatus');

		$user = new Attendee();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);


			if($user->update(array('_id'=>$_id),array('$set'=>array('conventionPaymentStatus'=>$paystatus)))){
				Event::fire('paymentstatus.update',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
				//mail to registrant about payment updated
				//if only set to paid to send email
				if($paystatus == 'paid'){
					$data = $user->get(array('_id'=>$_id));

					$body = View::make('email.confirmpayment')->with('data',$data)->render();


					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->subject('CONFIRMATION OF REGISTRATION - Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
					    ->body( $body )
					    ->html(true)
					    ->send();
				}
			}else{
				Event::fire('paymentstatus.update',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}


	public function post_paystatusgolf(){
		$id = Input::get('id');
		$paystatus = Input::get('paystatusgolf');

		$user = new Attendee();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);


			if($user->update(array('_id'=>$_id),array('$set'=>array('golfPaymentStatus'=>$paystatus)))){
				Event::fire('paymentstatusgolf.update',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
				//mail to registrant about payment updated
				//if only set to paid to send email
				if($paystatus == 'paid'){
					$data = $user->get(array('_id'=>$_id));

					$body = View::make('email.confirmpaymentgolf')->with('data',$data)->render();


					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->subject('CONFIRMATION OF REGISTRATION (GOLF)- Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
					    ->body( $body )
					    ->html(true)
					    ->send();
				}
			}else{
				Event::fire('paymentstatusgolf.update',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}

	public function get_add($type = null){

		if(is_null($type)){
			$this->crumb->add('attendee/add','New Attendee');
		}else{
			$this->crumb = new Breadcrumb();
			$this->crumb->add('attendee/type/'.$type,'Attendee');

			$this->crumb->add('attendee/type/'.$type,depttitle($type));
			$this->crumb->add('attendee/add','New Attendee');
		}


		$form = new Formly();
		return View::make('attendee.new')
					->with('form',$form)
					->with('type',$type)
					->with('crumb',$this->crumb)
					->with('title','New Attendee');

	}


	public function post_add(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'firstname' => 'required',
	    	'lastname' => 'required',
	    	'position' => 'required',
	        'email' => 'required|email|unique:attendee',
	        
	        'company' => 'required',
	        'companyphone' => 'required',
	        'address' => 'required',
	        'city' => 'required',
	        'zip' => 'required',
	        'country' => 'required',
	        'companyInvoice' => 'required',
	        'companyphoneInvoice' => 'required',
	        'addressInvoice' => 'required',
	        'cityInvoice' => 'required',
	        'zipInvoice' => 'required',
	        'countryInvoice' => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('attendee/add')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();

			$passwordRandom = rand_string(8);

			$data['pass'] = Hash::make($passwordRandom);
	    	
			unset($data['csrf_token']);

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();

			$data['role'] = 'attendee';
			$data['paymentStatus'] = 'unpaid';
			$data['conventionPaymentStatus'] = 'unpaid';
			if($data['golf'] == 'Yes'){
				$data['golfPaymentStatus'] = 'unpaid';
			}else{
				$data['golfPaymentStatus'] = '-';
			}

			$reg_number[] = 'A';
			$reg_number[] = $data['regtype'];
			$reg_number[] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';

			$seq = new Sequence();

			$rseq = $seq->find_and_modify(array('_id'=>'attendee'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

			$reg_number[] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

			$data['registrationnumber'] = implode('-',$reg_number);


			//golf sequencer
			$data['golfSequence'] = 0;

			if($data['golf'] == 'Yes'){
				$gseq = $seq->find_and_modify(array('_id'=>'golf'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true,'upsert'=>true));
				$data['golfSequence'] = $gseq['seq'];
			}


			$user = new Attendee();

			if($obj = $user->insert($data)){

				print_r($obj);

				Event::fire('attendee.create',array($obj['_id'],$passwordRandom));
				
				/*
				$body = View::make('email.regsuccess')
					->with('data',$data)
					->with('passwordRandom',$passwordRandom)
					->with('fromadmin','yes')
					->render();

				Message::to($data['email'])
				    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
				    ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
				    ->body( $body )
				    ->html(true)
				    ->send();
				*/

		    	return Redirect::to('attendee')->with('notify_success',Config::get('site.register_success'));
			}else{
		    	return Redirect::to('attendee')->with('notify_success',Config::get('site.register_failed'));
			}

	    }

		
	}


	public function get_edit($id){

		$this->crumb->add('attendee/edit','Edit',false);

		$user = new Attendee();

		$_id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$_id));

		//print_r($user_profile);
		$user_profile['registrationnumber'] = (isset($user_profile['registrationnumber']))?$user_profile['registrationnumber']:'';

		$form = Formly::make($user_profile);

		$this->crumb->add('attendee/edit/'.$id,$user_profile['registrationnumber'],false);

		return View::make('attendee.edit')
					->with('user',$user_profile)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Edit Attendee');

	}


	public function post_edit(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'email'  => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('attendee/edit')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			$id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();

			unset($data['csrf_token']);
			unset($data['id']);

			$user = new Attendee();

			if(isset($data['registrationnumber']) && $data['registrationnumber'] != ''){
				$reg_number = explode('-',$data['registrationnumber']);			

				$reg_number[0] = 'A';
				$reg_number[1] = $data['regtype'];
				$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';


			}else if($data['registrationnumber'] == ''){
				$reg_number = array();
				$seq = new Sequence();
				$rseq = $seq->find_and_modify(array('_id'=>'attendee'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

				$reg_number[0] = 'A';
				$reg_number[1] = $data['regtype'];
				$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';

				$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);
			}

			//golf sequencer
			$data['golfSequence'] = 0;

			if($data['golf'] == 'Yes'){
				$gseq = $seq->find_and_modify(array('_id'=>'golf'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true,'upsert'=>true));
				$data['golfSequence'] = $gseq['seq'];
			}

			$data['registrationnumber'] = implode('-',$reg_number);
			
			if($user->update(array('_id'=>$id),array('$set'=>$data))){
		    	return Redirect::to('attendee')->with('notify_success','Attendee saved successfully');
			}else{
		    	return Redirect::to('attendee')->with('notify_success','Attendee saving failed');
			}
			
	    }

		
	}

	public function get_printbadge($id){
		$id = new MongoId($id);

		$attendee = new Attendee();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('print.attendeebadge')->with('profile',$doc);
	}

	public function get_view($id){
		$id = new MongoId($id);

		$attendee = new Document();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('pop.docview')->with('profile',$doc);
	}


	public function get_fileview($id){
		$_id = new MongoId($id);

		$attendee = new Document();

		$doc = $attendee->get(array('_id'=>$_id));

		//$file = URL::to(Config::get('kickstart.storage').$id.'/'.$doc['docFilename']);

		$file = URL::base().'/storage/'.$id.'/'.$doc['docFilename'];

		return View::make('pop.fileview')->with('doc',$doc)->with('href',$file);
	}

	public function get_approve($id){
		$id = new MongoId($id);

		$attendee = new Document();

		$doc = $attendee->get(array('_id'=>$id));

		$form = new Formly();

		$file = URL::base().'/storage/'.$id.'/'.$doc['docFilename'];
		
		return View::make('pop.approval')->with('doc',$doc)->with('form',$form)->with('href',$file);
	}

	public function rand_string( $length ) {
		$chars = "bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ0123456789";	

		$size = strlen( $chars );
		$str = '';
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}

		return $str;
	}

}