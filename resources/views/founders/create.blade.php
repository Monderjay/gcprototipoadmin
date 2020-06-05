@extends('layouts.admin')
@section('img-background')
    <div class="page-header header-filter" data-parallax="true" style="background-image:url('{{asset('img/multi3.jpg')}}');"></div>
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
                @if(count($errors)>0)
                    <ul class="">
                        @foreach($errors->all() as $error)
                            <li class="text-left text-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                <form method="POST" action="{{url('staff/founder/create')}}" onsubmit="return validateFounder(this)">
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
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-user"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="first_name" class="form-control" placeholder="Apellido Paterno" value="{{old('first_name')}}">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-user"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="last_name" class="form-control" placeholder="Apellido Materno" value="{{old('last_name')}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Fecha de Nacimiento</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-birthday-cake"></i>
                                          </span>

                                    </div>
                                        <input type="date" class="inputFileHidden form-control" name="birthdate" value="{{old('birthdate')}}">
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
                                        <option></option>
                                        <option value="Masculino"{{ old('gender') == "Masculino" ? 'selected' : '' }}>Masculino</option>
                                        <option value="Femenino"{{ old('gender') == "Femenino" ? 'selected' : '' }}>Femenino</option>
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
                                    <input type="email" name="email" class="form-control" placeholder="Correo" value="{{old('email')}}">
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
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-location-arrow"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="street" class="form-control" placeholder="Calle" value="{{old('street')}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-door-open"></i>
                                          </span>
                                    </div>
                                    <input type="number" name="outdoor_number" class="form-control" placeholder="Número Exterior" value="{{old('outdoor_number')}}">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-door-closed"></i>
                                          </span>
                                    </div>
                                    <input type="number" name="interior_number" class="form-control" placeholder="Número Interior" value="{{old('interior_number')}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-map"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="colony" class="form-control" placeholder="Colonia" value="{{old('colony')}}">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-city"></i>
                                          </span>
                                    </div>
                                    <input type="text" name="city" class="form-control" placeholder="Ciudad/Municipio" value="{{old('city')}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-key"></i>
                                          </span>
                                    </div>
                                    <input type="number" name="zip" class="form-control" placeholder="Código Postal" value="{{old('zip')}}">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-mobile"></i>
                                          </span>
                                    </div>
                                    <input type="tel" name="cellphone" class="form-control" placeholder="Celular" value="{{old('cellphone')}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                              <i class="fas fa-phone"></i>
                                          </span>
                                    </div>
                                    <input type="tel" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Teléfono" value="{{old('phone')}}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="footer text-center">
                        <input type="hidden" name="author" value="{{auth()->id()}}">
                        <button type="submit" class="btn btn-primary col-3">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
