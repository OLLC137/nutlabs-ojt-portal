<!-- navigation-menu.blade.php -->
    <nav class="flex-row p-0 navbar default-layout-navbar col-lg-12 col-12 fixed-top d-flex">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" id="logocont">
            <a class="logo-long" href="{{ route('dashboard') }}"><p class="logo-text">OJT Portal |<span class="logo-highlight"> BatStateU</span></p></a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img src="{{ url('images/spartan.png') }}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>

            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="{{ url('images/faces/face1.jpg') }}" alt="image">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1"> {{ Auth::user()->name }} </p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        @role(ADM)
                        <a class="dropdown-item" href="{{ route('manage-users') }}"> <x-template.icon class="me-2"> account-multiple </x-template.icon> Manage Users </a>
                        @endrole()
                        <a class="dropdown-item" href="{{ route('profile.show') }}"> <x-template.icon class="me-2"> face </x-template.icon> Profile </a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                        </a>
                        <!-- Hidden logout form -->
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
