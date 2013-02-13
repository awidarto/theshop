<?php

class Register_Controller extends Base_Controller {

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

	public function __construct(){

		$this->crumb = new Breadcrumb();

		date_default_timezone_set('Asia/Jakarta');
	}


	public function get_index(){

		$this->crumb->add('register','Visitor Registration');

		$form = new Formly();
		$form->framework = 'zurb';

		$attendee = new Attendee();

		$golfcount = $attendee->count(array('golf'=>'Yes'));

		return View::make('register.new')
					->with('form',$form)
					->with('golfcount',$golfcount)
					->with('crumb',$this->crumb)
					->with('title','Convention Registration');

	}

	public function post_add(){

		//print_r(Session::get('permission'));

	    $rules = array(
	    	'firstname' => 'required',
	    	'lastname' => 'required',
	    	'position' => 'required',
	        'email' => 'required|email|unique:attendee',
	        'pass' => 'required|same:repass',
	        'repass'=> 'required',
	        'company' => 'required',
	        'companyphone' => 'required',
	        'address_1' => 'required',
	        'city' => 'required',
	        'zip' => 'required',
	        'country' => 'required',
	        'companyInvoice' => 'required',
	        'companyphoneInvoice' => 'required',
	        'addressInvoice_1' => 'required',
	        'cityInvoice' => 'required',
	        'zipInvoice' => 'required',
	        'countryInvoice' => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('register')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
			$password = $data['pass'];
			$data['pass'] = Hash::make($data['pass']);


			unset($data['repass']);
			unset($data['csrf_token']);
			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();
			$data['role'] = 'attendee';
			$data['conventionPaymentStatus'] = 'unpaid';
			//force to disable golf on student type
			if(($data['regtype'] == 'SO') || ($data['regtype'] == 'SD')){
				$data['golf'] == 'No';
			}
			if($data['golf'] == 'Yes'){
				$data['golfPaymentStatus'] = 'unpaid';
			}else{
				$data['golfPaymentStatus'] = '-';
			}
			$data['confirmation'] = 'none';


			$reg_number[0] = 'C';
			$reg_number[1] = $data['regtype'];
			$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';

			$seq = new Sequence();

			$rseq = $seq->find_and_modify(array('_id'=>'attendee'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

			$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

			$data['registrationnumber'] = implode('-',$reg_number);

			$data['golfSequence'] = 0;

			if($data['golf'] == 'Yes'){
				$gseq = $seq->find_and_modify(array('_id'=>'golf'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true,'upsert'=>true));
				$data['golfSequence'] = $gseq['seq'];
			}


			$user = new Attendee();

			if($obj = $user->insert($data)){

				$body = View::make('email.regsuccess')
					->with('data',$data)
					->with('fromadmin','yes')
					->with('passwordRandom',$password)
					->render();

				Message::to($data['email'])
				    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
				    ->cc(Config::get('eventreg.reg_dyandra_admin_email'), Config::get('eventreg.reg_dyandra_admin_name'))
				    ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
				    ->body( $body )
				    ->html(true)
				    ->send();

		    	return Redirect::to('register-success')->with('notify_success',Config::get('site.register_success'));
			}else{
		    	return Redirect::to('register')->with('notify_result',Config::get('site.register_failed'));
			}

	    }


	}

	public function get_payment($type){

		if(!Auth::attendee()){
			return Redirect::to('/');
		}

		$this->crumb->add('register/payment/'.$type,ucfirst($type).' Payment Confirmation');

		$att = new Attendee();

		//print_r(Auth::attendee());

		$confirm = new Confirmation();

		$confirmdata = $confirm->get(array('type'=>$type,'id'=>Auth::attendee()->id));

		$_id = new MongoId(Auth::attendee()->id);

		$attendee = $att->get(array('_id'=>$_id));

		if(is_null($confirmdata) || count($confirmdata) < 0 || !isset($confirmdata) || !is_array($confirmdata)){

		}else{

			$attendee = array_merge($attendee,$confirmdata);

		}

		$form = new Formly($attendee);

		$golfcount = $att->count(array('golf'=>'Yes','golfPaymentStatus'=>'paid'));

		$form->framework = 'zurb';

		return View::make('register.payment')
					->with('form',$form)
					->with('type',$type)
					->with('user',$attendee)
					->with('crumb',$this->crumb)
					->with('golfcount',$golfcount)
					->with('title',ucfirst($type).' Payment Confirmation');

	}

	public function post_payment($type = 'convention'){

		$data = Input::get();

	    $rules = array(
	        $type.'transferdate' => 'required',
	        $type.'totalpayment' => 'required',
	        $type.'fromaccountname' => 'required',
	        $type.'fromaccnumber' => 'required',
	        $type.'frombank' => 'required',
	        'docupload' => 'required',
	    );

	    $type = $data['type'];

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('payment/'.$type)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();

			unset($data['repass']);
			unset($data['csrf_token']);

			$data[$type.'transferdate'] = new MongoDate(strtotime($data[$type.'transferdate']." 00:00:00"));

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();

			$confirm = new Confirmation();


			// uploaded receipt
			$docupload = Input::file('docupload');
			$docupload[$type.'DocUploadTime'] = new MongoDate();

			$fileExt = File::extension( $docupload['name']);

			$docName = $type.'PaymentProof.'.$fileExt;

			$data[$type.'DocFilename'] = $docName;

			$data[$type.'DocFiledata'] = $docupload;


			if($obj = $confirm->insert($data)){


				if($docupload['name'] != ''){

					$newid = $obj['_id']->__toString();

					$newdir = realpath(Config::get('kickstart.storage')).'/payments/'.$newid;

					Input::upload('docupload',$newdir,$docName);

					$email_attachment = $newdir.'/'.$docName;
				}else{
					$email_attachment = false;
				}


				$attendee = new Attendee();

				$id = Auth::attendee()->id;

				$_id = new MongoId($id);

				$attendee->update(array('_id'=>$_id),array('$set'=>array($type.'PaymentStatus'=>'pending')));

				$userdata = $attendee->get(array('_id'=>$_id));

				$userdata = array_merge($userdata,$data);

				$userdata[$type.'transferdate'] = date('d-m-Y',$userdata[$type.'transferdate']->sec);

				$userdata['address'] = $userdata['address_1'].'<br />'.$userdata['address_2'];

				$body = View::make('email.regpayment')
					->with('type',$type)
					->with('data',$userdata)
					->render();

				if($email_attachment == false){
					Message::to($userdata['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_finance_email'), Config::get('eventreg.reg_finance_name'))
					    ->subject(ucfirst($type).' Payment Confirmation – '.$userdata['registrationnumber'])
					    ->body( $body )
					    ->html(true)
					    ->send();
				}else{
					Message::to($userdata['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_finance_email'), Config::get('eventreg.reg_finance_name'))
					    ->subject(ucfirst($type).' Payment Confirmation – '.$userdata['registrationnumber'])
					    ->body( $body )
					    ->html(true)
					    ->attach($email_attachment)
					    ->send();
				}

		    	return Redirect::to('paymentsubmitted')->with('notify_success',Config::get('site.payment_success'));
			}else{
		    	return Redirect::to('register')->with('notify_success',Config::get('site.payment_failed'));
			}
		}

	}

	public function get_success(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('register.success')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Successfully Registered');

	}

	public function get_paymentsubmitted(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('register.paymentsubmitted')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Thank you for your payment confirmation!');

	}

	public function get_login(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('register.login')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Login Form');

	}

	public function get_landing(){

		$this->crumb->add('register','Register');

		return View::make('register.landing')
					->with('crumb',$this->crumb)
					->with('title','');
	}

	public function get_reset(){

		$this->crumb->add('register/reset','Reset Password');

		$form = new Formly();
		return View::make('register.resetpass')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Reset Password Form');

	}

	public function post_reset(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'email' => 'required|email',
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('reset')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();

			$newpass = rand_string(8);

			$data['pass'] = Hash::make($newpass);


			unset($data['csrf_token']);

			$data['lastUpdate'] = new MongoDate();

			$user = new Attendee();

			$ex = $user->get(array('email'=>$data['email']));

			if(isset($ex['email']) && $ex['email'] == $data['email']){

				if($obj = $user->update(array('email'=>$data['email']),array('$set'=>$data))){

					$userdata = $user->get(array('email'=>$data['email']));


					$body = View::make('email.resetpass')
						->with('data',$data)
						->with('userdata',$userdata)
						->with('newpass',$newpass)
						->render();

					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->subject('Password Reset - Indonesia Petroleum Association – 37th Convention & Exhibition)')
					    ->body( $body )
					    ->html(true)
					    ->send();

			    	return Redirect::to('resetlanding')->with('notify_success',Config::get('site.reset_success'));
				}else{
			    	return Redirect::to('reset')->with('notify_result',Config::get('site.reset_failed'));
				}

			}else{

		    	return Redirect::to('reset')->with('notify_result',Config::get('site.reset_email_not_found'));

			}



	    }


	}


