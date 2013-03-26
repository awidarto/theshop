@section('sidenav')

        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar nav-collapse collapse">
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <div class="slide hide">
                <i class="icon-angle-left"></i>
            </div>
            <form class="sidebar-search" />
                <div class="input-box">
                    <input type="text" class="" placeholder="Search" />
                    <input type="button" class="submit" value=" " />
                </div>
            </form>
            <div class="clearfix"></div>
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
            <!-- BEGIN SIDEBAR MENU -->
            <ul>
                <li class="active">
                    <a href="index.html">
                    <i class="icon-home"></i> Dashboard
                    <span class="selected"></span>
                    </a>                    
                </li>
                <li class="has-sub">
                    <a href="javascript:;" class="">
                    <i class="icon-bookmark-empty"></i> UI Features
                    <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="ui_general.html">General</a></li>
                        <li><a class="" href="ui_buttons.html">Buttons</a></li>
                        <li><a class="" href="ui_tabs_accordions.html">Tabs & Accordions</a></li>
                        <li><a class="" href="ui_typography.html">Typography</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;" class="">
                    <i class="icon-table"></i> Form Stuff
                    <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="form_layout.html">Form Layouts</a></li>
                        <li><a class="" href="form_component.html">Form Components</a></li>
                        <li><a class="" href="form_wizard.html">Form Wizard</a></li>
                        <li><a class="" href="form_validation.html">Form Validation</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;" class="">
                    <i class="icon-th-list"></i> Data Tables
                    <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="table_basic.html">Basic Tables</a></li>
                        <li><a class="" href="table_managed.html">Managed Tables</a></li>
                    </ul>
                </li>
                <li><a class="" href="grids.html"><i class="icon-th"></i> Grids & Portlets</a></li>
                <li class="has-sub">
                    <a href="javascript:;" class="">
                    <i class="icon-map-marker"></i> Maps
                    <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="maps_google.html">Google Maps</a></li>
                        <li><a class="" href="maps_vector.html">Vector Maps</a></li>
                    </ul>
                </li>
                <li><a class="" href="charts.html"><i class="icon-bar-chart"></i> Visual Charts</a></li>
                <li><a class="" href="calendar.html"><i class="icon-calendar"></i> Calendar</a></li>
                <li><a class="" href="gallery.html"><i class="icon-camera"></i> Gallery</a></li>
                <li class="has-sub">
                    <a href="javascript:;" class="">
                    <i class="icon-briefcase"></i> Extra
                    <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="extra_pricing_table.html">Pricing Tables</a></li>
                        <li><a class="" href="extra_404.html">404 Page</a></li>
                        <li><a class="" href="extra_500.html">500 Page</a></li>
                        <li><a class="" href="extra_blank.html">Blank Page</a></li>
                    </ul>
                </li>
                <li><a class="" href="login.html"><i class="icon-user"></i> Login Page</a></li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
@endsection