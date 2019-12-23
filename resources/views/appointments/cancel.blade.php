@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                    <div class="col">
                    <h3 class="mb-0">Cancelar Cita</h3>
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
            @if(session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
            <form action="{{ url('/appointments/'.$appointment->id.'/cancel') }}" method="POST">
                @csrf
                @if($role == 'patient')
                    <p>Estás apunto de cancelar tu cita reservada con el médico {{ $appointment->doctor->name }}
                    (Especialidad {{ $appointment->specialty->name }} ) para el dia {{ $appointment->scheduled_date }}</p>
                @elseif($role == 'doctor')
                <p>Estás apunto de cancelar tu cita  con el paciente {{ $appointment->patient->name }}
                    (Especialidad {{ $appointment->specialty->name }} ) para el dia {{ $appointment->scheduled_date }} (hora  {{ $appointment->scheduled_date_12 }})</p>
                @else
                <p>Estás apunto de cancelar la cita  reservada por el  {{ $appointment->patient->name }}
                    para ser atendido por el médico {{ $appointment->doctor->name }}
                    (Especialidad {{ $appointment->specialty->name }} )  el dia {{ $appointment->scheduled_date }}
                    (hora  {{ $appointment->scheduled_date_12 }})</p>
                @endif
                <div class="form-group">
                    <label for="justification">Motivo Cancelación</label>
                    <textarea required name="justification" id="justification"  rows="3" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-danger">Cancelar Cita</button>

                    <a href="{{ url('appointments') }}" class="btn  btn-default">Cancelar y Volver</a>

            </form>
        </div>
    </div>
@endsection

