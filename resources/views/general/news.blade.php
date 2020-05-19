@extends('layouts.app')
@section('page-title',$news->title)
@section('page-description',$news->introduction)
@section('page-image','http://www.gcgamecore.com'.$news->news_image_featured)
@section('url','http://www.gcgamecore.com/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)

@section('content')
    <div class="float-left col-12 news-item-container">
        <div class="blog-header">
            <div class="container">
                <h1 class="blog-title">{{$news->title}}</h1>
                {{--<p class="lead blog-description">Subtitulo o frase</p>--}}
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 blog-main">

                    <div class="blog-post">
                        <p class="blog-post-meta">{{$news->date}} por {{$news->user->username}} </p>

                        <div class="col-12 mb-2 p-0 text-left align-self-center row">
                            {{--<div class="fb-share-button" data-href="{{url('http://www.gcgamecore.com/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}"
                                 data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a>
                            </div>--}}
                            <div class="col-auto pr-0"><a href="{{url('http://www.gcgamecore.com/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}" class="twitter-share-button" data-size="large" data-show-count="false">Tweet</a></div>
                            <div class="col-auto fb-like pl-1" data-href="{{url('http://www.gcgamecore.com/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
                        </div>

                        <p>{{$news->introduction}}</p>
                        <!-- Baner -->
                        {{--<ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-5455720448748407"
                             data-ad-slot="8013864695"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>--}}
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
                            <ol class="list-unstyled">
                                @foreach($related as $item)
                                    <li><a href="{{url('news/'.$item->category->name.'/'.$item->clasification->name.'/'.$item->id)}}">{{$item->title}}</a></li>
                                @endforeach
                            </ol>
                        </div>
                    @endif
                    <div class="sidebar-module">

                        <h4>Elsewhere</h4>
                        <ol class="list-unstyled">
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Facebook</a></li>
                        </ol>
                    </div>
                    <!-- Aside Large -->
                    {{--<ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-5455720448748407"
                         data-ad-slot="6357647029"
                         data-ad-format="auto"
                         data-full-width-responsive="true"></ins>--}}
                </div><!-- /.blog-sidebar -->


            </div><!-- /.row -->
            <div class="col-12 mb-2 p-0 text-left align-self-center row">
                {{--<div class="fb-share-button" data-href="{{url('http://www.gcgamecore.com/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}"
                     data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a>
                </div>--}}
                <div class="col-auto pr-0"><a href="{{url('http://www.gcgamecore.com/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}" class="twitter-share-button" data-size="large" data-show-count="false">Tweet</a></div>
                <div class="col-auto fb-like pl-1" data-href="{{url('http://www.gcgamecore.com/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
            </div>

            <div class="fb-comments mb-2" data-mobile="Auto-detected" data-href="{{url('http://www.gcgamecore.com/news/'.$news->category->name.'/'.$news->clasification->name.'/'.$news->id)}}" data-numposts="10" data-width="100%"></div>

        </div><!-- /.container -->

    </div>

    @include('includes.footer')
@endsection
