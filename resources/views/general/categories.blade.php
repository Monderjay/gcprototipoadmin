@extends('layouts.app')
@section('title', 'Bienvenido a '.config('app.name'))


@section('content')


    <!--section-->
    <div class="row principal-container padding-top">

        <div class="mt-5 col-12 col-xl-9 p-0">

            <div class="carousel-container">
                <div id="carousel2" class="carousel slide slider-border carousel-width ml-auto mr-auto ml-xl-0 mr-xl-0" data-ride="carousel">
                    <div id="carousel2" class="carousel slide" data-ride="carousel2">
                        <ol class="carousel-indicators my-0">
                            @for($i=0; $i < $sectionFeatured->count(); $i++)
                                @if($i==0)
                                    <li data-target="#carousel2" data-slide-to="{{$i}}" class="active"></li>
                                @else
                                    <li data-target="#carousel2" data-slide-to="{{$i}}"></li>
                                @endif
                            @endfor
                        </ol>
                        <div class="carousel-inner">
                            @foreach($sectionFeatured as $key=>$item)
                                {{$active=""}}
                                @if($key ==0)
                                    {{$active= "active"}}
                                @endif
                                <div class="carousel-item carousel-item-principal {{$active}}">
                                    <a href="{{url('/news/'.$item->category->name.'/'.$item->clasification->name.'/'.$item->id)}}">
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
            </div>

            <div class="news-container-general mt-xl-5 mt-4">
                @foreach($news as $item)
                    <div class="row news-container mt-4">
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
                                            <small>{{--<a href="{{url('/author/'.$item->user->id)}}">{{$item->user->username}} </a>--}}{{$item->user->username}} <i class="fas fa-user-tie"></i></small>
                                        </li>
                                        <li>
                                            <small>{{substr($item->date,0,10)}} <i class="fas fa-calendar-alt"></i></small> |  <small>
                                                {{substr($item->date,11,8)}} <i class="fas fa-clock"></i>
                                            </small>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 text-center align-self-center">
                                    <a href="{{url('/news/'.$item->category->name.'/'.$item->clasification->name.'/'.$item->id)}}" class="btn btn-primary col-12 col-xl-8 readnews">Leer <i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
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
