@extends('layouts.app')
@section('title',$news->title)
@section('page-title',$news->title)
@section('page-author',$news->user->name .' '. $news->user->first_name .' ('.$news->user->username.')')
@section('page-description',$news->introduction)
@section('page-image','https://www.gamecore.com.mx/'.$news->news_image_featured)
@section('url','https://www.gamecore.com.mx/'.$news->slug)


@section('content')

    <div class="container col-11 text-justify" style="margin-top: 90px; font-family: Helvetica">
        <div class="row">
            <div class="col-12 col-xl-9 mr-0 mb-3" style="font-size: 18px;">

                <div class="col-12 row p-0 ml-auto mr-auto mt-4 mb-0">

                    <h2 class="font-weight-bold col-12 p-0">{{$news->title}}</h2>

                    <div class="mt-1">{{substr($news->date,0,10)}} Por: <a class="mr-1" href="{{url('/autor/'.$news->user->username)}}">{{$news->user->username}}</a></div>

                    <div class="mt-3 col-12 p-0 row text-center mt-3 text-sm-left mx-auto">

                        <div class="col-12 col-sm py-2 px-0">
                            <!--Facebook-->
                            <a href="{{url('https://www.facebook.com/sharer/sharer.php?u=https://www.gamecore.com.mx/'.$news->slug)}}" target="_blank" type="button" class="btn btn-fb fb-share elegant-color white-text m-auto"><i class="fab fa-facebook-f"></i> Facebook</a>

                            <!--Twitter-->
                            <a href="{{url('http://twitter.com/share?text=@GameCore Informa&url=https://www.gamecore.com.mx/'.$news->slug.'&hashtags=GameCore,videojuegos,noticias,consolas,entretenimiento')}}" target="_blank" type="button" class="btn btn-tw elegant-color white-text mx-auto my-3 my-xl-0 fb-share"><i class="fab fa-twitter pr-1"></i> Twitter</a>
                        </div>

                        <div class="col-auto text-right p-0 m-auto">
                            <div class="fb-like m-auto" data-href="{{url('https://www.gamecore.com.mx/'.$news->slug)}}" data-width="" data-layout="box_count" data-action="like" data-size="large" data-share="false"></div>
                        </div>

                    </div>

                    <div class="col-12 p-0 mt-3">
                        {{$news->introduction}}
                        <hr class="hr-dark">
                    </div>

                    <!-- In news 1 -->
                    <ins class="adsbygoogle m-auto"
                         style="display:inline-block;width:100%;height:250px"
                         data-ad-client="ca-pub-5455720448748407"
                         data-ad-slot="8648743762"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>

                    <div class="mt-2">
                        <img class="img-thumbnail" src="{{$news->news_image_featured}}" width="100%" alt="{{$news->title}}">
                        <hr class="hr-dark">
                    </div>

                    <div class="mt-2">
                        {!! $news->description !!}
                        <hr class="hr-dark">
                    </div>

                    <!-- In news 1 -->
                    <ins class="adsbygoogle m-auto"
                         style="display:inline-block;width:100%;height:250px"
                         data-ad-client="ca-pub-5455720448748407"
                         data-ad-slot="8648743762"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>

                    @if($news->calification != null)
                        <div class="col-12 mt-4 mb-5 calification-content text-right">
                            <li class="row  justify-content-center text-sm-right text-center">
                                <label class="col align-self-center"><h1>Puntuación</h1></label>
                                <input type="text" name="calification" value="{{$news->calification}}" class="show-calification">
                            </li>
                        </div>
                    @endif

                    <div class="mt-2 mb-2">
                        @if($news->font)
                            Fuente: {{$news->font}}
                        @endif
                    </div>

                </div>
                <div class="fb-comments" data-href="{{url('https://www.gamecore.com.mx/'.$news->slug)}}" data-numposts="100" data-width="100%" data-colorscheme="dark"></div>
            </div>


            <div class="col-12 col-xl-3 mb-4 text-center">

                <div class="pt-4 text-justify" style="font-size: 18px">
                    <strong><p>{{$news->about}}</p></strong>
                </div>

                <!-- Large Baner Aside -->
                <ins class="adsbygoogle my-2"
                     style="display:block"
                     data-ad-client="ca-pub-5455720448748407"
                     data-ad-slot="3643829092"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>

                @if(count($related)>0)
                    <div class="pt-4 pb-4 elegant-color">
                        <div class="title white-text text-center mb-3"><h4><i class="fas fa-object-ungroup"></i> Relacionados</h4></div>
                        <ul class="list-group list-group-flush aside-list">
                            @foreach($related as $item)
                                <li class="list-group-item d-flex justify-content-start align-items-center elegant-color border-light">
                                    <div class="rounded-circle col-auto image-list" style="background-image: url('{{$item->news_image_featured_small}}');"></div>
                                    <div class="mr-2 ml-2 text-left"><a href="{{$item->slug}}" class="white-text links"><div>{{$item->title}}</div></a></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <!-- Large Baner Aside -->
                <ins class="adsbygoogle mt-2 "
                     style="display:block"
                     data-ad-client="ca-pub-5455720448748407"
                     data-ad-slot="3643829092"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>

            </div>
        </div>

    </div>

@endsection
