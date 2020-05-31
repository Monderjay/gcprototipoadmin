@extends('layouts.app')
@section('page-title',$news->title)
@section('page-author',$news->user->username)
@section('page-description',$news->introduction)
@section('page-image','https://www.gamecore.com.mx'.$news->news_image_featured)
@section('url','https://www.gamecore.com.mx/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)

@section('content')
    <div class="float-left col-12 news-item-container">

        <div class="container">
            <div class="row">
                <div class="col-lg-8 blog-main">
                    <div class="blog-header">

                            <h1 class="blog-title">{{$news->title}}</h1>
                            {{--<p class="lead blog-description">Subtitulo o frase</p>--}}

                    </div>

                    <div class="blog-post">
                        <p class="blog-post-meta">{{$news->date}} por<a href="{{url('/author/'.$news->user->username)}}"> {{$news->user->username}} </p>

                        <div class="col-12 mb-2 p-0 text-left align-self-center row">
                            {{--<div class="fb-share-button" data-href="{{url('https://www.gamecore.com.mx/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}"
                                 data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a>
                            </div>--}}
                            <div class="col-auto pr-0 pl-1"><a href="{{url('https://www.gamecore.com.mx/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}" class="twitter-share-button" data-size="large" data-show-count="false">Tweet</a></div>
                            <div class="col-auto fb-like pl-1" data-href="{{url('https://www.gamecore.com.mx/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
                        </div>

                        <p class="text-justify">{{$news->introduction}}</p>
                        <ins class="adsbygoogle"
                             style="display:block; text-align:center;"
                             data-ad-layout="in-article"
                             data-ad-format="fluid"
                             data-ad-client="ca-pub-5455720448748407"
                             data-ad-slot="9935506361"></ins>
                        <hr>
                        <img src="{{$news->news_image_featured}}" class="img-thumbnail" alt="Responsive image">
                        <hr>

                        {!!$news->description!!}
                        <hr>

                        @if($news->calification != null)
                            <div class="col-12 mt-4 mb-5 calification-content text-right">
                                <li class="row  justify-content-center text-sm-right text-center">
                                    <label class="col align-self-center"><h1>Puntuación</h1></label>
                                    <input type="text" name="calification" value="{{$news->calification}}" class="show-calification">
                                </li>
                            </div>
                        @endif
                    </div><!-- /.blog-post -->

                </div><!-- /.blog-main -->


                <!-- BARRA LATERAL -->

                <div class="col-lg-3 offset-sm-1 blog-sidebar">
                    @if($news->about!= null)
                        <div class="sidebar-module sidebar-module-inset">
                            <h4>Acerca de</h4>
                            <p class="text-justify">{{$news->about}}</p>
                        </div>
                    @endif
                    @if(count($related) > 0)
                        <div class="sidebar-module">
                            <h4>Relacionados</h4>
                            <ul class="list-group list-related mb-3">
                                @foreach($related as $item)
                                    <li class="list-group-item d-flex justify-content-start align-items-center ">
                                        <img src="{{$item->news_image_featured}}" class="img-fluid" alt="{{$item->title}}">
                                        <a class="text-justify" href="{{url('/news/'.$item->category->name.'/'.$item->clasification->name.'/'.$item->id)}}">
                                            {{$item->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div><!-- /.blog-sidebar -->


            </div><!-- /.row -->
            <div class="col-12 mb-2 p-0 text-left align-self-center row">
                {{--<div class="fb-share-button" data-href="{{url('https://www.gamecore.com.mx/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}"
                     data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a>
                </div>--}}
                <div class="col-auto pr-0 pl-1"><a href="{{url('https://www.gamecore.com.mx/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}" class="twitter-share-button" data-size="large" data-show-count="false">Tweet</a></div>
                <div class="col-auto fb-like pl-1" data-href="{{url('https://www.gamecore.com.mx/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
            </div>

            <div class="fb-comments mb-2" data-mobile="Auto-detected" data-href="{{url('https://www.gamecore.com.mx/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}" data-numposts="10" data-width="100%"></div>

        </div><!-- /.container -->

    </div>

    @include('includes.footer')
@endsection
