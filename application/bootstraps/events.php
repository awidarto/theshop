<?php

Event::listen('attendee.create',function($id,$newpass){
    $attendee = new Attendee();
    $_id = $id;
    $data = $attendee->get(array('_id'=>$_id));

    $body = View::make('email.regsuccess')
        ->with('data',$data)
        ->with('passwordRandom',$newpass)
        ->with('fromadmin','yes')
        ->render();

    Message::to($data['email'])
        ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
        ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
        ->body( $body )
        ->html(true)
        ->send();

});

Event::listen('attendee.update',function($id,$newpass){
    $attendee = new Attendee();
    $_id = $id;
    $data = $attendee->get(array('_id'=>$_id));

    $body = View::make('email.regsuccess')
        ->with('data',$data)
        ->with('passwordRandom',$newpass)
        ->with('fromadmin','yes')
        ->render();

    Message::to($data['email'])
        ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
        ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
        ->body( $body )
        ->html(true)
        ->send();

});

Event::listen('document.create',function($id, $result){
    $activity = new Activity();

    $doc = getdocument($id);

    $ev = array('event'=>'document.create',
        'timestamp'=>new MongoDate(),
        'creator_id'=>new MongoId(Auth::user()->id),
        'creator_name'=>Auth::user()->fullname,
        'updater_id'=>new MongoId(Auth::user()->id),
        'updater_name'=>Auth::user()->fullname,
        'sharer_id'=>'',
        'sharer_name'=>'',
        'department'=>$doc['docDepartment'],
        'doc_id'=>$id,
        'doc_title'=>$doc['title'],
        'doc_filename'=>$doc['docFilename'],
        'result'=>$result
    );

    if($activity->insert($ev)){
        return true;
    }else{
        return false;
    }

});

Event::listen('document.update',function($id,$result){
    $activity = new Activity();

    $doc = getdocument($id);

    $ev = array('event'=>'document.update',
        'timestamp'=>new MongoDate(),
        'creator_id'=>new MongoId($doc['creatorId']),
        'creator_name'=>$doc['creatorName'],
        'updater_id'=>new MongoId(Auth::user()->id),
        'updater_name'=>Auth::user()->fullname,
        'sharer_id'=>'',
        'sharer_name'=>'',
        'department'=>$doc['docDepartment'],
        'doc_id'=>$id,
        'doc_title'=>$doc['title'],
        'doc_filename'=>$doc['docFilename'],
        'result'=>$result
    );

    if($activity->insert($ev)){
        return true;
    }else{
        return false;
    }

});

Event::listen('document.delete',function($id,$creator_id,$result){
    $activity = new Activity();

    $ev = array('event'=>'document.delete',
        'timestamp'=>new MongoDate(),
        'creator_id'=>new MongoId($creator_id),
        'remover_id'=>new MongoId(Auth::user()->id),
        'doc_id'=>$id,
        'result'=>$result
    );

    if($activity->insert($ev)){
        return true;
    }else{
        return false;
    }

});

Event::listen('document.share',function($id,$sharer_id,$shareto){
    $activity = new Activity();

    $doc = getdocument($id);

    $ev = array('event'=>'document.share',
        'timestamp'=>new MongoDate(),
        'creator_id'=>new MongoId($doc['creatorId']),
        'creator_name'=>$doc['creatorName'],
        'sharer_id'=>new MongoId($sharer_id),
        'sharer_name'=>Auth::user()->fullname,
        'shareto'=>$shareto,
        'doc_id'=>$id,
        'doc_filename'=>$doc['docFilename'],
        'doc_title'=>$doc['title']
    );

    if($activity->insert($ev)){
        return true;
    }else{
        return false;
    }

});


//Project events

Event::listen('project.create',function($id, $result){
    $activity = new Activity();

    $doc = getproject($id);

    $ev = array('event'=>'project.create',
        'timestamp'=>new MongoDate(),
        'creator_id'=>new MongoId(Auth::user()->id),
        'creator_name'=>Auth::user()->fullname,
        'updater_id'=>new MongoId(Auth::user()->id),
        'updater_name'=>Auth::user()->fullname,
        'sharer_id'=>'',
        'sharer_name'=>'',
        'department'=>$doc['projectDepartment'],
        'doc_id'=>$id,
        'doc_number'=>$doc['projectNumber'],
        'doc_title'=>$doc['title'],
        'result'=>$result
    );

    if($activity->insert($ev)){
        return true;
    }else{
        return false;
    }

});

Event::listen('project.update',function($id,$result){
    $activity = new Activity();

    $doc = getproject($id);

    $ev = array('event'=>'project.update',
        'timestamp'=>new MongoDate(),
        'creator_id'=>new MongoId($doc['creatorId']),
        'creator_name'=>$doc['creatorName'],
        'updater_id'=>new MongoId(Auth::user()->id),
        'updater_name'=>Auth::user()->fullname,
        'sharer_id'=>'',
        'sharer_name'=>'',
        'department'=>$doc['projectDepartment'],
        'doc_id'=>$id,
        'doc_number'=>$doc['projectNumber'],
        'doc_title'=>$doc['title'],
        'result'=>$result
    );

    if($activity->insert($ev)){
        return true;
    }else{
        return false;
    }

});

Event::listen('project.delete',function($id,$creator_id,$result){
    $activity = new Activity();

    $ev = array('event'=>'peoject.delete',
        'timestamp'=>new MongoDate(),
        'creator_id'=>new MongoId($creator_id),
        'remover_id'=>new MongoId(Auth::user()->id),
        'doc_id'=>$id,
        'result'=>$result
    );

    if($activity->insert($ev)){
        return true;
    }else{
        return false;
    }

});


//Request events


Event::listen('request.approval',function($id,$approvalby){
    $activity = new Activity();

    $doc = getdocument($id);

    $ev = array('event'=>'request.approval',
        'timestamp'=>new MongoDate(),
        'creator_id'=>new MongoId($doc['creatorId']),
        'creator_name'=>$doc['creatorName'],
        'sharer_id'=>'',
        'sharer_name'=>'',
        'requester_id'=>new MongoId(Auth::user()->id),
        'requester_name'=>Auth::user()->fullname,
        'shareto'=>'',
        'approvalby'=>$approvalby,
        'doc_id'=>$id,
        'doc_filename'=>$doc['docFilename'],
        'doc_title'=>$doc['title']
    );

    if($activity->insert($ev)){
        return true;
    }else{
        return false;
    }

});



Event::listen('send.message',function($from,$to,$subject){
	
});

?>