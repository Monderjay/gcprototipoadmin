@extends('layouts.admin')
@section('img-background')
    <div class="page-header header-filter" data-parallax="true" style="background-image:url('{{asset('img/xbox2.jpg')}}');"></div>
@endsection
@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <div class="card-text">
                    <h4 class="card-title">Log de Usuarios</h4>
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

                <table class="table text-center table-bordered table-responsive-lg">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Fecha de Eliminación</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">A. Paterno</th>
                        <th scope="col">A. Materno</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Email</th>
                        <th scope="col">Imagene de Portada</th>
                        <th scope="col">Imagene de Perfil</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Restaurar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <th scope="row">{{$user->role->name}}</th>
                            <th scope="row">{{$user->deleted_at}}</th>
                            <td>{{$user->username}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->age}}</td>
                            <td>{{$user->gender}}</td>
                            <td>{{$user->email}}</td>
                            <td><img class="images-table" src="{{$user->cover_image_url}}"></td>
                            <td><img class="images-table" src="{{$user->porfile_image_url}}"></td>
                            <td class="text-left">
                                <b>Calle:</b> {{$user->address->street}} <b>#</b>{{$user->address->outdoor_number}}
                                <br><b>Colonia:</b> {{$user->address->colony}}, {{$user->address->city}}
                                <br><b>N° Interior :</b>{{$user->address->interior_number}}, <b>C.P: </b> {{$user->address->post_code}}
                                <br><b>Telefono:</b> {{$user->address->phone}}
                                <br><b>Telefono 2:</b> {{$user->address->cellphone}}
                            </td>
                            <td>
                                <form method="POST" action="{{url('staff/founder/logs/user/'.$user->id.'/restore')}}">
                                    {{csrf_field()}}
                                    <button class="btn btn-secondary"><i class="fas fa-undo-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="footer-brand text-muted">
                <ul class=" float-left justify-content-start">
                    Total de Usuarios Eliminados: {{$totalDeleted}}
                </ul>
                <ul class="float-right justify-content-end">
                    {{$users->links()}}
                </ul>
            </div>
        </div>
    </div>


@endsection
