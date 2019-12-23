@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                    <div class="col">
                    <h3 class="mb-0">Modificar Paciente</h3>
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
            <form action="{{ url('patients/'.$patient->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form_group">
                    <label for="name">Nombre del Médico</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" class="form-control">
                </div>
                <div class="form_group">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" value="{{ old('email', $patient->email) }}" class="form-control">
                </div>
                <div class="form_group">
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" id="dni" value="{{ old('dni', $patient->dni) }}" class="form-control">
                </div>
                <div class="form_group">
                    <label for="address">Direccion</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $patient->address) }}" class="form-control">
                </div>
                <div class="form_group">
                    <label for="phone">Télefono</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $patient->phone) }}" class="form-control">
                </div>
                <div class="form_group">
                    <label for="password">Password </label>
                    <input type="text" name="password" id="password" value="" class="form-control">
                    <p>Ingrese un valor si desea modificar la contraseña</p>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
@endsection
