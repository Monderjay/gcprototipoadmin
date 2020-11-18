@extends('layouts.app')

@section('content')
    <div class="row col-12 m-0 padding-top">
        <div class="col-12 col-lg-9">

            <div class="card-body col-11 col-lg-11 justify-content-center" id="search-content">
                <form class="form-inline justify-content-center">
                    <i class="fas fa-search"></i><input type="text" class="form-control ml-3 col-11" id="search"  placeholder="Buscar...">
                </form>
            </div>


            @foreach($podcast as $item)
                <div class="row news-container col-11">
                    <div class="col-xl-4 align-self-center">
                        <iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/197214857&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>
                    </div>
                    <div class="col-xl-8 justify-content-center">
                        <div class="news-title text-center mt-2">

                        </div>
                        <hr>
                        <div class="news-description text-justify">

                        </div>

                        <div class="justify-content-center col-xl-12 row p-0 m-0 mt-3">
                            <div class="col-6 news-date p-0">
                                <ul>
                                    <li class="author">
                                        Por: <a href=""> </a><i class="fas fa-user-tie"></i>
                                    </li>
                                    <li>
                                        Hora:  <i class="fas fa-clock"></i>
                                    </li>
                                    <li>
                                        Fecha:
                                        <i class="fas fa-calendar-alt"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6 text-center align-self-center">
                                <a href="" class="btn btn-primary col-12"><i class="fas fa-plus"></i> Leer más...</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-lg justify-content-center">

                </ul>
            </nav>
        </div>
        @include('includes.aside')
    </div>
@endsection
