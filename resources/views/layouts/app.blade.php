{{--@include('cookieConsent::index')--}}
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- General Tags -->
    <title>@yield('title',config('app.name'))</title>
    <meta name="tittle" content="GameCore | @yield('page-title')">
    <meta name="description" content="@yield('page-description','Entérate de las más recientes novedades sobre el mundo de los Videojuegos con nuestras noticias, reseñas, podcast, especiales y mucho más. ¡Solo en GameCore!')"/>
    <meta name="author" content="@yield('page-author','Eduardo Chávez (pank9605)')" />
    <meta name="keywords" content="@yield('keywords','game, core, gamers, playstation, xbox, nintendo,pc, móvil, videojuegos, noticas, reseñas')"/>
    <meta name="copyright" content="GameCore"/>

    <!-- Icono -->
    <link rel="shortcut icon" href="{{asset('img/coreblack.webp')}}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{mix('css/app.css')}}" async>
    {{--<link rel="stylesheet" href="{{ asset('css/app-styles.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}" async>

    <!--Google -->
    <meta name="google-site-verification" content="ZPwFaoBJbJDZczfpo4Nlj52IXf40sJlsg3QSoyngE-A">

    <!-- Facebook API-->
    <meta property="og:title" content="@yield('page-title','GameCore')" />
    <meta property="og:description" content="@yield('page-description','Entérate de las más recientes novedades sobre el mundo de los Videojuegos con nuestras noticias, reseñas, podcast, unboxings, especiales y mucho más. ¡Solo en Game-Core!')" />
    <meta property="og:image" content="@yield('page-image','https://www.gamecore.com.mx/img/core.webp')" />
    <meta property="og:url" content="@yield('url','https://www.gamecore.com.mx/')" />
    <meta property="fb:app_id" content="278534710203686" />
    <meta property="og:type" content="article" />


    <!-- Google-->
    <script data-ad-client="ca-pub-5455720448748407" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>


</head>

<body class="p-0 m-auto">

{{--<script type="text/javascript" defer>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '278534710203686',
            xfbml      : true,
            version    : 'v7.0'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>--}}

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId            : '278534710203686',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v7.0'
        });
    };
</script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>


<div id="app" class="m-auto" style="max-width: 1380px;">
    <!-- Start your project here-->

        <!--Main Navigation-->
        <header>
                <nav class="navbar m-auto fixed-top navbar-expand-lg navbar-dark menu-container" id="menu" style="background-color: rgba(0, 0, 0, 0.7); z-index: 9999;">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img id="logo" src="{{asset('img/corewhite.png')}}" height="40" alt="GameCore">
                        <b>GameCore</b>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav m-xl-auto col-9 justify-content-xl-center">
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}"><i class="fas fa-home"></i> INICIO <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-list"></i> CATEGORIAS
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($categories as $category)
                                        <a class="dropdown-item" href="{{url($category->name)}}"><i class="{{$category->icon}}"></i>
                                            {{$category->name}}</a>
                                    @endforeach
                                </div>
                            </li>
                            @foreach($clasifications as $clasification)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url($clasification->name)}}"><i class="{{$clasification->icon}}"></i> {{$clasification->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="navbar-nav nav-flex-icons mr-3">
                            <li class="nav-item">
                                <a href="https://www.facebook.com/GameCore.com.mx/" target="_blank" class="nav-link"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="https://twitter.com/GameCoreOficial" target="_blank" class="nav-link"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.instagram.com/GameCore.com.mx/" target="_blank" class="nav-link"><i class="fab fa-instagram"></i></a>
                            </li>
                        </ul>

                        <form method="POST" action="{{url('/Resultados')}}" class="form-inline">
                            @csrf
                            <div class="md-form my-0">
                                <input class="form-control mr-sm-2" type="text" name="search" placeholder="Buscar..." aria-label="Search">
                            </div>
                        </form>

                    </div>
                </nav>

        </header>
        <!--Main Navigation-->

        <!--Main Layout-->
        <main style="overflow-x:hidden;">

            @yield('content')

        </main>

        <!--Main Layout-->
    </div>

@include('includes.footer')



<!-- Scripts -->
<script type="text/javascript" src="{{ mix('js/app.js') }}" defer></script>

{{--<script type="text/javascript" src="{{asset('js/lazysizes/lazysizes.min.js')}}" defer></script>--}}




<!-- Facebook -->
<script crossorigin="anonymous" async src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v7.0&appId=260127125344466&autoLogAppEvents=1"></script>

</body>
</html>
