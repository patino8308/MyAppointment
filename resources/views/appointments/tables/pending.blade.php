<div class="table-responsive">
    <!-- Projects table -->

    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">Descripción</th>
            <th scope="col">Especialidad</th>
            @if($role == 'patient')
                <th scope="col">Médico</th>
            @elseif($role == 'doctor')
                <th scope="col">Paciente</th>
            @endif
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Tipo</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($pendingAppointments as $appoinment)
                <tr>
            <th scope="row">
                {{ $appoinment->description }}
            </th>
            <td>
                {{ $appoinment->specialty->name }}
            </td>
            @if($role == 'patient')
                <td>
                {{ $appoinment->doctor->name }}
            </td>
            @elseif($role == 'doctor')
                <td>
                {{ $appoinment->patient->name }}
            </td>
            @endif

            <td>
                {{ $appoinment->scheduled_date }}
            </td>
            <td>
                {{ $appoinment->scheduled_time_12 }}
            </td>
            <td>
                {{ $appoinment->type }}
            </td>
            <td>
                @if($role == 'admin')
                        <a href="{{ url('/appointments/'.$appoinment->id) }}" class="btn btn-sm btn-primary" title="Ver Cita"> Ver</a>
                        @endif
                @if($role == 'doctor' || $role == 'admin')
                <form action="{{ url('/appointments/'.$appoinment->id.'/confirm') }}" method="POST" class="d-inline-block">
                @csrf
                    <button type="submit" class="btn btn-sm btn-success" data_toggle="tooltip" data-placement="top" title="Confirmar Cita"> <i class="ni ni-check-bold"></i></button>
                </form>

                @endif
                <form action="{{ url('/appointments/'.$appoinment->id.'/cancel') }}" method="POST" class="d-inline-block">
                @csrf
                    <button type="submit" class="btn btn-sm btn-danger" data_toggle="tooltip" data-placement="top" title="Cancelar Cita"> <i class="ni ni-fat-delete"></i></button>
                </form>

            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-body">
    {{ $pendingAppointments->links() }}
</div>
