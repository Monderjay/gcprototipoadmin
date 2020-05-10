@extends('layouts.admin')
@section('img-background')
    <div class="page-header header-filter" data-parallax="true" style="background-image:url('{{asset('img/preba.jpg')}}');"></div>
@endsection
@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-text card-header-primary">
                <div class="card-text">
                    <h4 class="card-title">Agregar Fundadores</h4>
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
                <form method="POST" action="{{url('/admin/founder/edit/'.$founder->id)}}">
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-user"></i>
                                          </span>
                                    </div>
                                    <input type="text" class="form-control" name="name" value="{{old('name',$founder->name)}}" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-user"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="first_name" class="form-control" value="{{old('first_name',$founder->first_name)}}" placeholder="Apellido Paterno">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-user"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="last_name" class="form-control" value="{{old('last_name',$founder->last_name)}}" placeholder="Apellido Materno">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-birthday-cake"></i>
                                          </span>
                                    </div>
                                    <input type="date" name="birthdate" class="form-control" value="{{old('birthdate',$founder->birthdate_date)}}">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group mt-3 pt-1">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-venus-mars"></i>
                                          </span>
                                    </div>
                                    <select name="gender" class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect1">
                                        @if($founder->gender == "Masculino")
                                            <option selected>Masculino</option>
                                            <option>Femenino</option>
                                            <option>Indefinido</option>
                                        @elseif(($founder->gender == "Femenino"))
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
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                             <i class="fas fa-envelope-open-text"></i>
                                          </span>
                                    </div>
                                    <input type="email" name="email" class="form-control" value="{{old('email',$founder->email)}}" placeholder="Correo">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-lock"></i>
                                          </span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-lock"></i>
                                          </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Confirmar Contraseña">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-location-arrow"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="street" class="form-control" value="{{old('street',$founder->address->street)}}" placeholder="Calle">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-door-open"></i>
                                          </span>
                                    </div>
                                    <input type="number" name="outdoor_number" class="form-control" value="{{old('outdoor_number',$founder->address->outdoor_number)}}" placeholder="Número Exterior">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-door-closed"></i>
                                          </span>
                                    </div>
                                    <input type="number" name="interior_number" class="form-control" value="{{old('interior_number',$founder->address->interior_number)}}" placeholder="Número Interior">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-map"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="colony" class="form-control" value="{{old('colony',$founder->address->colony)}}" placeholder="Colonia">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-city"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="city" class="form-control" value="{{old('city',$founder->address->city)}}" placeholder="Ciudad/Municipio">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-key"></i>
                                          </span>
                                    </div>
                                    <input type="number" name="zip" class="form-control" value="{{old('zip',$founder->address->zip)}}" placeholder="Código Postal">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-mobile"></i>
                                          </span>
                                    </div>
                                    <input type="tel" name="cellphone" class="form-control" value="{{old('cellphone',$founder->address->cellphone)}}" placeholder="Celular">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-phone"></i>
                                          </span>
                                    </div>
                                    <input type="tel" name="phone" class="form-control" value="{{old('phone',$founder->address->phone)}}" placeholder="Teléfono">
                                </div>
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
