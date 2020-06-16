@extends('layouts.app')
@section('title', config('app.name'))

@section('content')
    <!--section-->
    <div class="row principal-container padding-top">

        <div class="mt-5 col-12 col-xl-9 p-0">

            <div class="carousel-container">
                <div id="carousel2" class="carousel slide slider-border carousel-width ml-auto mr-auto ml-xl-0 mr-xl-0" data-ride="carousel">
                    <div id="carousel2" class="carousel slide" data-ride="carousel2">
                        <ol class="carousel-indicators my-0">
                            @for($i=0; $i < $featuredNews->count(); $i++)
                                @if($i==0)
                                    <li data-target="#carousel2" data-slide-to="{{$i}}" class="active"></li>
                                @else
                                    <li data-target="#carousel2" data-slide-to="{{$i}}"></li>
                                @endif
                            @endfor
                        </ol>
                        <div class="carousel-inner">
                            @foreach($featuredNews as $key=>$item)
                                {{$active=""}}
                                @if($key ==0)
                                    {{$active= "active"}}
                                @endif
                                <div class="carousel-item carousel-item-principal {{$active}}">
                                    <a href="{{url($item->slug)}}">
                                        <img class="d-block w-100" src="{{$item->news_image_featured}}" alt="First slide">

                                        <div class="carousel-caption">
                                            <div class="title">{{$item->title}}</div>
                                            <p>{{$item->mobile_introduction}}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel2" role="button" data-slide="prev">
                            <i class="fas fa-arrow-circle-left" style="font-size: 30px"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel2" role="button" data-slide="next">
                            <i class="fas fa-arrow-circle-right" style="font-size: 30px"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="news-container-general row col-12 p-0">
            @foreach($news as $item)
                <!-- Card Dark -->
                    <div class="card card-container mr-auto ml-auto mt-4 ">
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


                    {{--<div class="row news-container mt-4">
                        <div class="col-xl-5 align-self-center p-0">
                            <img src="{{$item->news_image_featured}}">
                        </div>
                        <div class="col-xl-7 justify-content-center">
                            <div class="news-title text-center mt-3 mt-xl-2">
                                {{$item->title}}
                            </div>
                            <hr>
                            <div class="news-description text-justify">
                                {!!$item->news_introduction!!}
                            </div>
                            <div class="justify-content-center col-xl-12 row p-0 m-0 mt-3 mb-0">
                                <div class="col-6 news-date p-0">
                                    <ul>
                                        <li class="author">
                                            <small><a href="{{url('/Autor/'.$item->user->username)}}"> {{$item->user->username}} </a> <i class="fas fa-user-tie"></i></small>
                                        </li>
                                        <li>
                                            <small>{{substr($item->date,0,10)}} <i class="fas fa-calendar-alt"></i></small> |  <small>
                                                {{substr($item->date,11,8)}} <i class="fas fa-clock"></i>
                                            </small>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 text-center align-self-center">
                                    <a href="{{url($item->slug)}}" class="btn btn-primary col-12 col-xl-8 readnews">Leer <i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                @endforeach
            </div>


        </div>

        @include('includes.aside')

        <nav class="mt-4 mb-4 col-12" aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{$news->links()}}
            </ul>
        </nav>
    </div>
    @include('includes.footer')
@endsection


