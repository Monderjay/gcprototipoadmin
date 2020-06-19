@extends('layouts.app')
@section('title',$news->title.' | '.config('app.name'))
@section('page-title',$news->title)
@section('page-author',$news->user->username)
@section('page-description',$news->introduction)
@section('page-image','https://www.gamecore.com.mx/'.$news->news_image_featured)
@section('url','https://www.gamecore.com.mx/'.$news->slug)

@section('content')

    <div class="container col-11 col-xl-10 text-justify" style="margin-top: 90px; font-size: 18px; font-family: Helvetica">
        <div class="row">
            <div class="col-12 col-xl-9 p-0">

                <div class="col-12 row p-0 ml-auto mr-auto mt-4  mb-0">

                    <h2 class="font-weight-bold col-12 p-0">{{$news->title}}</h2>

                    <div class="mt-1">{{substr($news->date,0,10)}} Por: <a class="mr-1" href="{{url('/autor/'.$news->user->username)}}">{{$news->user->username}}</a></div>

                    <div class="mt-3 col-12 p-0 row p-0 text-center text-sm-left">


                        <div class="col-12 col-sm p-2">
                            <!--Facebook-->
                            <a href="{{url('https://www.facebook.com/sharer/sharer.php?u=https://www.gamecore.com.mx/'.$news->slug)}}" target="_blank" type="button" class="btn btn-fb fb-share elegant-color white-text m-auto"><i class="fab fa-facebook-f pr-1"></i> Facebook</a>

                            <!--Twitter-->
                            <a href="{{url('http://twitter.com/share?text=@GameCore Informa&url=https://www.gamecore.com.mx/'.$news->slug.'&hashtags=GameCore,videojuegos,noticias,consolas,entretenimiento')}}" target="_blank" type="button" class="btn btn-tw elegant-color white-text m-auto fb-share"><i class="fab fa-twitter pr-1"></i> Twitter</a>
                        </div>

                        <div class="col-auto text-right p-0 m-auto">
                            <div class="fb-like m-auto" data-href="https://www.facebook.com/GameCore.com.mx/?modal=admin_todo_tour" data-width="" data-layout="box_count" data-action="like" data-size="large" data-share="false"></div>

                        </div>

                    </div>

                    <div class="mt-4">
                        {{$news->introduction}}
                        <hr class="hr-dark">
                    </div>

                    <div class="mt-2">
                        <img class="img-thumbnail" src="{{$news->news_image_featured}}" width="100%" alt="{{$news->title}}">
                        <hr class="hr-dark">
                    </div>

                    <div class="mt-2">
                        {!! $news->description !!}
                        <hr class="hr-dark">
                    </div>

                    <div class="mt-2 mb-2">
                        @if($news->font)
                            Fuente: {{$news->font}}
                        @endif
                    </div>

                </div>
                <div class="fb-comments mb-3" data-href="https://www.facebook.com/GameCore.com.mx/?modal=admin_todo_tour" data-numposts="100" data-width="100%"></div>
            </div>


            <div class="col-12 col-xl-3 pl-0 pl-xl-5 pr-0 pt-0 pb-4">

                <div class="pt-4 text-justify" style="font-size: 18px">
                    <p>{{$news->about}}</p>
                </div>

                @if(count($related)>0)
                    <div class="pt-4 pb-4 elegant-color">
                        <div class="title white-text text-center mb-3"><h4><i class="fas fa-object-ungroup"></i> Relacionados</h4></div>
                        <ul class="list-group list-group-flush aside-list">
                            @foreach($related as $item)
                                <li class="list-group-item d-flex justify-content-start align-items-center elegant-color border-light">
                                    <img src="{{$item->news_image_featured}}" alt="{{$item->title}}">
                                    <div class="mr-2 ml-2 text-left"><a href="{{$item->slug}}" class="white-text links"><div>{{$item->title}}</div></a></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>

    </div>

    @include('includes.footer')
@endsection
