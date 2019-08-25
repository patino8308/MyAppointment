    <h6 class="navbar-heading text-muted">Gestionar Datos</h6>
    <ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link" href="/home">
        <i class="ni ni-tv-2 text-primary"></i> Dashboard
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="/specialties">
        <i class="ni ni-planet text-blue"></i> Especialidades
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="/doctors">
        <i class="ni ni-pin-3 text-orange"></i> Medicos
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="/patients">
        <i class="ni ni-single-02 text-yellow"></i> Pacientes
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="./examples/tables.html">
        <i class="ni ni-bullet-list-67 text-red"></i> Horarios
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
        <i class="ni ni-key-25 text-info"></i> Cerrar sessión
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display:none;" id="formLogout">
        @csrf
    </form>

    </li>
    </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Reportes</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-spaceship"></i>Frecuencia de Citas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-palette"></i> Medicos más Activos
            </a>
          </li>

        </ul>
