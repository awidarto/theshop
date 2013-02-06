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
		
		return View::make('register.new')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Visitor Registration');

	}

	public function post_add(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'email' => 'required|email|unique:attendee',
	        'pass' => 'required|same:repass',
	        'repass'=> 'required'
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
			$data['paymentStatus'] = 'unpaid';


			$reg_number[0] = 'A';
			$reg_number[1] = $data['regtype'];
			$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';

			$seq = new Sequence();

			$rseq = $seq->find_and_modify(array('_id'=>'attendee'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

			$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

			$data['registrationnumber'] = implode('-',$reg_number);

			$user = new Attendee();

			if($obj = $user->insert($data)){

				$body = View::make('email.regsuccess')->with('data',$data)->render();

				/*
				Message::to($data['email'])
<<<<<<< HEAD
				    ->from('admin@ipaconvex.com', 'IPA ')
				    ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – Reg. No.)')
				    ->body('view: email.regsuccess')
				    ->body('name:'.$data['firstname'].' '.$data['lastname'].'Jakarta, dd/mm/2013<br/>

Attention to:</br>
Name</br>
Position</br>
Company</br>
Address</br>
</br>
</br>
Registration Number</br>

Dear Sir/Madam,</br>

Thank you for register in 37th IPA Convention & Exhibition. Please find below summary of your registration:</br>
</br>
</br>
CONVENTION REGISTRATION</br>

Type of registration fee (Delegate – Domestic) : IDR 5.000.000,-</br>
Attend on Industrial Dinner (16 May 2012)</br>
: Yes / No

*Convention registration fee includes admission to all Plenary & Technical Sessions, Conference Kits, Opening and
Closing Ceremony, Lunches, Coffee Breaks, Industrial Cocktail, Industrial Dinner, and Entrance to Exhibition Area.
</br>
For the registration payment, you can settle it by bank transfer to:
</br>
IDR Account:
BCA - Mangga Dua Branch
Acc. No.
: 335.302.7677
Acc. Name : PT Dyandra Promosindo
</br>
USD Account:
BCA - Wisma Nusantara Branch
Acc. No.
: 734.038.5700
Acc. Name : PT Dyandra Promosindo
Swiftcode : CENAIDJA
</br>
Please send us copy of your bank transfer to our secretariat by email to conventionipa2013@dyandra.com or
fax 62-21-31997176. Confirmation of Registration will be sent once the payment received. Please bring the
confirmation of registration to the registration counter when you re-register on the conference day.
</br>
: xx – xx - xxxxxx
</br>
IMPORTANT NOTES
1. Early Bird rates only valid for both registration and payment received until 15 March 2013 at the latest.
Normal rate will be applied for the registration with payment settlement after 15 March 2013.</br>
2. Registration is subject to acceptance on a first-come-first-served basis.</br>
3. Registration Forms received without registration fees will not be processed.</br>
4. No refund will be granted for cancellation after 14 April 2013. All cancellations must be made in writing to the</br>
Secretariat and the refund will be made after the conference.</br>
5. If billing address for sending the invoice is different from participant’s company information, please send
billing address information along with the registration form.</br>
6. Registration counter will be open in front of JCC Main Lobby on:</br>
7. Registered participants must wear ID badges all the times for sessions and function access</br>

If you need further information regarding the conference, please feel free to contact us.</br>
Thank you very much for your participation and we look forward to see you on 37 th IPA Convex.</br>

Regards,</br>
Name</br>
37th IPA Convex Secretariat</br>
PT Dyandra Promosindo</br>
The City Tower, 7th Floor | Jl. M.H. Thamrin No. 81 | Jakarta 10310 - Indonesia</br>
T. +62-21-31996077, 31997174 (direct) | F. +62-21-31997176</br>
E. ipaconvention@dyandra.com | W. www.ipaconvex.com</br>')
=======
				    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
				    ->subject('Registration Successful')
				    ->body( $body )
>>>>>>> ab002215db3b37fff649e07e59e87b26d99b0637
				    ->html(true)
				    ->send();
				*/
				//    $message->body->name = $data['firstname'].' '.$data['lastname'];

		    	return Redirect::to('register-success')->with('notify_success',Config::get('site.register_success'));
			}else{
		    	return Redirect::to('register')->with('notify_success',Config::get('site.register_failed'));
			}

	    }

		
	}

	public function get_payment(){

		$this->crumb->add('register','Payment Confirmation');

		$form = new Formly();

		$form->framework = 'zurb';

		return View::make('register.payment')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Payment Confirmation');

	}

	public function post_payment(){

	}

	public function get_success(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('register.success')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Successfully Registered');

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




}
?>