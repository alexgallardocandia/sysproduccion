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
        <a class="nav-link collapsed" data-bs-target="#referenciales-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear"></i><span>REFERENCIALES</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="referenciales-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a id="users-menu" href="{{route('users.index')}}">
              <i class="bi bi-circle"></i><span>Usuarios</span>
            </a>
          </li>
          <li>
            <a id="estados-menu" href="{{route('estados-civiles.index')}}" >
              <i class="bi bi-circle"></i><span>Estados Civiles</span>
            </a>
          </li>
          <li>
            <a id="cargos-menu" href="{{route('cargos.index')}}" >
              <i class="bi bi-circle"></i><span>Cargos</span>
            </a>
          </li>
          <li>
            <a id="sucursales-menu" href="{{route('sucursales.index')}}" >
              <i class="bi bi-circle"></i><span>Sucursales</span>
            </a>
          </li>
          <li>
            <a id="ciudades-menu" href="{{route('ciudades.index')}}" >
              <i class="bi bi-circle"></i><span>Ciudades</span>
            </a>
          </li>
          <li>
            <a id="personas-menu" href="{{route('personas.index')}}" >
              <i class="bi bi-circle"></i><span>Personas</span>
            </a>
          </li>
          <li>
            <a id="depositos-menu" href="{{route('depositos.index')}}" >
              <i class="bi bi-circle"></i><span>Depositos</span>
            </a>
          </li>
          <li>
            <a id="unidades-menu" href="{{route('unidades-medidas.index')}}" >
              <i class="bi bi-circle"></i><span>Unidades de Medida</span>
            </a>
          </li> 
          <li>
            <a id="tipos-menu" href="{{route('tipos-impuestos.index')}}" >
              <i class="bi bi-circle"></i><span>Tipos de Impuestos</span>
            </a>
          </li> 
          <li>
            <a id="timbrados-menu" href="{{route('timbrados.index')}}" >
              <i class="bi bi-circle"></i><span>Timbrados</span>
            </a>
          </li> 
          <li>
            <a id="proveedores-menu" href="{{route('proveedores.index')}}" >
              <i class="bi bi-circle"></i><span>Proveedores</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#compras-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bag-fill"></i><span>COMPRAS</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="compras-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a id="materias-menu" href="{{route('materias-primas.index')}}" >
              <i class="bi bi-circle"></i><span>Materias Primas</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </aside><!-- End Sidebar-->