@extends('layouts.app')
@section('title', config('app.name').' | '.$author->username)
@section('page-title', $author->username)
@section('page-description', 'Articulos publicados por '.$author->name .' '. $author->first_name .' ('.$author->username.')')
@section('page-author',$author->name .' '. $author->first_name .' ('.$author->username.')')
@section('keywords','gamecore, autor, '.$author->name.', '.$author->username)

@section('content')

    <div class="cover-author-content ">
        <div class="col-12 p-0" style="background-image: url('{{$author->cover_image_url}}'); background-size: cover; width: 100%; height: 450px;"></div>
    </div>

    <div class="card col-11 mx-auto my-5">
        <div class="card-body row">
            <div class="col-auto img-author-info mx-auto mx-lg-0 p-0 mx-xl-0">
                <img class="img-thumbnail" src="{{$author->porfile_image_url}}">
            </div>
            <div class="col-auto mx-auto mx-lg-0 p-3">
                <i class="fas fa-user"></i> Autor: {{$author->name}}<br>
                <i class="fas fa-user-astronaut"></i> Alias: {{$author->username}}<br>
                <i class="fas fa-address-card"></i> Cargo: {{$author->role->name}}<br>
                <i class="fas fa-newspaper"></i> Artículos Publicados: {{$totalNews}}<br>
                @if($author->description)
                    <i class="fas fa-pen-alt"></i> Descripción: {{ $author->description }}<br>
                @endif
            </div>
        </div>

        <div class="row">
            <h2 class="col-12 text-center"><i class="fas fa-newspaper"></i> Articulos Publicados</h2>
            @if(count($collection2)>0)
                <div class="col-12 col-xl-6">
                    @else
                        <div class="col-12 col-xl-12">
                            @endif
                            <div class="pt-3 pb-4">
                                <ul class="list-group list-group-flush aside-list pr-3 pl-3">
                                    @foreach($collection1 as $item)
                                        <li class="list-group-item d-flex justify-content-start align-items-center">
                                            <div class="rounded-circle col-auto image-list" style="background-image: url('{{$item->news_image_featured_small}}');"></div>
                                            <div class="mr-2 ml-2 text-left">
                                                <div class="links-author">
                                                    <a href="{{$item->slug}}" class="links-author"><div style="font-size: 15px; font-weight: bold">{{$item->title}}</div></a>
                                                    <a href="{{url($item->category->name)}}">{{$item->category->name}}</a> /
                                                    <a href="{{url($item->clasification->name)}}"><small>{{$item->clasification->name}}</small></a><br>
                                                </div>
                                                <small>{{$item->date}}</small>
                                            </div>
                                            @if($item->calification > 0)
                                                <div class="col text-right p-0">
                                                    @if($item->calification < 50)
                                                        <div class="calification"><input type="text" value="{{$item->calification}}" class="dial" data-fgColor="#ed4757"></div>
                                                    @elseif($item->calification < 80)
                                                        <div class="calification"><input type="text" value="{{$item->calification}}" class="dial" data-fgColor="#fdc51b"></div>
                                                    @else
                                                        <div class="calification"><input type="text" value="{{$item->calification}}" class="dial" data-fgColor="#87ceeb"></div>
                                                    @endif
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                        <div class="col-12 col-xl-6">
                            <div class="pt-3 pb-4">
                                <ul class="list-group list-group-flush aside-list pr-3 pl-3">
                                    @foreach($collection2 as $item)
                                        <li class="list-group-item d-flex justify-content-start align-items-center">
                                            <div class="rounded-circle col-auto image-list" style="background-image: url('{{$item->news_image_featured_small}}');"></div>
                                            <div class="mr-2 ml-2 text-left">
                                                <div class="links-author">
                                                    <a href="{{$item->slug}}" class="links-author"><div style="font-size: 15px; font-weight: bold">{{$item->title}}</div></a>
                                                    <a href="{{url($item->category->name)}}">{{$item->category->name}}</a> /
                                                    <a href="{{url($item->clasification->name)}}"><small>{{$item->clasification->name}}</small></a><br>
                                                </div>
                                                <small>{{$item->date}}</small>
                                            </div>
                                            @if($item->calification > 0)
                                                <div class="col text-right p-0">
                                                    @if($item->calification < 50)
                                                        <div class="calification"><input type="text" value="{{$item->calification}}" class="dial" data-fgColor="#ed4757"></div>
                                                    @elseif($item->calification < 80)
                                                        <div class="calification"><input type="text" value="{{$item->calification}}" class="dial" data-fgColor="#fdc51b"></div>
                                                    @else
                                                        <div class="calification"><input type="text" value="{{$item->calification}}" class="dial" data-fgColor="#87ceeb"></div>
                                                    @endif
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div>

                        </div>

                </div>
                <?php
                $currentPage = $news->currentPage(); //Página actual
                $maxPages = $currentPage + 5; //Máxima numeración de páginas
                $firstPage = 1; //primera página
                $lastPage = $news->lastPage(); //última página
                $nextPage = $currentPage+1; //Siguiente página
                $forwardPage = $currentPage-1; //Página anterior
                $news->setPath('');
                ?>
                <nav aria-label="Page navigation example" class="m-auto">
                    <ul class="pagination pg-dark">
                        <!-- Botón para navegar a la primera página -->
                        <li class="page-item @if($currentPage==$firstPage){{'disabled'}}@endif">
                            <a href="@if($currentPage>1){{$news->url($firstPage)}}@else{{'#'}}@endif" class='page-link'><i class="fas fa-angle-double-left"></i></a>
                        </li>
                        <!-- Botón para navegar a la página anterior -->
                        <li class="page-item @if($currentPage==$firstPage){{'disabled'}}@endif">
                            <a href="@if($currentPage>1){{$news->url($forwardPage)}}@else{{'#'}}@endif" class='page-link'><i class="fas fa-angle-left"></i></a>
                        </li>
                        <!-- Mostrar la numeración de páginas, partiendo de la página actual hasta el máximo definido en $maxPages -->
                        @for($x=$currentPage;$x<$maxPages;$x++)
                            @if($x <= $lastPage)
                                <li class="page-item @if($x==$currentPage){{'active'}}@endif">
                                    <a href="{{$news->url($x)}}" class='page-link'>{{$x}}</a>
                                </li>
                        @endif
                    @endfor
                    <!-- Botón para navegar a la pagina siguiente -->
                        <li class="page-item @if($currentPage==$lastPage){{'disabled'}}@endif">
                            <a href="@if($currentPage<$lastPage){{$news->url($nextPage)}}@else{{'#'}}@endif" class='page-link'><i class="fas fa-angle-right"></i></a>
                        </li>
                        <!-- Botón para navegar a la última página -->
                        <li class="page-item @if($currentPage==$lastPage){{'disabled'}}@endif">
                            <a href="@if($currentPage<$lastPage){{$news->url($lastPage)}}@else{{'#'}}@endif" class='page-link'><i class="fas fa-angle-double-right"></i></a>
                        </li>
                    </ul>
                </nav>
        </div>


    @include('includes.footer')
@endsection
