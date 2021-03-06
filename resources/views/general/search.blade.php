@extends('layouts.app')
@section('title',config('app.name').' | Resultados')
@section('page-title', ' | Resultados')

@section('content')

    <!--section-->
    <div class="container col-11" style="margin-top: 90px">
        <!-- Large Baner Aside -->
        <ins class="adsbygoogle mt-1 mb-3"
             style="display:block"
             data-ad-client="ca-pub-5455720448748407"
             data-ad-slot="3643829092"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

        <div class="row">
            <div class="col-12 p-0">

                <div class="col-12 row p-0 ml-auto mr-auto mt-1  mb-4">
                    @if(count($news)>0)
                        @foreach($news as $item)
                            <div class="col-12 col-md-4 pl-0 pr-0 pl-md-2 pr-md-2 mb-4">
                                <!-- Card Light -->
                                <div class="card" style="min-height: 520px">
                                    <!-- Card image -->
                                    <div class="view overlay view zoom">
                                        <img class="w-100" src="{{$item->news_image_featured}}" srcset="{{$item->news_image_featured_small}} 400w ,{{$item->news_image_featured_medium}} 1280w" Loading="lazy">
                                        <a href="{{$item->slug}}">
                                            <div class="mask flex-center waves-effect rgba-black-light">

                                            </div>
                                        </a>
                                    </div>
                                    <!-- Card content -->
                                    <div class="card-body elegant-color white-text rounded-bottom">
                                        <!-- Title -->
                                        <h4 class="card-title text-center">{{$item->news_title}}</h4>
                                        <div class="row">
                                            <div class="col-6 text-left">
                                                <a href="{{url('/autor/'.$item->user->username)}}" class="white-text links"><small><i class="fas fa-user-tie"></i>&nbsp; {{$item->user->username}}</small></a>
                                            </div>
                                            <div class="col-6 text-right">
                                                <small><i class="fas fa-calendar-alt"></i>&nbsp; {{substr($item->date,0,10)}} </small>
                                            </div>
                                        </div>
                                        <hr class="hr-light">
                                        <!-- Text -->
                                        <p class="card-text text-justify white-text">{{$item->news_introduction}}</p>
                                        <!-- Link -->

                                        <div class="row col-11 p-0 ml-auto mr-auto mb-2 position-absolute" style="bottom: 12px">
                                            <div class="col-auto text-left justify-content-start p-0">
                                                <!--Facebook-->
                                                <a href="{{url('https://www.facebook.com/sharer/sharer.php?u=https://www.gamecore.com.mx/'.$item->slug)}}" target="_blank" type="button" class="btn btn-fb py-lg-2 px-lg-3 py-1 px-2 m-0 fb-share" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                                            </div>
                                            <div class="col-auto p-0">
                                                <!--Twitter-->
                                                <a href="{{url('http://twitter.com/share?text=@GameCore Informa&url=https://www.gamecore.com.mx/'.$item->slug.'&hashtags=GameCore')}}" target="_blank" type="button" class="btn btn-tw py-lg-2 px-lg-3 py-1 px-2 my-0 mx-1 fb-share" style="background: #55acee;"><i class="fab fa-twitter"></i></a>
                                            </div>
                                            <div class="col-auto my-auto mr-0 ml-auto text-right">
                                                <a href="{{$item->slug}}" class="white-text d-flex justify-content-end links">
                                                    <h5 class="mt-auto mb-auto ml-0 mr-0">Leer Más <i class="fas fa-angle-double-right"></i></h5>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <!-- Card Light -->
                            </div>
                        @endforeach
                    @else
                        <div></div>
                        <h1 class="alert-danger m-auto"><strong>No se encontraron resultados :(</strong></h1>
                    @endif
                </div>

            </div>

            <nav aria-label="Page navigation example" class="m-auto">
                <ul class="pagination pagination-circle pg-blue">
                    {{$news->links()}}
                </ul>
            </nav>

        </div>

    </div>

@endsection
