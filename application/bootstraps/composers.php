<?php
/*
|--------------------------------------------------------------------------
| View Composers
|--------------------------------------------------------------------------
|
*/

View::composer('public',function($view){

    $view->nest('topnav','partials.publictopnav');

});


View::composer('master',function($view){
<<<<<<< HEAD
    $tag = new Tag();
    $tags = $tag->find(array(), array(),array('count'=>-1));

    //$message = new Message();
    //$messages = $message->find(array(), array(),array('createdDate'=>-1),array(10,0));
=======
>>>>>>> ab002215db3b37fff649e07e59e87b26d99b0637

    $view->nest('topnav','partials.topnav');
    $view->nest('sidenav','partials.sidenav');
    $view->nest('identity','partials.identity');
<<<<<<< HEAD
    $view->nest('tagcloud','partials.tags',array('tags'=>$tags));
    //$view->nest('messages','partials.messages',array('messages'=>$messages));
=======
>>>>>>> ab002215db3b37fff649e07e59e87b26d99b0637
});

View::composer('noaside',function($view){

    $view->nest('topnav','partials.topnav');
    $view->nest('sidenav','partials.sidenav');
    $view->nest('identity','partials.identity');

});

?>