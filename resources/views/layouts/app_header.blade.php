<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="">
                <b>
                    <img src="{{ asset('images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                    <img src="{{ asset('images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
                </b>
                <span>
                    <img src="{{ asset('images/logo-text.png') }}" alt="homepage" class="dark-logo" /> 
                    <img src="{{ asset('images/logo-light-text.png') }}" alt="homepage" class="light-logo" />
                </span>
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto mt-md-0 ">
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>      
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-settings text-white"></i></a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <ul class="dropdown-user">
                            <li><a href="{{ route('profile') }}"><i class="ti-user"></i> โปรไฟล์</a></li>
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();"
                                   >
                                    <i class="fa fa-power-off"></i>
                                    ล็อกเอ้า
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>