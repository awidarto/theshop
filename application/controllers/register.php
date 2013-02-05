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
	        'firstname'  => 'required|max:150',
	        'email' => 'required|email'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('register')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			unset($data['csrf_token']);

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();

			$user = new Attendee();

			if($user->insert($data)){
		    	return Redirect::to('/')->with('notify_success',Config::get('site.register_success'));
			}else{
		    	return Redirect::to('register')->with('notify_success',Config::get('site.register_failed'));
			}

	    }

		
	}

	public function get_payment(){

		$this->crumb->add('register','Payment Confirmation');

		$form = new Formly();
		return View::make('register.payment')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Payment Confirmation');

	}


}
?>