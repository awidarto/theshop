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


    $view->nest('topnav','partials.topnav');
    $view->nest('sidenav','partials.sidenav');
    $view->nest('identity','partials.identity');
    $view->nest('header','partials.header');

});

View::composer('noaside',function($view){

    $view->nest('topnav','partials.topnav');
    $view->nest('sidenav','partials.sidenav');
    $view->nest('identity','partials.identity');

});

?>