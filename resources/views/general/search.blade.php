@extends('layouts.app')
@section('title','GameCore | Resultados')
@section('page-title', ' | Resultados')

@section('content')

    <!--section-->
    <div class="row principal-container padding-top">




        <div class="news-container-general padding-top pt-4 row m-auto p-0">
        @if($news->count() > 0)
            @foreach($news as $item)
                <!-- Card Dark -->
                    <div class="card card-container col-11 m-auto col-xl-3 m-xl-4 p-0 ">
                        <!-- Card image -->
                        <div class="view overlay">
                            <img class="card-img-top" src="{{$item->news_image_featured}}"
                                 alt="Card image cap">
                            <a href="{{url($item->slug)}}">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body elegant-color white-text rounded-bottom">

                            <!-- Social shares button -->

                            <!-- Title -->
                            <h4 class="card-title">{{$item->news_title}}</h4>
                            <div class="row">
                                <div class="col-6">
                                    <small><i class="fas fa-user-tie"></i>&nbsp; <a class="text-light" href="{{url('/Autor/'.$item->user->username)}}"> {{$item->user->username}} </a></small>
                                </div>
                                <div class="col-6 text-right">
                                    <small>
                                        <i class="fas fa-calendar-alt"></i>&nbsp; {{substr($item->date,0,10)}} </small>
                                </div>
                            </div>
                            <hr class="hr-light">
                            <!-- Text -->
                            <p class="card-text white-text mb-5 text-justify">{!!$item->news_introduction!!}</p>
                            <!-- Link -->

                            <div class="row social-buttons-container">
                                <div class="col-6 row">
                                    <div class="col-12">
                                        <div class="fb-share-button share-buttons" data-href="{{url('https://www.gamecore.com.mx/'.$item->slug)}}" data-layout="button" data-size="large"><a target="_blank" href="{{url('https://www.gamecore.com.mx/'.$item->slug)}}" class="fb-xfbml-parse-ignore">Compartir</a></div>
                                    </div>
                                </div>

                                <div class="col-6 text-right">
                                    <a href="{{url($item->slug)}}" class="white-text d-flex justify-content-end align-bottom read-more">
                                        <h5 class="m-auto">Leer más <i class="fas fa-angle-double-right"></i></h5>
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- Card Dark -->

                @endforeach
            @else
                <div class="text-center text-danger alert-danger col-11 m-auto m-xl-0">
                    <h2><b>No se encontraron noticias</b></h2>
                </div>
            @endif

        </div>


        <nav class="mt-4 mb-4 col-12" aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{$news->links()}}
            </ul>
        </nav>
    </div>
    @include('includes.footer')
@endsection
