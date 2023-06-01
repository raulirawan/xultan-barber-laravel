<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{ route('admin-dashboard') }}" class="{{ (request()->is('admin')) ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="{{ route('user.index') }}" class="{{ (request()->is('admin/user*')) ? 'active' : '' }}"><i class="lnr lnr-user"></i> <span>User</span></a></li>
                <li><a href="{{ route('gallery.index') }}" class="{{ (request()->is('admin/gallery*')) ? 'active' : '' }}"><i class="lnr lnr-picture"></i> <span>Gallery</span></a></li>
                <li><a href="{{ route('booking.index') }}" class="{{ (request()->is('admin/booking*')) ? 'active' : '' }}"><i class="lnr lnr-database"></i> <span>Booking</span></a></li>
                <li><a href="{{ route('message.index') }}" class="{{ (request()->is('admin/message*')) ? 'active' : '' }}"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
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