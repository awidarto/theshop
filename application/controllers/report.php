<?php

class Report_Controller extends Base_Controller {

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
		$this->crumb->add('report','Report');

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}

	public function get_index()
	{

		$attendee = new Attendee();

		$stat['PO'] = $attendee->count(array('regtype'=>'PO'));

		$stat['PD'] = $attendee->count(array('regtype'=>'PD'));

		$stat['SO'] = $attendee->count(array('regtype'=>'SO'));

		$stat['SD'] = $attendee->count(array('regtype'=>'SD'));

		$stat['Attendee'] = $attendee->count();

		$stat['paidAttendee'] = $attendee->count(array('conventionPaymentStatus'=>'paid'));

		$stat['unpaidAttendee'] = $attendee->count(array('conventionPaymentStatus'=>'unpaid'));

		$stat['Golf'] = $attendee->count(array('golf'=>'Yes'));
		$stat['Dinner'] = $attendee->count(array('attenddinner'=>'Yes'));
		$country = Config::get('country.countries');

		foreach ($country as $key => $value) {
			$coutryValue[$value] = $attendee->count(array('country'=>$value));
		}

		return View::make('report.summary')
			->with('title','Report')
			->with('stat',$stat)
			->with('coutryValue',$coutryValue)
			->with('country',$country)
			->with('crumb',$this->crumb);
	}

}

?>