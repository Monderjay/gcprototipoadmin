{{--@include('cookieConsent::index')--}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta name="google-site-verification" content="ZPwFaoBJbJDZczfpo4Nlj52IXf40sJlsg3QSoyngE-A">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- General Tags -->
    <title>@yield('title',config('app.name'))</title>
    <meta name="tittle" content="@yield('page-title') | GameCore">
    <meta name="description" content="@yield('page-description','Entérate de las más recientes novedades sobre el mundo de los Videojuegos con nuestras noticias, reseñas, podcast, unboxings, especiales y mucho más. ¡Solo en GameCore!')"/>
    <meta name="keywords" content="game, core, gamers, playstation, xbox, nintendo,
    pc, móvil, videojuegos, noticas, reseñas, podcast, pank9605, unboxings"/>
    <meta name="author" content="@yield('page-author','Eduardo Chávez Zúñiga')" />
    <meta name="copyright" content="Game-Core" />

    <link rel="shortcut icon" href="{{asset('img/coreblack.png')}}">

    <!-- google -->
    <script data-ad-client="ca-pub-5455720448748407" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script type="javascript" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <!-- Facebook -->
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v7.0&appId=260127125344466&autoLogAppEvents=1"></script>

    <!-- twitter -->
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app-styles.css') }}" rel="stylesheet">


    <!-- Facebook -->
    <meta property="og:title" content="@yield('page-title','GameCore')" />
    <meta property="og:description" content="@yield('page-description','Entérate de las más recientes novedades sobre el mundo de los Videojuegos con nuestras noticias, reseñas, podcast, unboxings, especiales y mucho más. ¡Solo en Game-Core!')" />
    <meta property="og:image" content="@yield('page-image','https://www.gamecore.com.mx/img/core.jpg')" />
    <meta property="og:url" content="@yield('url','https://www.gamecore.com.mx/')" />
    <meta property="fb:app_id" content="278534710203686" />
    <meta property="og:type" content="article" />

</head>

<body class="p-0 m-0">

<script>
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
</script>

<div id="app">

    <nav class="navbar navbar-expand-xl navbar-dark position-fixed menu-container" id="menu">
        <a class="navbar-brand" href="{{url('/')}}">
            <img id="logo" src="{{asset('img/corewhite.png')}}" height="40" alt="GameCore">
            <b>GameCore</b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}"><i class="fas fa-home"></i> INICIO <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-list"></i> CATEGORIAS
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($categories as $category)
                            <a class="dropdown-item" href="{{url('/news/'.$category->name)}}"><i class="{{$category->icon}}"></i>
                                {{$category->name}}</a>
                        @endforeach
                    </div>
                </li>
                @foreach($clasifications as $clasification)
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/news/'.$clasification->name)}}"><i class="{{$clasification->icon}}"></i> {{$clasification->name}}</a>
                    </li>
                @endforeach
            </ul>
            <form method="POST" action="{{url('/news/search')}}" class="d-block d-xl-none form-inline has-search">
                @csrf
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control" name="search" placeholder="Buscar...">
            </form>
        </div>

        <form method="POST" action="{{url('/news/search')}}" class="d-none d-xl-block ml-3 form-inline has-search">
            @csrf
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control" name="search" placeholder="Buscar...">
        </form>
    </nav>



    <!--==========================
    Social Section
    ============================-->
    <section id="social">
        <ul>
            <li class="fb wow slideInLeft" data-wow-delay="0s">
                <a href="https://www.facebook.com/GameCore-101570291364601/?modal=admin_todo_tour" target="_blank"><i class="fab fa-facebook fa-sm"></i></a>
            </li>
            <li class="tw wow slideInLeft" data-wow-delay="0.5s">
                <a href="https://twitter.com/GameCor16434918" target="_blank"><i class="fab fa-twitter fa-sm"></i></a>
            </li>
            <li class="ig wow slideInLeft" data-wow-delay="1.5s">
                <a href="https://www.instagram.com/gamecoreoficial/"><i class="fab fa-instagram fa-sm"></i></a>
            </li>
        </ul>
    </section>


    {{--<section id="search">
        <ul>
            <li class="fb wow slideInLeft" data-wow-delay="0s">
                <div class="wrapper justify-content-center text-center">
                    <div class="search-container">
                        <form method="POST" action="">
                            <input type="text" class="input" placeholder="Search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </form>

                    </div>
                </div>
            </li>
        </ul>
    </section>--}}

    @yield('content')

</div>

<!-- Scripts -->
<script type="text/javascript" src="{{ asset('js/app.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/styles.js') }}" ></script>
<script type="text/javascript" src="{{asset('js/Knob/js/jquery.knob.js')}}" ></script>
<script type="text/javascript" src="{{ asset('js/Knob/config.js')}}"></script>
<script type="text/javascript" src="https://www.powr.io/powr.js?platform=jquery"></script>

</body>
</html>
