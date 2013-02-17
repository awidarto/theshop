@section('topnav')
<div class="dropdown">
    <a class="header-dropdown dropdown-toggle accent-color" data-toggle="dropdown" href="#">
     Start
     <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
        @if(Auth::user()->role == 'client' || Auth::user()->role == 'principal_vendor' || Auth::user()->role == 'subcon')
            <li>{{ HTML::link('document/type/clients','Clients')}}</li>
            <li>{{ HTML::link('document/type/principal_vendor','Principal / Vendors')}}</li>
            <li>{{ HTML::link('document/type/subcon','3rd Party / Sub-Con')}}</li>
        @else
        @endif


        <li>{{ HTML::link('attendee','Attendees')}}
        
        @if(Auth::user()->role == 'root' || Auth::user()->role == 'super')
            <li>{{ HTML::link('visitor','Visitors')}}</li>
            
            <li>{{ HTML::link('official','Officials')}}</li>

            <li>{{ HTML::link('report','Reports')}}
            <li>{{ HTML::link('import','Import Data')}}
            <li>{{ HTML::link('export','Export Data')}}
            
            <li class="has-dropdown">
              <a href="#">Sys Admin</a>
              <ul class="dropdown">
                <li>{{ HTML::link('content', 'Article Manager' ) }}</li>
                <li>{{ HTML::link('users', 'User Manager' ) }}</li>
              </ul>
            </li>

        @endif
        <li class="divider"></li>
        <li>{{ HTML::link('dashboard', 'Home') }}</li>
        <li>{{ HTML::link('logout', 'Logout') }}</li>
    </ul>


</div>
@endsection

      