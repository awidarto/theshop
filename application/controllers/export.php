<?php

class Export_Controller extends Base_Controller {

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

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');

		$this->crumb->add('import','Export Data');
	}

	public function get_index()
	{

		$form = new Formly();

		return View::make('export.export')
			->with('title','Export Data')
			->with('form',$form)
			->with('crumb',$this->crumb);
	}

	public function post_index(){

		$criteria = Input::get();

		if($criteria['daterange'] == 'creation'){
			$rules = array(
		        'collection'  => 'required',
		        'fromDate' => 'required',
		        'toDate' => 'required'
		    );
		}else{
			$rules = array(
		        'collection'  => 'required',
		    );
		}

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('export')->with_errors($validation)->with_input(Input::all());

	    }else{

			switch($criteria['collection']){
				case 'attendee' :
					$dataset = new Attendee();
					break;
				case 'visitor' :
					$dataset = new Attendee();
					break;
				case 'official' :
					$dataset = new Official();
					break;
				case 'exhibitor' :
					$dataset = new Exhibitor();
					break;
			}

			if($criteria['daterange'] == 'all'){
				$dataresult = $dataset->find();
			}else if($criteria['daterange'] == 'creation'){

				$dateFrom = new MongoDate(strtotime($criteria['fromDate']." 00:00:00"));
				$dateTo = new MongoDate(strtotime($criteria['toDate']." 23:59:59"));

				$dataresult = $dataset->find(array('createdDate'=>array('$gte'=>$dateFrom,'$lte'=>$dateTo)));
			}

			if($criteria['format'] == 'csv'){

				$filename = date('Ymd_his',time()).'_'.$criteria['collection'].'.csv';

				$header['Cache-Control'] = "must-revalidate, post-check=0, pre-check=0";
				$header['Content-Description'] = "File Transfer";
				$header['Content-type'] = "text/csv";
				$header['Content-Disposition'] = "attachment; filename=".$filename;
				$header['Expires'] = "0";
				$header['Pragma'] = "public";

				$dataheader = Config::get('eventreg.'.$criteria['collection'].'_csv_template');

				$dataheader = array_keys($dataheader);

				for($i = 0; $i < count($dataheader);$i++){
					$first_row[$i] = '"'.$dataheader[$i].'"';
				}

				$first_row = implode(',',$first_row);

				//print $first_row;

				$result = array();
				$result[] = $first_row; // add the header

				foreach($dataresult as $row){
					$inrow = array();
					for($i = 0; $i < count($dataheader); $i++){

						if(isset($row[$dataheader[$i]])){
							$inrow[$i] = '"'.$row[$dataheader[$i]].'"';
						}else{
							$inrow[$i] = '""';
						}
					}					
					$result[] = implode(',',$inrow);
				}

				//$dataresult = serialize($dataresult);
				//$result = Formatter::make($dataresult,'serialize')->to_csv();

				//print_r($result);

				$result = implode("\r\n",$result);
				return Response::make($result,'200',$header);
			}



	    }

	}

}

?>