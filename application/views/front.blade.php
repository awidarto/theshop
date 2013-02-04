<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
   <meta charset="utf-8" />
   <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <!-- Mobile viewport optimized: h5bp.com/viewport -->
   <meta name="viewport" content="width=device-width">

   <title>{{ Config::get('site.title') }}</title>

   
   
   <!-- remove or comment this line if you want to use the local fonts -->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>

   

   {{ HTML::style('content/css/bootstrap.css') }}
   {{ HTML::style('content/css/bootstrap-responsive.css') }}
   {{ HTML::style('content/css/bootmetro.css') }}
   {{ HTML::style('content/css/bootmetro-tiles.css') }}
   {{ HTML::style('content/css/bootmetro-charms.css') }}
   {{ HTML::style('content/css/metro-ui-light.css') }}
   {{ HTML::style('content/css/icomoon.css') }}
   {{ HTML::style('content/css/app.css') }}

   <!--  these two css are to use only for documentation -->
   
   {{ HTML::style('content/css/demo.css') }}
   <link rel="stylesheet" type="text/css" href="scripts/google-code-prettify/prettify.css" >

   <!-- Le fav and touch icons -->
  
  
   <!-- All JavaScript at the bottom, except for Modernizr and Respond.
      Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
      For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
   
   {{ HTML::script('scripts/modernizr-2.6.1.min.js') }}
   
</head>

<body data-accent="blue">
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

   <!-- Header
   ================================================== -->
   <header id="nav-bar" class="container-fluid">
      <div class="row-fluid">
         <div class="span8">
            <div id="header-container">
              {{ HTML::image('images/ipa-logo-small.png','ipalogo',array('class'=>'logo-header')) }}
              <h5>THE 37th IPA CONVENTION and EXHIBITION 2013</h5>
              <a class="header-dropdown dropdown-toggle accent-color" data-toggle="dropdown" href="#">
                Start
                <b class="caret"></b>
              </a>
            </div>
         </div>
         <div id="top-info" class="pull-right">
           <a href="#" class="pull-left">
              @yield('identity')
              <div class="top-info-block">
                 <b class="icon-user"></b>
              </div>
           </a>
           <hr class="separator pull-left"/>
           <a id="settings" class="pull-left" href="#">
              <b class="icon-settings"></b>
           </a>
        </div>
    </div>
  </header>

   <div class="container-fluid">
      <div class="row-fluid">
        @if (Session::has('notify_success'))
              <div class="row">
                  <span class="success">{{Session::get('notify_success')}}</span>
              </div>
          @endif
          @yield('content')
      </div>
   </div>
   
  <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
 <!--<script>window.jQuery || document.write("<script src='scripts/jquery-1.8.2.min.js'>\x3C/script>")</script>-->

 {{ HTML::script('scripts/google-code-prettify/prettify.js') }}
 {{ HTML::script('scripts/jquery.mousewheel.js') }}
 {{ HTML::script('scripts/jquery.scrollTo.js') }}
 {{ HTML::script('scripts/bootstrap.min.js') }}
 {{ HTML::script('scripts/bootmetro.js') }}
 {{ HTML::script('scripts/bootmetro-charms.js') }}
 {{ HTML::script('scripts/demo.js') }}
 {{ HTML::script('scripts/holder.js') }}
 

 <script type="text/javascript">
    $(".metro").metro();
 </script>


</body>
</html>
