@extends('layouts.app')
@section('title', config('app.name'))

@section('content')
    <!--Slider-->
    <div id="carousel1" class="carousel slide carousel1" data-ride="carousel">
        <ol class="carousel-indicators my-0">
            @for($i=0; $i < $featuredNews->count(); $i++)
                @if($i==0)
                    <li data-target="#carousel1" data-slide-to="{{$i}}" class="active"></li>
                @else
                    <li data-target="#carousel1" data-slide-to="{{$i}}"></li>
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
                        <img class="d-block " src="{{$item->news_image_featured}}" alt="First slide">
                        <div class="description-slider">
                            <div class="carousel-caption">
                                <div class="title">{{$item->title}}</div>
                                <p>{{$item->news_introduction}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev carousel1" href="#carousel1" role="button" data-slide="prev">
            <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
            <span aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!--section-->
    <div class="row principal-container p-0">

        <div class="mt-3 col-12 col-xl-9 p-0">

            {{--<div class="row justify-content-center mr-xl-0 ml-xl-0 mb-5 text-center principal-sections">
                <div class="col-12 col-xl-5 mr-xl-auto ml-xl-auto  p-0 m-xl-0">
                    <div class="card card-border">
                        <div class="card-header text-center">
                            <h5><i class="fas fa-newspaper"></i> Ultimas Reseñas</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list">
                                @foreach($reviewSection as $review)
                                    <li class="list-group-item d-flex align-items-center pr-0">
                                        <img src="{{$review->news_image_featured}}" class="img-fluid" alt="{{$review->title}}">
                                        <a href="{{url($review->slug)}}">
                                            {{$review->title}}
                                        </a>
                                        <div class="col text-right p-0">
                                            @if($review->calification < 50)
                                                <div class="calification"><input type="text" value="{{$review->calification}}" class="dial" data-fgColor="#ed4757"></div>
                                            @elseif($review->calification < 80)
                                                <div class="calification"><input type="text" value="{{$review->calification}}" class="dial" data-fgColor="#fdc51b"></div>
                                            @else
                                                <div class="calification"><input type="text" value="{{$review->calification}}" class="dial" data-fgColor="#87ceeb"></div>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5 ml-xl-auto mr-xl-auto p-0 mt-5 mt-xl-0">
                    <div class="card card-border">
                        <div class="card-header text-center">
                            <h5><i class="fas fa-mobile"></i> PC | Movil</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list">
                                @foreach($mobileSection as $mobile)
                                    <li class="list-group-item d-flex justify-content-start align-items-center ">
                                        <img src="{{$mobile->news_image_featured}}" class="img-fluid" alt="{{$mobile->title}}">
                                        <a class="text-justify" href="{{url($mobile->slug)}}">
                                            {{$mobile->mobile_introduction}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel2-section">
                <div id="carousel2" class="carousel slide slider-border carousel-width mr-auto ml-auto mr-xl-0 ml-xl-0" data-ride="carousel">
                    <div id="carousel2" class="carousel slide" data-ride="carousel2">
                        <ol class="carousel-indicators my-0">
                            @for($i=0; $i < $featuredPcMovil->count(); $i++)
                                @if($i==0)
                                    <li data-target="#carousel2" data-slide-to="{{$i}}" class="active"></li>
                                @else
                                    <li data-target="#carousel2" data-slide-to="{{$i}}"></li>
                                @endif
                            @endfor
                        </ol>
                        <div class="carousel-inner">
                            @foreach($featuredPcMovil as $key=>$item)
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
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>--}}

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

