<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('img/coreblack.png')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title',config('app.name'))</title>

    <!-- Scripts -->

    <script src="{{ asset('js/adminFunctions.js') }}" defer></script>
    <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}" defer></script>
    <script src="{{ asset('/js/Knob/js/jquery.knob.js') }}" defer></script>
    <script src="{{ asset('/js/Knob/configStaff.js') }}" defer></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('vendors/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prueba.css') }}" rel="stylesheet">

    <!--Material Kit by Creative Tim-->

    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('material-kit/css/material-kit.css')}}?v=2.0.7" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{{asset('vendors/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('vendors/sweetalert2/dist/sweetalert2.min.css')}}">


</head>
<body class="profile-page sidebar-collapse">

<div id="app">
    <div class="wrapper d-flex align-items-stretch">

        <div id="sidebar-content">
            <div class="fixed-top" id="sidebar">
                <div class="side-header">
                    <div class="img-background-container text-center">
                        <div id="image-degrade"></div>
                        <img class="img-fluid m-auto" src="{{Auth::user()->cover_image_url}}">
                    </div>
                    <div class="user-logo-container p-3">
                        <div class="img-porfile-container">
                            <img class="img-fluid rounded-circle" src="{{Auth::user()->porfile_image_url}}">
                            <div class="right-container">
                                <div class="data-user-right welcome-title">!Bienvenido {{Auth::user()->username}}¡</div>
                                <div class="data-user-right welcome-title">{{Auth::user()->name}} {{Auth::user()->first_name}} {{Auth::user()->last_name}}</div>
                            </div>
                        </div>
                        <div class="role-user mt-3">
                            <div class="data-role">{{Auth::user()->role->name}} <i class="fas fa-user-tie"></i></div>
                            <div class="data-role">{{Auth::user()->email}} <i class="fas fa-envelope-open-text"></i></div>
                        </div>
                    </div>

                    <ul class="list-unstyled components p-2 mb-5">
                        <li>
                            <a href="/home"><i class="fas fa-home"></i> Inicio</a>
                        </li>
                        @if(auth()->user()->role->name == "Fundador")
                            <li>
                                <a href="#logsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-database"></i> Logs</a>
                                <ul class="collapse list-unstyled" id="logsSubmenu">
                                    <li>
                                        <a href="{{url('staff/founder/logs/users')}}"><i class="fas fa-users"></i> Usuarios</a>
                                    </li>
                                    <li>
                                        <a href="{{url('staff/founder/logs/news')}}"><i class="fas fa-archive"></i> Noticias</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#administrateSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-table"></i> Administrar</a>
                                <ul class="collapse list-unstyled" id="administrateSubmenu">
                                    <li>
                                        <a href="{{url('staff/founder')}}"><i class="fas fa-user-tie"></i> Fundadores</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-user"></i> Administradores</a>
                                    </li>
                                    <li>
                                        <a href="{{url('staff/editor')}}"><i class="fas fa-user-edit"></i> Editores</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-pager"></i> Paginas</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu">
                                @if(auth()->user()->role->name == "Fundador" || auth()->user()->role->name == "Administrador" || auth()->user()->role->name == "Editor")
                                <li>
                                    <a href="{{url('staff/news')}}"><i class="fas fa-newspaper"></i> Noticias</a>
                                </li>
                                @endif
                                @if(auth()->user()->role->name == "Fundador" || auth()->user()->role->name == "Administrador")
                                {{--<li>
                                    <a href="#"><i class="fas fa-list"></i> Categorias</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fas fa-tasks"></i> Clasificaciones</a>
                                </li>--}}
                                @endif
                                @if(auth()->user()->role->name == "Fundador")
                                <li>
                                    <a href="#"><i class="fas fa-user-tag"></i> Roles</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fas fa-ad"></i> Ads</a>
                                </li>
                                @endif
                            </ul>
                        </li>

                        <li>
                            <a href="{{url('/porfile/'.Auth::user()->id)}}"><i class="fas fa-user"></i> Perfil</a>
                        </li>

                        <li>
                            <a href="{{url(route('logout'))}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                Cerrar Sesión
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- NavbAr  -->
        <div id="content">


            <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
                <div class="container">
                    <div class="navbar-translate">
                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                            <i class="fa fa-bars"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                        <a class="navbar-brand" href="{{url('/')}}"> GameCore </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="navbar-toggler-icon"></span>
                            <span class="navbar-toggler-icon"></span>
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.creative-tim.com/product/material-kit-pro" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank" data-original-title="Follow us on Twitter" rel="nofollow">
                                    <i class="fas fa-file-excel"></i> Excel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="overlay"></div>
            @yield('img-background')
            <div class="main main-raised">
                <div class="profile-content">
                    <div class="col-12">
                        @yield('porfile-data')
                        @yield('page-description')
                        <div class="tab-content tab-space">
                            <div class="tab-pane active text-center gallery" id="studio">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--   Core JS Files   -->
<script src="{{asset('material-kit/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('material-kit/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('material-kit/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{asset('material-kit/js/plugins/moment.min.js')}}"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="{{asset('material-kit/js/plugins/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{asset('material-kit/js/plugins/nouislider.min.js')}}" type="text/javascript"></script>

<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="{{asset('material-kit/js/material-kit.js')}}?v=2.0.7" type="text/javascript"></script>




</body>
</html>
