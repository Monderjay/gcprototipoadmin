@extends('layouts.app')
@section('title',config('app.name').' | '.$section)
@section('page-title',$section)
@section('page-description', 'Disfruta de la sección de '.$section)
@section('keywords','gamecore, '.$section)

@section('content')
    <!--section-->
    <div class="container col-11" style="margin-top: 90px">
        <div class="row">
            <div class="col-12 col-xl-9 p-0 text-center">

                @include('includes.slider')

                <!-- news Ad 1 -->
                    <ins class="adsbygoogle mt-3"
                         style="display:inline-block;width:100%;height:90px"
                         data-ad-client="ca-pub-5455720448748407"
                         data-ad-slot="9897412100"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>

                <div class="col-12 row p-0 ml-auto mr-auto mt-1 mt-md-4 mb-0">

                    @foreach($news as $i=>$item)
                        @if($i ==6)
                            <!-- news Ad 2 -->
                                <ins class="adsbygoogle col-12 mt-0 mb-3 p-0 mx-auto text-center"
                                     style="display:inline-block;width:100%;height:90px"
                                     data-ad-client="ca-pub-5455720448748407"
                                     data-ad-slot="2309446563"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            @endif
                        <div class="col-12 col-xl-4 pl-0 pr-0 pl-xl-2 pr-xl-2 mb-4">
                            <!-- Card Light -->
                            <div class="card" style="min-height: 520px">
                                <!-- Card image -->
                                <div class="view overlay view zoom">
                                    <img class="w-100" src="{{$item->news_image_featured}}" srcset="{{$item->news_image_featured_small}} 400w ,{{$item->news_image_featured_medium}} 1280w" Loading="lazy">
                                    <a href="{{$item->slug}}">
                                        <div class="mask flex-center waves-effect rgba-black-light">

                                        </div>
                                    </a>
                                </div>
                                <!-- Card content -->
                                <div class="card-body elegant-color white-text rounded-bottom">
                                    <!-- Title -->
                                    <h4 class="card-title text-center">{{$item->news_title}}</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{url('/autor/'.$item->user->username)}}" class="white-text links"><small><i class="fas fa-user-tie"></i>&nbsp; {{$item->user->username}}</small></a>
                                        </div>
                                        <div class="col-6 text-right">
                                            <small><i class="fas fa-calendar-alt"></i>&nbsp; {{substr($item->date,0,10)}} </small>
                                        </div>
                                    </div>
                                    <hr class="hr-light">
                                    <!-- Text -->
                                    <p class="card-text text-justify white-text mb-5">{{$item->news_introduction}}</p>
                                    <!-- Link -->
                                    <div class="row col-11 p-0 ml-auto mr-auto mb-2 position-absolute" style="bottom: 12px">
                                        <div class="col-auto text-left justify-content-start p-0">
                                            <!--Facebook-->
                                            <a href="{{url('https://www.facebook.com/sharer/sharer.php?u=https://www.gamecore.com.mx/'.$item->slug)}}" target="_blank" type="button" class="btn btn-fb py-2 px-3 m-0 fb-share" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                                        </div>
                                        <div class="col-auto p-0">
                                            <!--Twitter-->
                                            <a href="{{url('http://twitter.com/share?text=@GameCore Informa&url=https://www.gamecore.com.mx/'.$item->slug.'&hashtags=GameCore')}}" target="_blank" type="button" class="btn btn-tw py-2 px-3 my-0 mx-1 fb-share" style="background: #55acee;"><i class="fab fa-twitter"></i></a>
                                        </div>
                                        <div class="col-auto my-auto mr-0 ml-auto text-right">
                                            <a href="{{$item->slug}}" class="white-text d-flex justify-content-end links">
                                                <h5 class="mt-auto mb-auto ml-0 mr-0">Leer Más <i class="fas fa-angle-double-right"></i></h5>
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- Card Light -->
                        </div>
                    @endforeach

                </div>

                    <!-- news Ad 3 -->
                    <ins class="adsbygoogle mx-auto"
                         style="display:inline-block;width:100%;height:90px"
                         data-ad-client="ca-pub-5455720448748407"
                         data-ad-slot="4220938819"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>

            </div>

            <!--Aside-->

            <div class="col-12 col-xl-3 pl-0 pl-xl-3 pr-0 pt-0 mb-4 text-center">

                <!-- Aside 1 -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:292px;height:250px"
                     data-ad-client="ca-pub-5455720448748407"
                     data-ad-slot="8509430972"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>

                <div class="pt-4 pb-4 elegant-color">
                    <div class="title white-text text-center mb-3"><h4><i class="fas fa-fist-raised"></i> No seas Fanboy</h4></div>
                    <ul class="list-group list-group-flush aside-list">
                        @foreach($fanboySection as $item)
                            <li class="list-group-item d-flex justify-content-start align-items-center elegant-color border-light">
                                <div class="rounded-circle col-auto image-list" style="background-image: url('{{$item->news_image_featured_small}}');"></div>
                                <div class="mr-2 ml-2 text-left"><a href="{{$item->slug}}" class="white-text links"><div>{{$item->title}}</div></a></div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- baner aside large -->
                <ins class="adsbygoogle mt-2"
                     style="display:block"
                     data-ad-client="ca-pub-5455720448748407"
                     data-ad-slot="3643829092"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>

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

    </div>
    @include('includes.footer')
@endsection
