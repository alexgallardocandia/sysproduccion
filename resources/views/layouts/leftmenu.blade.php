<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{url('home')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>REFERENCIALES</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('users.index')}}" class="active">
              <i class="bi bi-circle"></i><span>Usuarios</span>
            </a>
          </li>
          <li>
            <a href="{{route('estados-civiles.index')}}" class="">
              <i class="bi bi-circle"></i><span>Estados Civiles</span>
            </a>
          </li>
          <li>
            <a href="{{route('cargos.index')}}" class="">
              <i class="bi bi-circle"></i><span>Cargos</span>
            </a>
          </li>
          <li>
            <a href="{{route('sucursales.index')}}" class="">
              <i class="bi bi-circle"></i><span>Sucursales</span>
            </a>
          </li>
          <li>
            <a href="{{route('ciudades.index')}}" class="">
              <i class="bi bi-circle"></i><span>Ciudades</span>
            </a>
          </li>
          <li>
            <a href="{{route('personas.index')}}" class="">
              <i class="bi bi-circle"></i><span>Personas</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </aside><!-- End Sidebar-->