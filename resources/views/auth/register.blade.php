@extends('layouts.form')

@section('title','Registro')
@section('subtitle','Ingresa Tus datos para registrarte')

@section('content')
<div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
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
              <form role="form" method="POST" action="{{ route('register') }}">
                        @csrf
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input id="name" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required autofocus type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input id="email" class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password" class="form-control" placeholder="Contraseña" type="password" name="password" required>
                  </div>
                </div>
                 <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password-confirm" class="form-control" placeholder="Confirmar contraseña" type="password" name="password_confirmation" required>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4">Confirmar registro</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
