@extends('layouts.app')
@section('title', 'Bienvenido a '.config('app.name'))


@section('content')

    <div class="cover-author-content ">
        <img class="" src="{{$author->cover_image_url}}">
    </div>

    <div class="card card-body card-info-container ml-auto mr-auto p-0 col-12 mb-5 justify-content-center">
        <div class="card card-body ml-auto mr-auto col-11 mb-5">
        <div class="row">
            <div class="col-12 col-xl-2 text-center img-author-info">
                <img class="col-6 col-md-4 col-xl-12" src="{{$author->porfile_image_url}}">
            </div>

            <div class="col-10 mt-2 mt-xl-0 text-justify text-secondary ml-auto mr-auto p-2">
                <i class="fas fa-user"></i> Autor: {{$author->username}}<br>
                <i class="fas fa-address-card"></i> Puesto: {{$author->role->name}}<br>
                @if($author->description)
                    <i class="fas fa-pen"></i> Descripción:{{ $author->description }}<br>
                @endif
                <i class="fas fa-newspaper"></i> Artículos Publicados: {{$totalNews}}<br>

            </div>
        </div>
        <div class="text-center mt-3 text-secondary">
            <h3><b>Articulos Publicados <i class="fas fa-newspaper"></i></b></b></h3>
        </div>
        <div class="row mt-1">
            <div class="col-sm text-center">
                <ul class="list-group list-news-author m-auto">
                    @foreach($collection1 as $article)
                        <li class="list-group-item d-flex justify-content-start align-items-center">
                            <img src="{{$article->news_image_featured}}" class="img-fluid" alt="{{$article->title}}">
                            <a class="text-justify" href="{{url('/news/'.$article->category->name.'/'.$article->clasification->name.'/'.$article->id)}}">
                                {{$article->title}}<br>
                                <small>{{$article->updated_at}}</small>
                            </a>
                            @if($article->calification > 0)
                                <div class="col text-right p-0">
                                    @if($article->calification < 50)
                                        <div class="calification-author ml-2"><input type="text" value="{{$article->calification}}" class="dial" data-fgColor="#ed4757"></div>
                                    @elseif($article->calification < 80)
                                        <div class="calification-author ml-2"><input type="text" value="{{$article->calification}}" class="dial" data-fgColor="#fdc51b"></div>
                                    @else
                                        <div class="calification-author ml-2"><input type="text" value="{{$article->calification}}" class="dial" data-fgColor="#87ceeb"></div>
                                    @endif
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            @if($collection2->count() > 0)
                <div class="col-sm mt-3 mt-xl-0 text-center">
                    <ul class="list-group list-news-author m-auto">
                        @foreach($collection2 as $article)
                            <li class="list-group-item d-flex justify-content-start align-items-center">
                                <img src="{{$article->news_image_featured}}" class="img-fluid" alt="{{$article->title}}">
                                <a class="text-justify" href="{{url('/news/'.$article->category->name.'/'.$article->clasification->name.'/'.$article->id)}}">
                                    {{$article->title}}<br>
                                    <small>{{$article->updated_at}}</small>
                                </a>
                                @if($article->calification > 0)
                                    <div class="col text-right p-0">
                                        @if($article->calification < 50)
                                            <div class="calification-author ml-2"><input type="text" value="{{$article->calification}}" class="dial" data-fgColor="#ed4757"></div>
                                        @elseif($article->calification < 80)
                                            <div class="calification-author ml-2"><input type="text" value="{{$article->calification}}" class="dial" data-fgColor="#fdc51b"></div>
                                        @else
                                            <div class="calification-author ml-2"><input type="text" value="{{$article->calification}}" class="dial" data-fgColor="#87ceeb"></div>
                                        @endif
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>

        <nav class="mt-4 mb-0 col-12" aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{$news->links()}}
            </ul>
        </nav>

    </div>
    </div>

    @include('includes.footer')
@endsection
