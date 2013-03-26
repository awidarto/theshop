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
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>{{ Config::get('site.title') }}</title>



    <!-- remove or comment this line if you want to use the local fonts -->
  
  {{ HTML::style('metronic/bootstrap/css/bootstrap.min.css') }}
  {{ HTML::style('metronic/css/metro.css') }}
  {{ HTML::style('metronic/bootstrap/css/bootstrap-responsive.min.css') }}
  {{ HTML::style('metronic/font-awesome/css/font-awesome.css') }}
  {{ HTML::style('metronic/css/style.css') }}
  {{ HTML::style('metronic/css/style_responsive.css') }}
  {{ HTML::style('metronic/css/style_default.css',array('id'=>'style_color')) }}
  {{ HTML::style('metronic/gritter/css/jquery.gritter.css') }}
  {{ HTML::style('metronic/uniform/css/uniform.default.css') }}
  {{ HTML::style('metronic/bootstrap-daterangepicker/daterangepicker.css') }}
  {{ HTML::style('metronic/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}
  {{ HTML::style('metronic/jqvmap/jqvmap/jqvmap.css') }}

  
</head>

<body class="fixed-top">

  @yield('header')

  <!-- Header and Nav -->
  
  <!-- BEGIN CONTAINER -->
  <div class="page-container row-fluid">
    @yield('sidenav')

    <!-- BEGIN PAGE -->
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div id="portlet-config" class="modal hide">
          <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
            <h3>Widget Settings</h3>
          </div>
          <div class="modal-body">
            <p>Here will be a configuration form</p>
          </div>
        </div>
        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid">
          @yield('content')
        </div>
      <!-- END PAGE CONTAINER-->  
    </div>
    <!-- END PAGE -->
    
  
  
  <div class="footer">
    2013 &copy; thanks letbit.
    <div class="span pull-right">
      <span class="go-top"><i class="icon-angle-up"></i></span>
    </div>
  </div>
  

  
  <!-- END FOOTER -->
  <!-- BEGIN JAVASCRIPTS -->
  <!-- Load javascripts at bottom, this will reduce page load time -->
  {{ HTML::script('metronic/js/jquery-1.8.3.min.js') }}
  
  <!--[if lt IE 9]>
  <script src="assets/"></script>
  {{ HTML::script('metronic/js/excanvas.js') }}
  {{ HTML::script('metronic/js/respond.js') }}
  
  <![endif]--> 
  {{ HTML::script('metronic/breakpoints/breakpoints.js') }}
  {{ HTML::script('metronic/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js') }}
  {{ HTML::script('metronic/jquery-slimscroll/jquery.slimscroll.min.js') }}
  {{ HTML::script('metronic/fullcalendar/fullcalendar/fullcalendar.min.js') }}
  {{ HTML::script('metronic/bootstrap/js/bootstrap.min.js') }}
  {{ HTML::script('metronic/js/jquery.blockui.js') }}
  {{ HTML::script('metronic/js/jquery.cookie.js') }}
  {{ HTML::script('metronic/jqvmap/jqvmap/jquery.vmap.js') }}
  {{ HTML::script('metronic/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}
  {{ HTML::script('metronic/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}
  {{ HTML::script('metronic/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}
  {{ HTML::script('metronic/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}
  {{ HTML::script('metronic/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}
  {{ HTML::script('metronic/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}
  {{ HTML::script('metronic/flot/jquery.flot.js') }}
  {{ HTML::script('metronic/flot/jquery.flot.resize.js') }}
  {{ HTML::script('metronic/gritter/js/jquery.gritter.js') }}
  {{ HTML::script('metronic/uniform/jquery.uniform.min.js') }}
  {{ HTML::script('metronic/bootstrap-daterangepicker/date.js') }}
  {{ HTML::script('metronic/bootstrap-daterangepicker/daterangepicker.js') }}
  {{ HTML::script('metronic/js/app.js') }}
   
  <script>
    jQuery(document).ready(function() {   
      App.setPage("index");  // set current page
      App.init(); // init the rest of plugins and elements
    });
  </script>


</body>
</html>
