@extends('layouts.admin')
@section('img-background')
    <div class="page-header header-filter" data-parallax="true" style="background-image:url('{{asset('img/multi1.jpg')}}');"></div>
@endsection
@section('content')

    <script type="text/javascript">
        $(document).ready( function () {
            $('#news-table').DataTable();
        } );
    </script>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <div class="card-text">
                    <h4 class="card-title float-left">Noticias</h4>
                    <p class="category float-right m-0"><a href="{{url('staff/news/create')}}" class="btn btn-round btn-secondary"><i class="fas fa-plus"></i> Agregar</a></p>
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

                <table id="news-table" class="table text-center table-bordered table-responsive-md table-responsive-xl table-responsive-lg">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><i class="fas fa-signature"></i> Titulo</th>
                        <th scope="col"><i class="fas fa-quote-left"></i> Introducción</th>
                        <th scope="col"><i class="fas fa-user-edit"></i> Autor</th>
                        <th scope="col"><i class="fas fa-calendar-alt"></i> Fecha de Publicación</th>
                        <th scope="col"><i class="fas fa-star"></i> Noticia Destacada</th>
                        <th scope="col"><i class="fas fa-th-list"></i> Categoria</th>
                        <th scope="col"><i class="fas fa-list"></i> Clasificación</th>
                        <th scope="col"><i class="fas fa-percentage"></i> Calificación</th>
                        <th scope="col"><i class="fas fa-images"></i> Imagenes</th>
                        <th scope="col"><i class="fas fa-pen-alt"></i> Editar</th>
                        <th scope="col"><i class="fas fa-trash-alt"></i> <!--<img src="">--> Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news as $note)
                        <tr>
                            <th>{{$note->id}}</th>
                            <td class="text-left">{{$note->title}}</td>
                            <td style="max-width: 350px;" class="text-justify">{!!$note->news_introduction!!}</td>
                            <td>{{$note->user->username}}</td>
                            <td>{{$note->date}}</td>
                            <td>

                                @if($note->featured)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="fas fa-star"></i>
                                @endif

                            </td>
                            <td><i class="{{$note->category->icon}}"></i></td>
                            <td><i class="{{$note->clasification->icon}}"></i></td>
                            @if($note->calification > 0)
                                <td scope="col">{{$note->calification}}</td>
                            @else
                                <td scope="col"></td>
                            @endif
                            <td><a href="{{url('staff/news/'.$note->id.'/images')}}" class="btn btn-warning"><i class="fas fa-image"></i></a></td>
                            <td><a href="{{url('staff/news/'.$note->id.'/edit')}}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>
                            <td>

                                <form method="POST" action="{{url('/staff/news/delete/'.$note->id)}}" onsubmit="return validateDelete(this)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="footer-brand text-muted">
                <ul class=" float-left justify-content-start">
                    Total de noticias: {{$totalNews}}
                </ul>
                <ul class="float-right justify-content-end">
                    {{$news->links()}}
                </ul>
            </div>
        </div>
    </div>
@endsection
