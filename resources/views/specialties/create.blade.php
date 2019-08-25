@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                    <div class="col">
                    <h3 class="mb-0">Nueva Especialidad</h3>
                    </div>
                    <div class="col text-right">
                    <a href="{{ url('specialties') }}" class="btn btn-sm btn-default">Cancelar y Volver</a>
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
            <form action="{{ url('specialties') }}" method="POST">
                @csrf
                <div class="form_group">
                    <label for="name">Nombre de la Especialidad</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                </div>
                <div class="form_group">
                    <label for="description">Descripción</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
@endsection
