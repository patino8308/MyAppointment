<div class="table-responsive">
    <!-- Projects table -->

    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">Especialidad</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($oldAppointments as $appoinment)
                <tr>
            <td>
            {{ $appoinment->specialty->name }}
            </td>
                <td>
            {{ $appoinment->scheduled_date }}
            </td>
                <td>
            {{ $appoinment->scheduled_time_12 }}
            </td>
            <td>
                {{ $appoinment->status }}
            </td>
            <td>
                <a href="{{ url('appointments/'.$appoinment->id) }}" class="btn btn-primary btn-sm">Ver</a>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-body">
    {{ $oldAppointments->links() }}
</div>
