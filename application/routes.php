<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

Route::controller(array('register','exhibition','product','report','booth','import','export','dashboard','onsite','attendee','exhibitor','official','visitor','user','message','search','activity','category','content','ajax'));

Route::get('/',function(){
    if(Auth::check()){
        if(Auth::user()->role == 'root' || Auth::user()->role == 'super'){
           return Redirect::to('dashboard');
        }else if(Auth::user()->role == 'onsite'){
           return Redirect::to('onsite');
        }
    }else{
       return Redirect::to('content/public/general');
    }
});

Route::get('general',array('uses'=>'content@public'));

Route::post('register',array('uses'=>'register@add'));

Route::get('exhibitor/profile',array('uses'=>'exhibition@profile'));
Route::get('exhibitor/login',array('uses'=>'exhibition@login'));
Route::get('exhibitor/profile/edit',array('uses'=>'exhibition@edit'));
Route::post('exhibitor/profile/edit',array('uses'=>'exhibition@edit'));

Route::get('myprofile/edit',array('uses'=>'register@edit'));
Route::post('myprofile/edit',array('uses'=>'register@edit'));

Route::get('myprofile',array('uses'=>'register@profile'));


Route::get('payment/checkout',array('uses'=>'register@checkout'));

Route::get('payment/(:any)',array('uses'=>'register@payment'));
Route::post('payment/(:any)',array('uses'=>'register@payment'));

Route::get('export/report/(:any)',array('uses'=>'export@report'));


Route::get('reset',array('uses'=>'register@reset'));
Route::post('reset',array('uses'=>'register@reset'));

Route::get('exhibitor/reset',array('uses'=>'exhibition@reset'));
Route::post('exhibitor/reset',array('uses'=>'exhibition@reset'));

Route::get('resetlanding',array('uses'=>'register@resetlanding'));
Route::get('exhibitor/resetlanding',array('uses'=>'exhibition@resetlanding'));

Route::get('exhibitor/operationalform',array('uses'=>'exhibition@operationalform'));
Route::post('exhibitor/operationalform',array('uses'=>'exhibition@operationalform'));


Route::get('paymentsubmitted',array('as'=>'register/paymentsubmitted','uses'=>'register@paymentsubmitted'));
Route::get('register-success',array('as'=>'register/success','uses'=>'register@success'));
Route::get('register-landing',array('as'=>'register/landing','uses'=>'register@landing'));
Route::get('register-group',array('as'=>'register/group','uses'=>'register@group'));

/*
Route::get('/',  function(){
    $heads = array('Home','Action');
    //$searchinput = array(false,'title','created','last update','creator','project manager','tags',false);
    $searchinput = array(false,'project','tags',false);

    $crumb = new Breadcrumb();

    return View::make('tables.event')
        ->with('title','')
        ->with('newbutton','New Event')
        ->with('disablesort','0')
        ->with('crumb',$crumb)
        ->with('searchinput',$searchinput)
        ->with('ajaxsource',URL::to('activity'));
});
*/

Route::get('hashme/(:any)',function($mypass){

	print Hash::make($mypass);
});

Route::get('normalize',array('uses'=>'attendee@updateField'));
Route::get('normalTotal',array('uses'=>'attendee@normalTotal'));

Route::get('pdftest',array('uses'=>'import@pdftest'));


// Auth routes

Route::get('login', function()
{
	return View::make('auth.login');
});

Route::post('login', function()
{
	// get POST data
    $username = Input::get('username');
    $password = Input::get('password');

    if ( $userdata = Auth::attempt(array('username'=>$username, 'password'=>$password)) )
    {
    	//print_r($userdata);
        // we are now logged in, go to home
        return Redirect::to('/');

    }
    else
    {
        // auth failure! lets go back to the login
        return Redirect::to('login')
            ->with('login_errors', true);
        // pass any error notification you want
        // i like to do it this way  
    }

});

Route::post('attendee/login', function()
{
    // get POST data
    $username = Input::get('username');
    $password = Input::get('password');

    if ( $userdata = Auth::attendeeattempt(array('username'=>$username, 'password'=>$password)) )
    {
        //print_r($userdata);
        // we are now logged in, go to home
        return Redirect::to('myprofile');

    }
    else
    {
        // auth failure! lets go back to the login
        return Redirect::to('register/login')
            ->with('login_errors', true);
        // pass any error notification you want
        // i like to do it this way  
    }

});

Route::post('exhibitor/login', function()
{
    // get POST data
    $username = Input::get('username');
    $password = Input::get('password');

    if ( $userdata = Auth::exhibitorattempt(array('username'=>$username, 'password'=>$password)) )
    {
        //print_r($userdata);
        // we are now logged in, go to home
        return Redirect::to('exhibitor/profile');

    }
    else
    {
        // auth failure! lets go back to the login
        return Redirect::to('exhibitor/login')
            ->with('login_errors', true);
        // pass any error notification you want
        // i like to do it this way  
    }

});

Route::get('passwd', array('before'=>'auth',function(){
    return View::make('auth.password');
}));

Route::post('passwd', function()
{
	// get POST data
    $newpass = Input::get('pass');
    $chkpass = Input::get('chkpass');

    if ($newpass == $chkpass)
    {

        if(Auth::changepass($newpass)){
			return Redirect::to('user')->with('notify_success','Password changed.');        	
        }

    }
    else
    {
        // auth failure! lets go back to the login
        return Redirect::to('passwd')
            ->with('newpass_errors', true);
        // pass any error notification you want
        // i like to do it this way  
    }

});


Route::get('logout',function(){
	Auth::logout();
	return Redirect::to('/');
});

Route::get('requests',array('before'=>'auth','uses'=>'requests@incoming'));

Route::get('user/profile',array('before'=>'auth','uses'=>'user@profile'));

Route::get('users',array('before'=>'auth','uses'=>'user@users'));

Route::post('users',array('before'=>'auth','uses'=>'user@users'));

Route::get('hr',array('before'=>'auth','uses'=>'hr@users'));

Route::post('hr',array('before'=>'auth','uses'=>'hr@users'));

/*
Route::get('document',array('before'=>'auth','uses'=>'document@index'));
*/

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});


/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});