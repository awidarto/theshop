<?php



function rand_string( $length ) {
	$chars = "bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ0123456789";	

	$size = strlen( $chars );
	$str = '';
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}


function getavatar($id,$alt = 'avatar-image',$class = 'avatar'){
	if(file_exists(Config::get('kickstart.avatarstorage').$id.'/avatar.jpg')){
		$photo = HTML::image('avatar/'.$id.'/avatar.jpg', $alt, array('class' => $class));
	}else{
		$photo = HTML::image('images/no-avatar.jpg', 'no-avatar', array('class' => $class));				
	}

	return $photo;
}

function getavatarbyemail($email,$alt = 'avatar-image',$class = 'avatar'){
	$usr = new User();

	$usr = $usr->get(array('email'=>$email),array('id','email'));

	$id = $usr['_id'];

	if(file_exists(Config::get('kickstart.avatarstorage').$id.'/avatar.jpg')){
		$photo = HTML::image('avatar/'.$id.'/avatar.jpg', $alt, array('class' => $class));
	}else{
		$photo = HTML::image('images/no-avatar.jpg', 'no-avatar', array('class' => $class));				
	}

	return $photo;
}

// get employee formal photo

function getphoto($id,$alt = 'avatar-image',$class = 'avatar'){
	if(file_exists(Config::get('kickstart.photostorage').$id.'/formal.jpg')){
		$photo = HTML::image('employees/'.$id.'/formal.jpg', $alt, array('class' => $class));
	}else{
		$photo = HTML::image('images/no-avatar.jpg', 'no-avatar', array('class' => $class));				
	}

	return $photo;
}

function getphotobyemail($email,$alt = 'avatar-image',$class = 'avatar'){
	$usr = new User();

	$usr = $usr->get(array('email'=>$email),array('id','email'));

	$id = $usr['_id'];

	if(file_exists(Config::get('kickstart.photostorage').$id.'/avatar.jpg')){
		$photo = HTML::image('employees/'.$id.'/formal.jpg', $alt, array('class' => $class));
	}else{
		$photo = HTML::image('images/no-avatar.jpg', 'no-avatar', array('class' => $class));				
	}

	return $photo;
}


function getuser($id){
	$_id = new MongoId($id);
	$usr = new User();
	$usr = $usr->get(array('_id'=>$_id));
	return $usr;
}

function getuserbyemail($email){
	$usr = new User();
	$usr = $usr->get(array('email'=>$email));
	return $usr;
}

function getdocument($id){
    $_id = new MongoId($id);
    $document = new Document();
    $doc = $document->get(array('_id'=>$_id));
    return $doc;
}

function getproject($id){
    $_id = new MongoId($id);
    $document = new Project();
    $doc = $document->get(array('_id'=>$_id));
    return $doc;
}

function roletitle($role){
	$roletitles = Config::get('acl.roles');
	return $roletitles[$role];
}

function depttitle($dept){
	$depttitles = Config::get('kickstart.department');
	return $depttitles[$dept];
}

function limitwords($string, $word_limit)
{
    $words = explode(" ",$string);
    if(count($words) <= $word_limit){
    	return $string;
    }else{
	    return implode(" ",array_splice($words,0,$word_limit)).'...';
    }
}

function fixfilename($filename)
{
	$label = $filename;
	$label = str_replace(Config::get('kickstart.invalidchars'), ' ', trim($label));
	$label = preg_replace('/[ ][ ]+/', ' ', $label);
	$label = str_replace(array(' '), '_', $label);

	return $label;
}

function formatrp($angka){
	$rupiah=number_format($angka,2,',','.');
	return $rupiah;
}

?>
