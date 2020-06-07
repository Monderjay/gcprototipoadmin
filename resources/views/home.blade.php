@extends('layouts.admin')

@section('img-background')
    <div class="page-header header-filter" data-parallax="true" style="background-image:url({{asset('img/portadaprueba.png')}}); background-position: center"></div>
@endsection

@section('content')


            <div class="row">
                <div class="col-12 col-xl-2 text-center img-author-info">
                    <img class="col-6 col-md-4 col-xl-12" src="{{$user->porfile_image_url}}">
                </div>

                <div class="col-10 mt-2 mt-xl-0 text-justify text-secondary ml-auto mr-auto p-2">
                    <i class="fas fa-user"></i> Bienvenido: {{$user->name}} {{$user->first_name}} {{$user->last_name}}<br>
                    <i class="fas fa-user-circle"></i> Usuario: {{$user->username}}<br>
                    <i class="fas fa-mail-bulk"></i> Correo: {{$user->email}}<br>
                    <i class="fas fa-address-card"></i> Puesto: {{$user->role->name}}<br>
                    @if($user->description)
                        <i class="fas fa-pen"></i> Descripción: {{ $user->description }}<br>
                    @endif
                    <i class="fas fa-newspaper"></i> Artículos Publicados: {{$totalNews}}<br>

                </div>
            </div>
            <div class="text-center mt-3 text-secondary">
                <h3><b>Articulos Publicados <i class="fas fa-newspaper"></i></b></h3>
            </div>
            <div class="row mt-1">
                <div class="col text-center">
                    <div class="card-nav-tabs m-0">
                        <ul class="list-group list-group-flush list-news-author">
                            @foreach($collection1 as $article)
                                <li class="list-group-items d-flex justify-content-start align-items-center">
                                    <img src="{{$article->news_image_featured}}" class="img-fluid" alt="{{$article->title}}">
                                    <div class="text-justify">
                                        <a class="list-news-author-title" href="{{url('/news/'.$article->category->name.'/'.$article->clasification->name.'/'.$article->id)}}">
                                            {{$article->title}}<br>
                                        </a>

                                        <small class="link-sections"><a href="{{url('/news/'.$article->category->name)}}">{{$article->category->name}}</a></small> /
                                        <small class="link-sections"><a href="{{url('/news/'.$article->clasification->name)}}">{{$article->clasification->name}}</a></small><br>
                                        <small>{{$article->date}}</small>
                                    </div>
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
                </div>
                @if($collection2->count() > 0)
                    <div class="col-12 col-xl-6 mt-3 mt-xl-0 text-center">
                        <div class="col-sm text-center">
                            <div class="card-nav-tabs mt-0">
                                <ul class="list-group list-news-author">
                                    @foreach($collection2 as $article)
                                        <li class="list-group-items d-flex justify-content-start align-items-center">
                                            <img src="{{$article->news_image_featured}}" class="img-fluid" alt="{{$article->title}}">
                                            <div class="text-justify">
                                                <a class="list-news-author-title" href="{{url('/news/'.$article->category->name.'/'.$article->clasification->name.'/'.$article->id)}}">
                                                    {{$article->title}}<br>
                                                </a>
                                                <small class="link-sections"><a href="{{url('/news/'.$article->category->name)}}">{{$article->category->name}}</a></small> /
                                                <small class="link-sections"><a href="{{url('/news/'.$article->clasification->name)}}">{{$article->clasification->name}}</a></small><br>
                                                <small>{{$article->date}}</small>
                                            </div>
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
                        </div>

                    </div>
                @endif

            </div>



            <nav class="mt-4 mb-0 col-12" aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {{$news->links()}}
                </ul>
            </nav>

@endsection


