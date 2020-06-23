@extends('layouts.admin')
@section('img-background')
    <div class="page-header header-filter" data-parallax="true" style="background-image:url('{{$news->news_image_featured}}');"></div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header card-header-text card-header-primary">
            <div class="card-text">
                <h4 class="card-title">Imageness de la Noticia {{$id}}</h4>
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @elseif(session('notificationFaill'))
                <div class="alert alert-danger" role="alert">
                    {{ session('notificationFaill') }}
                </div>
            @endif

                <div class="col-md-12 mt-4">
                    <form method="POST" action="{{url('/staff/news/'.$id.'/images/create')}}" enctype="multipart/form-data" onsubmit="return validateImageFeatured(this)">
                        @csrf
                        <label for="exampleInputEmail1">Imagen destacada</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-image"></i>
                                </span>
                            </div>
                            <input type="file" class="inputFileHidden form-control" name="featured-image" id="featured_image">

                            <button type="submit" class="btn btn-primary ml-4">Subir</button>
                        </div>
                    </form>
                </div>

            <div class="row justify-content-center">
                @if($images != null)
                    @foreach($images as $image )
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="card justify-content-center">

                            <div class="card-body">
                                    <img class="news-image mt-2" src="{{$image->news_image}}">
                                <form method="POST" action="{{url('staff/news/images/'.$image->id.'/delete')}}" onsubmit="return validateDelete(this)";>
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button class="btn rounded-pill btn-danger" type="submit"><i class="fas fa-trash-alt"></i> Eliminar Imagen</button>
                                    @if($image->featured)
                                        <button type="button" class="btn btn-info btn-fab btn-fab-mini btn-round" rel="tooltip" title="Imagen destacada actualmente">
                                            <i class="material-icons">favorite</i>
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <h3>No hay Imagenes para esta noticia</h3>
                @endif
            </div>
        </div>
    </div>


@endsection
