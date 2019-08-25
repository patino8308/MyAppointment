@extends('layouts.form')

@section('title','Inicio de sesión')
@section('subtitle','Ingresa tus Datos para iniciar sesiòn')

@section('content')
<div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">

                @if($errors->any())
                <div class="text-center text-muted mb-4">
                    <small>Oops! Se encontro un error.</small>
                </div>
                
                 <div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> {{ $errors->first()}}!
                </div>
                @endif

              <form role="form" method="POST" action="{{ route('login') }}">
                @csrf
               
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    
                    </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" type="password" name="password" required>
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">

                  <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="custom-control-label" for=" remember">
                    <span class="text-muted">Recordar sessión</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Ingresar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="{{ route('password.request') }}" class="text-light"><small>Olvidastes tu contraseña</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="{{ route('register') }}" class="text-light"><small>¿Aún no te has registrado?</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
