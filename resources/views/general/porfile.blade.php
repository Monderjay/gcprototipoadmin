@extends('layouts.admin')
@section('img-background')
    <div class="page-header header-filter" data-parallax="true" style="background-image:url('{{$user->cover_image_url}}');"></div>
@endsection
@section('page-description')
    <div class="description text-center">
        <p>Mire y edite su perfil para un mejor control y experiencia dentro del Sitio</p>
    </div>
@endsection
@section('porfile-data')
    <div class="row">
        <div class="col-md-3 ml-auto mr-auto">
            <div class="profile">
                <div class="avatar cont">
                    <img src="{{$user->porfile_image_url}}" alt="Circle Image" class="img-edit-porfile img-raised rounded-circle img-fluid">
                </div>
                <div class="name">
                    <h3 class="title">{{$user->name}} {{$user->first_name}} {{$user->last_name}}</h3>
                    <h6>{{$user->role->name}}</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-text card-header-primary">
                <div class="card-text">
                    <h4 class="card-title">Editar Perfil</h4>
                </div>
            </div>
            <div class="card-body">
                @if(count($errors)>0)
                    <ul class="">
                        @foreach($errors->all() as $error)
                            <li class="text-left text-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

                @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notification') }}
                    </div>
                @elseif(session('notificationUsername'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('notificationUsername') }}
                    </div>
                @endif
                <form method="POST" action="{{url('/porfile/'.$user->id.'/edit')}}" enctype="multipart/form-data" onsubmit="return validatePorfile(this)">
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-user"></i>
                                          </span>
                                    </div>
                                    <input type="text" class="form-control" name="username" value="{{old('username',$user->username)}}" placeholder="Usuario">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-user"></i>
                                          </span>
                                    </div>
                                    <input type="text" class="form-control" name="name" value="{{old('name',$user->name)}}" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-user"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="first_name" class="form-control" value="{{old('first_name',$user->first_name)}}" placeholder="Apellido Paterno">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-user"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="last_name" class="form-control" value="{{old('last_name',$user->last_name)}}" placeholder="Apellido Materno">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="exampleInputEmail1">Fecha de Nacimiento</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-birthday-cake"></i>
                                          </span>

                                    </div>
                                    <input type="date" class="form-control" name="birthdate" value="{{old('birthdate',$user->birthdate_date)}}">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group mt-3 pt-1">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-venus-mars"></i>
                                          </span>
                                    </div>
                                    <select name="gender" class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect1">
                                        @if($user->gender == "Masculino")
                                            <option selected>Masculino</option>
                                            <option>Femenino</option>
                                            <option>Indefinido</option>
                                        @elseif(($user->gender == "Femenino"))
                                            <option>Masculino</option>
                                            <option selected>Femenino</option>
                                            <option>Indefinido</option>
                                        @else
                                            <option>Masculino</option>
                                            <option selected>Femenino</option>
                                            <option selected>Indefinido</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                             <i class="fas fa-envelope-open-text"></i>
                                          </span>
                                    </div>
                                    <input type="email" name="email" class="form-control" value="{{old('email',$user->email)}}" placeholder="Correo">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-lock"></i>
                                          </span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-lock"></i>
                                          </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Confirmar Contraseña">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-user"></i>
                                          </span>
                                    </div>
                                    <input type="text" class="form-control" value="{{$user->role->name}}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-location-arrow"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="street" class="form-control" value="{{old('street',$user->address->street)}}" placeholder="Calle">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-door-open"></i>
                                          </span>
                                    </div>
                                    <input type="number" name="outdoor_number" class="form-control" value="{{old('outdoor_number',$user->address->outdoor_number)}}" placeholder="Número Exterior">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-door-closed"></i>
                                          </span>
                                    </div>
                                    <input type="number" name="interior_number" class="form-control" value="{{old('interior_number',$user->address->interior_number)}}" placeholder="Número Interior">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-map"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="colony" class="form-control" value="{{old('colony',$user->address->colony)}}" placeholder="Colonia">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-city"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="city" class="form-control" value="{{old('city',$user->address->city)}}" placeholder="Ciudad/Municipio">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-key"></i>
                                          </span>
                                    </div>
                                    <input type="number" name="zip" class="form-control" value="{{old('zip',$user->address->zip)}}" placeholder="Código Postal">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-mobile"></i>
                                          </span>
                                    </div>
                                    <input type="tel" name="cellphone" class="form-control" value="{{old('cellphone',$user->address->cellphone)}}" placeholder="Celular">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-phone"></i>
                                          </span>
                                    </div>
                                    <input type="tel" name="phone" class="form-control" value="{{old('phone',$user->address->phone)}}" placeholder="Teléfono">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="exampleInputEmail1">Foto de Perfil</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-user-circle"></i>
                                          </span>
                                    </div>
                                    <input type="file" class="inputFileHidden form-control" name="porfile_image">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="exampleInputEmail1">Foto de Portada</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-image"></i>
                                          </span>
                                    </div>
                                    <input type="file" class="inputFileHidden form-control" name="cover_image">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <textarea class="col-12" name="description" id="" cols="5" rows="5">{{$user->description}}</textarea>
                            </div>

                        </div>

                    </div>

                    <div class="footer text-center">
                        <input type="hidden" name="author" value="{{auth()->id()}}">
                        <button type="submit" class="btn btn-primary col-3">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
