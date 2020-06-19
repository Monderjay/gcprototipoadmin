<div class="col-12 col-xl-3 pl-0 pl-xl-3 pr-0 pt-0">

    <div class="pt-4 pb-4 elegant-color">
        <div class="title white-text text-center mb-3"><h4><i class="fas fa-signature"></i> Ultimas Reseñas</h4></div>
        <ul class="list-group list-group-flush aside-list pr-3 pl-3">
            @foreach($reviewSection as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center elegant-color border-light">
                    <img src="{{$item->news_image_featured}}" alt="{{$item->title}}">
                    <div class="mr-2 ml-2 text-left">
                        <a href="{{$item->slug}}" class="white-text links"><div>{{$item->title}}</div></a>
                    </div>
                    <div class="col text-right p-0">
                        @if($item->calification < 50)
                            <div class="calification"><input type="text" value="{{$item->calification}}" class="dial" data-fgColor="#ed4757"></div>
                        @elseif($item->calification < 80)
                            <div class="calification"><input type="text" value="{{$item->calification}}" class="dial" data-fgColor="#fdc51b"></div>
                        @else
                            <div class="calification"><input type="text" value="{{$item->calification}}" class="dial" data-fgColor="#87ceeb"></div>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="mt-4 pt-4 pb-4 elegant-color">
        <div class="title white-text text-center mb-3"><h4><i class="fas fa-plus-square"></i> Más Contenido</h4></div>
        <ul class="list-group list-group-flush aside-list">
            @foreach($moreContent as $item)
                <li class="list-group-item d-flex justify-content-start align-items-center elegant-color border-light">
                    <img src="{{$item->news_image_featured}}" alt="{{$item->title}}">
                    <div class="mr-2 ml-2 text-left"><a href="{{$item->slug}}" class="white-text links"><div>{{$item->title}}</div></a></div>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="mt-4 pt-4 pb-4 elegant-color">
        <div class="title white-text text-center mb-3"><h4><i class="fas fa-rocket"></i> Retro</h4></div>
        <ul class="list-group list-group-flush aside-list pr-3 pl-3">
            @foreach($retroContent as $item)
                <li class="list-group-item d-flex justify-content-start align-items-center elegant-color border-light">
                    <img src="{{$item->news_image_featured}}" alt="{{$item->title}}">
                    <div class="mr-2 ml-2 text-left"><a href="{{$item->slug}}" class="white-text links"><div>{{$item->title}}</div></a></div>
                </li>
            @endforeach
        </ul>
    </div>

</div>
