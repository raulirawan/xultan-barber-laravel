<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{ route('barber.dashboard') }}" class="{{ (request()->is('barber')) ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="{{ route('barber.booking') }}" class="{{ (request()->is('barber/booking*')) ? 'active' : '' }}"><i class="lnr lnr-database"></i> <span>Booking</span></a></li>

                <li>  <a class="waves-effect" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="lnr lnr-exit" aria-hidden="true"></i>Logout</a></li>
                {{-- <li>
                    <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Pages</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse ">
                        <ul class="nav">
                            <li><a href="page-profile.html" class="">Profile</a></li>
                            <li><a href="page-login.html" class="">Login</a></li>
                            <li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
                        </ul>
                    </div>
                </li> --}}
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </ul>
        </nav>
    </div>
</div>