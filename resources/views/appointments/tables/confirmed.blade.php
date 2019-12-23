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
            @foreach ($confirmedAppointments as $appoinment)
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
                        <a href="{{ url('/appointments/'.$appoinment->id.'/cancel') }}" class="btn btn-sm btn-danger" title="Cancelar Cita"> Cancelar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-body">
    {{ $confirmedAppointments->links() }}
</div>
