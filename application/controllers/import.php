<?php

class Import_Controller extends Base_Controller {

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
	}

	public function get_index()
	{

		$this->crumb->add('import','Import Data');
		$form = new Formly();

		return View::make('import.import')
			->with('title','Import Data')
			->with('form',$form)
			->with('crumb',$this->crumb);
	}

	public function get_preview($id)
	{
		$imp = new Import();

		$_id = new MongoId($id);

		$imported = $imp->get(array('_id'=>$_id),array('docFilename'=>1,'_id'=>-1));

		$filepath = Config::get('kickstart.storage').'/'.$id.'/'.$imported['docFilename'];

		$excel = new Excel();

		$xls = $excel->load($filepath);

		$rows = $xls['cells'];

		$heads = $rows[1];

		//$heads = array('#','Reg Number','First Name','Last Name','Email','Company','Position','Mobile','Created','Last Update','Action');

		$searchinput = array(false,'Reg Number','First Name','Last Name','Email','Company','Position','Mobile','Phone','Fax','Created','Last Update',false);

		//$colclass = array('','span1','span1','span1','span1','span1','span1','span1','','','','','');
		$colclass = array('','span3','span3','span3','span1','span1','span1','','','','','','','');

		$searchinput = false; // no searchinput form on footer

		return View::make('tables.simple')
			->with('title','Data Preview')
			->with('newbutton','Commit Import')
			->with('disablesort','0,5,6')
			->with('addurl','import/add')
			->with('colclass',$colclass)
			->with('searchinput',$searchinput)
			->with('ajaxsource',URL::to('import/loader/'.$id))
			->with('ajaxdel',URL::to('attendee/del'))
			->with('crumb',$this->crumb)
			->with('heads',$heads)
			->nest('row','attendee.rowdetail');
	}

	public function post_loader($id)
	{


		$imp = new Import();

		$_id = new MongoId($id);

		$imported = $imp->get(array('_id'=>$_id),array('docFilename'=>1,'_id'=>-1));

		$filepath = Config::get('kickstart.storage').'/'.$id.'/'.$imported['docFilename'];

		$excel = new Excel();

		$xls = $excel->load($filepath);

		$rows = $xls['cells'];

		$heads = $rows[1];

		$adata = $rows;

		unset($adata[0]);
		unset($adata[1]);

		$fields = $rows[1];

		$rel = array('like','like','like','like','like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both','both','both','both','both');

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 0;
		$q = array();

		$hilite = array();
		$hilite_replace = array();

		$aaData = array();

		foreach ($adata as $doc) {

			$extra = $doc;

			$doc['extra'] = $extra;

			$aadata[] = $doc;
		}
		
		$result = array(
			'sEcho'=> Input::get('sEcho'),
			'iTotalRecords'=>count($adata),
			'iTotalDisplayRecords'=> count($adata),
			'aaData'=>$aadata,
			'qrs'=>''
		);

		return Response::json($result);
	}


	public function post_preview()
	{

		//print_r(Session::get('permission'));

		$back = 'import/preview';

	    $rules = array(
	        'email'  => 'required',
	        'firstname'  => 'required',
	        'lastname'  => 'required',
	        'position' => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('import')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
	    	//print_r($data);

			//pre save transform
			unset($data['csrf_token']);

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();
			$data['creatorName'] = Auth::user()->fullname;
			$data['creatorId'] = Auth::user()->id;

			
			$docupload = Input::file('docupload');

			$docupload['uploadTime'] = new MongoDate();

			$data['docFilename'] = $docupload['name'];

			$data['docFiledata'] = $docupload;

			$data['docFileList'][] = $docupload;

			$document = new Import();

			$newobj = $document->insert($data);


			if($newobj){


				if($docupload['name'] != ''){

					$newid = $newobj['_id']->__toString();

					$newdir = realpath(Config::get('kickstart.storage')).'/'.$newid;

					Input::upload('docupload',$newdir,$docupload['name']);
					
				}

				Event::fire('import.create',array('id'=>$newobj['_id'],'result'=>'OK','department'=>Auth::user()->department,'creator'=>Auth::user()->id));

		    	return Redirect::to($back.'/'.$newobj['_id'])->with('notify_success','Document saved successfully');
			}else{
				Event::fire('import.create',array('id'=>$id,'result'=>'FAILED'));
		    	return Redirect::to($back)->with('notify_success','Document saving failed');
			}

	    }

		
	}


}

?>