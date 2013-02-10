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

	    	return Redirect::to('register')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();

			$data['pass'] = Hash::make($data['pass']);

			unset($data['repass']);
			unset($data['csrf_token']);
			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();
			$data['role'] = 'attendee';
			$data['conventionPaymentStatus'] = 'unpaid';
			$data['golfPaymentStatus'] = 'unpaid';
			$data['confirmation'] = 'none';


			$reg_number[0] = 'A';
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

				$body = View::make('email.regsuccess')->with('data',$data)->render();

				Message::to($data['email'])
				    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
				    ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
				    ->body( $body )
				    ->html(true)
				    ->send();
				    
		    	return Redirect::to('register-success')->with('notify_success',Config::get('site.register_success'));
			}else{
		    	return Redirect::to('register')->with('notify_success',Config::get('site.register_failed'));
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

		$_id = new MongoId(Auth::attendee()->id);

		$attendee = $att->get(array('_id'=>$_id));

		$form = new Formly($attendee);

		$form->framework = 'zurb';

		return View::make('register.payment')
					->with('form',$form)
					->with('type',$type)
					->with('user',$attendee)
					->with('crumb',$this->crumb)
					->with('title',ucfirst($type).' Payment Confirmation');

	}

	public function post_payment($type = 'convention'){

		$data = Input::get();

	    $rules = array(
	        //'email' => 'required|email|unique:attendee',
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

			if($obj = $confirm->insert($data)){

				$attendee = new Attendee();

				$id = Auth::attendee()->id;

				$_id = new MongoId($id);

				$attendee->update(array('_id'=>$_id),array('$set'=>array($type.'PaymentStatus'=>'pending')));

				$userdata = $attendee->get(array('_id'=>$_id));

				$userdata = array_merge($userdata,$data);

				$userdata[$type.'transferdate'] = date('d-m-Y',$userdata[$type.'transferdate']->sec);

				$body = View::make('email.regpayment')
					->with('type',$type)
					->with('data',$userdata)
					->render();

				
				Message::to($userdata['email'])
				    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
				    ->cc(Config::get('eventreg.reg_finance_email'), Config::get('eventreg.reg_finance_name'))
				    ->subject('Convention Payment Confirmation Submitted')
				    ->body( $body )
				    ->html(true)
				    ->send();
				  
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

			$newpass = $this->rand_string(8);

			$data['pass'] = Hash::make($newpass);


			unset($data['csrf_token']);

			$data['lastUpdate'] = new MongoDate();

			$user = new Attendee();

			

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
		    	return Redirect::to('reset')->with('notify_success',Config::get('site.reset_failed'));
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

			if(isset($data['registrationnumber'])){
				$reg_number = explode('-',$data['registrationnumber']);			
			}else{
				$reg_number = array();
				$seq = new Sequence();
				$rseq = $seq->find_and_modify(array('_id'=>'attendee'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));
				$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);
			}

			$reg_number[0] = 'A';
			$reg_number[1] = $data['regtype'];
			$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';

			$data['registrationnumber'] = implode('-',$reg_number);
			
			if($user->update(array('_id'=>$id),array('$set'=>$data))){
		    	return Redirect::to('myprofile')->with('notify_success','User saved successfully');
			}else{
		    	return Redirect::to('myprofile')->with('notify_success','User saving failed');
			}
			
	    }

		
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
?>