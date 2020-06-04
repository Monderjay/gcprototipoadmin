@extends('layouts.admin')
@section('img-background')
    <div class="page-header header-filter" data-parallax="true" style="background-image:url('{{asset('img/xbox3.jpg')}}');"></div>
@endsection
@section('content')


    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-text card-header-primary">
                <div class="card-text">
                    <h4 class="card-title">Editar Noticias</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{url('/staff/news/'.$news->id.'/update')}}" enctype="multipart/form-data" onsubmit="return validateNewsEdit(this)">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-xl-9 form-group">
                                <textarea  name="description" id="description">{{$news->description}}</textarea>
                            </div>
                            <div class="form-row col-12 col-xl-3">
                                <div class="form-group mt-4 col-12">
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Titulo de la Noticia" value="{{$news->title}}">
                                </div>

                                <div class="form-group mt-2 col-12">
                                    <label for="exampleFormControlTextarea1">Introducción de la noticia</label>
                                    <textarea  class="form-control" name="introduction" id="introduction" rows="3">{{$news->introduction}}</textarea>
                                </div>

                                <div class="form-group mt-2 col-12">
                                    <label for="exampleFormControlTextarea1">Acerca de...</label>
                                    <textarea  class="form-control" name="about" id="about" rows="3">{{$news->about}}</textarea>
                                </div>

                                <div class="col-12">
                                    <label for="exampleInputEmail1">Imagen Destacada</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-image"></i>
                                          </span>

                                        </div>
                                        <input type="file" class="inputFileHidden form-control" name="featured_image" id="featured_image">
                                    </div>
                                </div>


                                <div class="col-12 mt-4 form-group">
                                    <select class="form-control selectpicker" name="category">
                                        <option selected>{{$news->category->name}}</option>
                                        @foreach($categorySelected as $category)
                                            <option>{{$category}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mt-4 form-group">
                                    <select class="form-control selectpicker" name="clasification" id="clasification">
                                        <option>Seleccione una Clasificación</option>
                                        <option selected>{{$news->clasification->name}}</option>
                                        @foreach($clasificationSelected as $clasification)
                                            <option>{{$clasification}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mt-4 featured-content">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            @if($news->featured)
                                                <input class="form-check-input" type="checkbox" name="featured" checked {{ old('featured') == 'on' ? 'checked' : '' }}>
                                            @else
                                                <input class="form-check-input" type="checkbox" name="featured" {{ old('featured') == 'on' ? 'checked' : '' }}>
                                            @endif
                                            Destacar Noticia
                                            <span class="form-check-sign">
                                                  <span class="check"></span>
                                              </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 mt-4  calification-content">
                                    <input type="text" name="calification" value="{{$news->calification}}" class="calification" id="calification">
                                </div>


                                <div class="form-group col-12">
                                    <input type="text" class="form-control" name="font" id="font" placeholder="Fuente de la Noticia" value="{{$news->font}}">
                                </div>

                            </div>
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script defer>
        window.onload = function() {
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        };
    </script>

@endsection
