@extends('layouts.admin')
@section('img-background')
    <div class="page-header header-filter" data-parallax="true" style="background-image:url('{{asset('img/preba.jpg')}}');"></div>
@endsection
@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-text card-header-primary">
                <div class="card-text">
                    <h4 class="card-title">Agregar Noticias</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{url('/staff/news/create')}}" enctype="multipart/form-data" onsubmit="return validateNews(this)">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-xl-9 form-group">
                                <textarea  name="description" id="description"></textarea>
                            </div>
                            <div class="form-row col-12 col-xl-3">
                                <div class="form-group mt-4 col-12">
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Titulo de la Noticia">
                                </div>

                                <div class="form-group mt-2 col-12">
                                    <label for="exampleFormControlTextarea1">Introducción de la noticia</label>
                                    <textarea  class="form-control" name="introduction" id="introduction" rows="3"></textarea>
                                </div>

                                <div class="form-group mt-2 col-12">
                                    <label for="exampleFormControlTextarea1">Acerca de...</label>
                                    <textarea  class="form-control" name="about" id="about" rows="3"></textarea>
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
                                    <select class="form-control selectpicker" id="category" name="category">
                                        <option>Seleccione una Categoría</option>
                                        @foreach($categories as $category)
                                            <option>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mt-4 form-group">
                                    <select class="form-control selectpicker" name="clasification" id="clasification">
                                        <option>Seleccione una Clasificación</option>
                                        @foreach($clasifications as $clasification)
                                            <option>{{$clasification->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mt-4 featured-content">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="featured" >
                                            Destacar Noticia
                                            <span class="form-check-sign">
                                                      <span class="check"></span>
                                                  </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 mt-4  calification-content">
                                    <input type="text" name="calification" class="calification" id="calification">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="footer text-center">
                <button type="submit" class="btn btn-primary" id="agregar">Agregar</button>
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








