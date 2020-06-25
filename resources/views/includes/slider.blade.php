<!--Carousel Wrapper-->
<div id="carousel" class="carousel slide carousel-fade d-none d-md-block" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
        @for($i=0; $i < $featuredNews->count(); $i++)
            @if($i==0)
                <li data-target="#carousel" data-slide-to="{{$i}}" class="active"></li>
            @else
                <li data-target="#carousel" data-slide-to="{{$i}}"></li>
            @endif
        @endfor
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
        @foreach($featuredNews as $key=>$item)
            {{$active=""}}
            @if($key ==0)
                {{$active= "active"}}
            @endif
            <div class="carousel-item {{$active}}">
                <a href="{{url($item->slug)}}">
                    <div class="zoom">
                        <img src="{{$item->news_image_featured}}"
                             alt="{{$item->title}}" style="width: 100%; display: block">
                    </div>
                    <div class="carousel-caption pb-5">
                        <h3 class="h3-responsive">{{$item->title}}</h3>
                        <p>{{$item->news_introduction}}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <i class="fas fa-arrow-circle-left" style="font-size: 30px"></i>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <i class="fas fa-arrow-circle-right" style="font-size: 30px"></i>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->
