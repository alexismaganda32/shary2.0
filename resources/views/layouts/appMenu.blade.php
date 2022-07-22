
<nav id="mainnav-container">
    <div id="mainnav">

        <!--Menu-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <!--Profile Widget-->
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap">
                            <div class="pad-btm">
                                <a href="{{ url('/') }}" class="box-block">
                                    <p class="mnp-name">{{ Auth::user()->name.' '.Auth::user()->surname }}</p>
                                    <span class="mnp-desc">{{ App\Role::find(Auth::user()->role_id)->name }}</span>
                                </a>
                                <img class="img-circle img-sm img-border" src="{{ asset('images/user-default.png') }}" alt="Profile">
                            </div>
                        </div>
                    </div>

                    <!--Shortcut buttons-->
                    <div id="mainnav-shortcut">
                        <ul class="list-unstyled">
                            <li class="col-xs-4">
                                <a class="shortcut-grid" href="{{ route('profile') }}" data-container="body" data-toggle="popover" data-placement="bottom" data-content="PERFIL">
                                    <i class="fas fa-user-cog"></i>
                                </a>
                            </li>
                            <li class="col-xs-4">
                                <a class="shortcut-grid" href="{{ url('/') }}" data-container="body" data-toggle="popover" data-placement="bottom" data-content="INICIO">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="col-xs-4">
                                <a class="shortcut-grid" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-container="body" data-toggle="popover" data-placement="bottom" data-content="CERRAR SESIÓN">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!--End shortcut buttons-->
                    
                    <!--List Menu-->
                    <ul id="mainnav-menu" class="list-group">
                        <li class="list-header" style="padding-left: 20px; padding-bottom: 10px;">
                            <i class="fa fa-list-ul" style="padding-right: 0px"></i>
                            Menú De Navegación
                        </li>

                        @foreach($menus as $menu)
                            @if (isset($menu['submenus']))
                            <li>
                                <a href="#">
                                    <i class="{{ $menu['icon'] }}"></i>
                                    <span class="menu-title"><strong>{{ $menu['name'] }}</strong></span>
                                    <i class="arrow"></i>
                                </a>
                                <ul class="collapse">
                                @foreach($menu['submenus'] as $submenu)
                                    @if (isset($submenu['submenu']))
                                    <li>
                                        <a href="#">{{ $submenu['name'] }}<i class="arrow"></i></a>
                                        <ul class="collapse">
                                            @foreach ($submenu['submenu'] as $sm)
                                                <li id="{{ $sm['path'] }}">
                                                    <a href="{{ route(''.$sm['path'].'.index') }}">{{ $sm['name'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @else
                                    <li id="{{ $submenu['path'] }}">
                                        <a href="{{ route(''.$submenu['path'].'.index') }}">{{ $submenu['name'] }}</a>
                                    </li>
                                    @endif
                                @endforeach
                                </ul>
                            </li>
                            @else
                            <li id="{{ $menu['path'] }}">
                                <a href="{{ route(''.$menu['path'].'.index') }}">
                                    <i class="{{ $menu['icon'] }}"></i>
                                    <span class="menu-title"><strong>{{ $menu['name'] }}</strong></span>
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                    <!--End List Menu-->
                    
                </div>
            </div>
        </div>
        <!--End menu-->
        
    </div>
</nav>