@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                    <div class="col">
                    <h3 class="mb-0">Nuevo Paciente</h3>
                    </div>
                    <div class="col text-right">
                    <a href="{{ url('patients') }}" class="btn btn-sm btn-default">Cancelar y Volver</a>
                    </div>
            </div>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('patients') }}" method="POST">
                @csrf
                <div class="form_group">
                    <label for="name">Nombre del Paciente</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                </div>
                <div class="form_group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                </div>
                <div class="form_group">
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" id="dni" value="{{ old('dni') }}" class="form-control">
                </div>
                <div class="form_group">
                    <label for="address">Direccion</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control">
                </div>
                <div class="form_group">
                    <label for="phone">Télefono</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control">
                </div>
                <div class="form_group">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" value="{{ str_random(6) }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
@endsection