	public function get_resetlanding(){

		$this->crumb->add('register/reset','Reset Password');

		return View::make('register.resetlanding')
					->with('crumb',$this->crumb)
					->with('title','Reset Password Success');
	}

	public function get_group(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('register.group')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Group/Bulk Registration');

	}

	public function get_profile($id = null){

		if(is_null($id)){
			$this->crumb = new Breadcrumb();
		}

		$user = new Attendee();

		$id = (is_null($id))?Auth::attendee()->id:$id;

		$id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$id));
		//$user_type = $user_profile['regtype'];

		$this->crumb->add('project/profile','Profile',false);
		$this->crumb->add('project/profile',$user_profile['firstname'].' '.$user_profile['lastname']);

		return View::make('register.profile')
			->with('crumb',$this->crumb)
			->with('profile',$user_profile);
			//->with('type',$this->user_type);
	}

	public function get_edit(){

		$this->crumb->add('user/edit','Edit',false);

		$user = new Attendee();

		$id = Auth::attendee()->id;

		$id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$id));

		//print_r($user_profile);

		$form = Formly::make($user_profile);

		$form->framework = 'zurb';

		return View::make('register.edit')
					->with('user',$user_profile)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Edit My Profile');

	}


	public function post_edit(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'email'  => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('myprofile/edit')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();

			$id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();

			unset($data['csrf_token']);
			unset($data['id']);

			$user = new Attendee();

			if(isset($data['registrationnumber']) && $data['registrationnumber'] != ''){
				$reg_number = explode('-',$data['registrationnumber']);

				$reg_number[0] = 'C';
				$reg_number[1] = $data['regtype'];
				$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';


			}else if($data['registrationnumber'] == ''){
				$reg_number = array();
				$seq = new Sequence();
				$rseq = $seq->find_and_modify(array('_id'=>'attendee'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

				$reg_number[0] = 'C';
				$reg_number[1] = $data['regtype'];
				$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';

				$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);
			}

			//golf sequencer
			/*$data['golfSequence'] = 0;

			if($data['golf'] == 'Yes'){
				$gseq = $seq->find_and_modify(array('_id'=>'golf'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true,'upsert'=>true));
				$data['golfSequence'] = $gseq['seq'];
			}*/

			$data['registrationnumber'] = implode('-',$reg_number);

			if($user->update(array('_id'=>$id),array('$set'=>$data))){
		    	return Redirect::to('myprofile')->with('notify_success','Attendee saved successfully');
			}else{
		    	return Redirect::to('myprofile')->with('notify_success','Attendee saving failed');
			}

	    }


	}


}
?>