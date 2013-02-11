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

		$this->crumb->add('import','Import Data');
	}

	public function get_index()
	{

		$form = new Formly();

		return View::make('import.import')
			->with('title','Import Data')
			->with('form',$form)
			->with('crumb',$this->crumb);
	}

	public function get_preview($id)
	{

		$this->crumb->add('import/preview','Preview');

		$imp = new Importcache();

		$ihead = $imp->get(array('cache_id'=>$id, 'cache_head'=>true));

		$heads = array();

		//$colclass = array('span3','span3','span3','span1','span1','span1','','','','','','','');

		$colclass = array();

		$cnt = 0;

		$searchinput = array();

		$form = new Formly();

		$select_all = $form->checkbox('select_all','','',false,array('id'=>'select_all'));

		$override_all = $form->checkbox('override_all','','',false,array('id'=>'override_all'));


		foreach ($ihead['head_labels'] as $h) {

			$hidden_head = $form->hidden('mapped_'.$cnt,$h);

			$heads[$cnt] = $h.$hidden_head;

			$searchinput[$cnt] = $form->select('map_'.$cnt,'',Config::get('eventreg.valid_head_selects'),$h);
			if(!in_array($h, Config::get('eventreg.valid_heads'))){
				$heads[$cnt] = '<span class="invalidhead">'.$heads[$cnt].'</span>';
				//$colclass[$cnt] = ' invalidhead';
			}else{
				//$colclass[$cnt] = '';
			}

			$cnt++;
		}

		//$colclass = array_merge(array(''),$colclass);

		//print_r($colclass);

		$colclass = array_merge(array('',''),$colclass);

		$searchinput = array_merge(array($select_all,$override_all),$searchinput);

		$heads = array_merge(array('Select','Override'),$heads);

		//$heads = array('#','Reg Number','First Name','Last Name','Email','Company','Position','Mobile','Created','Last Update','Action');

		//$searchinput = array(false,'Reg Number','First Name','Last Name','Email','Company','Position','Mobile','Phone','Fax','Created','Last Update',false);

		//$colclass = array('','span1','span1','span1','span1','span1','span1','span1','','','','','');

		//$searchinput = false; // no searchinput form on footer

		return View::make('tables.import')
			->with('title','Data Preview')
			->with('newbutton','Commit Import')
			->with('disablesort','0,5,6')
			->with('addurl','')
			->with('commiturl','import/commit/'.$id)
			->with('importid',$id)
			->with('reimporturl','import')
			->with('form',$form)
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

		$imp = new Importcache();

		$ihead = $imp->get(array('cache_id'=>$id, 'cache_head'=>true));

		$fields = $ihead['head_labels'];


		//$fields = array('registrationnumber','firstname','lastname','email','company','position','mobile','companyphone','companyfax','createdDate','lastUpdate');

		$rel = array('like','like','like','like','like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both','both','both','both','both');

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 0;
		$q = array('cache_head'=>false,'cache_id'=>$id);

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

		$attendee = new Importcache();

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

		$attending = new Attendee();

		$email_arrays = array();

		foreach($attendees as $e){
			$email_arrays[] = array('email'=>$e['email']);
		}

		//print_r($email_arrays);

		$email_check = $attending->find(array('$or'=>$email_arrays),array('email'=>1,'_id'=>-1));

		$email_arrays = array();

		foreach($email_check as $ec){
			$email_arrays[] = $ec['email'];
		}

		//print_r($email_arrays);


		$aadata = array();

		$form = new Formly();

		$counter = 1 + $pagestart;

		foreach ($attendees as $doc) {

			$extra = $doc;


			$adata = array();

			for($i = 0; $i < count($fields); $i++){

				if(in_array($doc[$fields[$i]], $email_arrays)){
					$adata[$i] = '<span class="duplicateemail">'.$doc[$fields[$i]].'</spam>';
				}else{
					$adata[$i] = $doc[$fields[$i]];
				}

			}

			//print_r($adata);


			$select = $form->checkbox('sel[]','',$doc['_id'],false,array('id'=>$doc['_id'],'class'=>'selector'));


			if(in_array($doc['email'], $email_arrays)){
				$override = $form->checkbox('over[]','',$doc['_id'],'',array('id'=>'over_'.$doc['_id'],'class'=>'overselector'));
			}else{
				$override = '';
			}

			$adata = array_merge(array($select,$override),$adata);

			$adata['extra'] = $extra;

			$aadata[] = $adata;

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

	public function post_commit(){
		$data = Input::all();

		print_r($data);
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

				if($newobj['docFilename'] != ''){

					$icache = new Importcache();

					$c_id = $newobj['_id']->__toString();

					$filepath = Config::get('kickstart.storage').'/'.$c_id.'/'.$newobj['docFilename'];

					$excel = new Excel();

					$xls = $excel->load($filepath);

					$rows = $xls['cells'];

					$heads = $rows[1];


					unset($rows[0]);
					unset($rows[1]);

					$inhead = array();

					$chead = array();

					foreach ($heads as $head) {
						$label = str_replace(array('.','\''), '', $head);
						$label = str_replace(array('/',' '), '_', $label);
						$label = strtolower(trim($label));

						$chead[] = $label;
					}

					$inhead['head_labels'] = $chead;
					$inhead['cache_head'] = true;
					$inhead['cache_id'] = $c_id;
					$inhead['cache_commit'] = false;

					$icache->insert($inhead);							

					foreach($rows as $row){

						if(implode('',$row) != ''){
							$ins = array();
							for($i = 0; $i < count($heads); $i++){

								$label = str_replace(array('.','\''), '', $heads[$i]);
								$label = str_replace(array('/',' '), '_', $label);

								$label = strtolower(trim($label));

								$ins[$label] = $row[$i];
							}

							$ins['cache_head'] = false;
							$ins['cache_id'] = $c_id;
							$ins['cache_commit'] = false;

							$icache->insert($ins);							
						}

					}

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