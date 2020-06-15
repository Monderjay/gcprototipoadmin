<div class="aside col-xl-3 col-11 mt-0 mr-auto ml-auto d-none d-block p-0">
    <div class="row text-center p-0 ml-0 mr-0" id="aside-content">

        <div class="col-12 items justify-content-center text-center align-items-center p-0">
            <div class="fb-page items text-center p-0 mr-auto ml-auto"
                 data-href="https://www.facebook.com/GameCore-101570291364601/?modal=admin_todo_tour"
                 data-tabs="snallheader"
                 data-small-header="false"
                 data-adapt-container-width="true"
                 data-width="500"
                 data-height="450"
                 data-show-facepile="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/GameCore-101570291364601/?modal=admin_todo_tour" class="fb-xfbml-parse-ignore">
                    <a href="https://www.facebook.com/GameCore-101570291364601/?modal=admin_todo_tour">GameCore</a></blockquote>
            </div>
        </div>

        <script type="javascript" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>


        <div class="col-12 mr-xl-auto ml-xl-auto  p-0 m-xl-0">
            <div class="card">
                <div class="elegant-color white-text list-header-review pt-4 text-center">
                    <h5><i class="fas fa-newspaper"></i> Ultimas Reseñas</h5>
                </div>
                <div class="card-body elegant-color">
                    <ul class="list-group-flush list-aside col-12 p-0 bg-primary list-review">
                        @foreach($reviewSection as $review)
                            <li class="list-group-item d-flex align-items-center elegant-color pr-0">
                                <img src="{{$review->news_image_featured}}" class="img-fluid" alt="{{$review->title}}">
                                <a href="{{url($review->slug)}}">
                                    {{$review->title}}
                                </a>
                                <div class="col text-right p-0">
                                    @if($review->calification < 50)
                                        <div class="calification"><input type="text" value="{{$review->calification}}" class="dial" data-fgColor="#ed4757"></div>
                                    @elseif($review->calification < 80)
                                        <div class="calification"><input type="text" value="{{$review->calification}}" class="dial" data-fgColor="#fdc51b"></div>
                                    @else
                                        <div class="calification"><input type="text" value="{{$review->calification}}" class="dial" data-fgColor="#87ceeb"></div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>




        <div class="col-12 mr-xl-auto ml-xl-auto  p-0 mt-4">
            <div class="card">
                <div class="elegant-color white-text list-header-review pt-4 text-center">
                    <h5><i class="fas fa-plus-square"></i> Más Contenido</h5>
                </div>
                <div class="card-body elegant-color">
                    <ul class="list-group-flush list-aside col-12 p-0 bg-primary list-review">
                        @foreach($moreContent as $review)
                            <li class="list-group-item d-flex text-left elegant-color pr-0">
                                <img src="{{$review->news_image_featured}}" class="img-fluid" alt="{{$review->title}}">
                                <a href="{{url($review->slug)}}">
                                    {{$review->title}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


</div>
</div>

