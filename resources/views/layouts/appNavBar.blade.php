
<header id="navbar">
    <div id="navbar-container" class="boxed">

        <!--Brand logo & name-->
        <div class="navbar-header">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('/images/favicon.png') }}" alt="permissionsImg" class="brand-icon">
                <div class="brand-title text-center">
                    <span class="brand-text">Capacitacion</span>
                </div>
            </a>
        </div>
        <!--End brand logo & name-->

        <!--Navbar Dropdown-->
        <div class="navbar-content clearfix">
            <ul class="nav navbar-top-links pull-left">
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-top-links pull-right">
                <!--User dropdown-->
                <li id="dropdown-user" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                        <span class="pull-right">
                            <img class="img-circle img-user media-object" src="{{ asset('/images/favicon.png') }}" alt="Profile">
                        </span>
                        <div class="username hidden-xs">Acceso Rapido</div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">
                        <div class="pad-all bord-btm"></div>
                        <ul class="head-list">
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="fas fa-home"></i> Inicio
                                </a>
                            </li>
                            @if(Auth::user()->id === 1)
                            <li>
                                <a href="{{ route('user.create') }}">
                                    <i class="fas fa-user-plus"></i> Crear Usuario
                                </a>
                            </li>
                            @endif
                        </ul>

                        <!-- Dropdown footer -->
                        <div class="pad-all">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary btn-block">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </a>
                        </div>
                    </div>
                </li>
                <!--End user dropdown-->
            </ul>
        </div>
        <!--End Navbar Dropdown-->

    </div>
</header>
