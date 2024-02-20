<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{url('home')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @permission('menu.referenciales')
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#referenciales-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-hammer"></i><span>REFERENCIALES</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="referenciales-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            @permission('depositos.index')
              <li>
                <a id="depositos-menu" href="{{route('depositos.index')}}" >
                  <i class="bi bi-circle"></i><span>Depositos</span>
                </a>
              </li>
            @endpermission
            @permission('cargos.index')
              <li>
                <a id="cargos-menu" href="{{route('cargos.index')}}" >
                  <i class="bi bi-circle"></i><span>Cargos</span>
                </a>
              </li>
            @endpermission
            @permission('categorias.index')
              <li>
                <a id="categorias-menu" href="{{route('categorias.index')}}" >
                  <i class="bi bi-circle"></i><span>Categorias</span>
                </a>
              </li>
            @endpermission
            @permission('ciudades.index')
            <li>
              <a id="ciudades-menu" href="{{route('ciudades.index')}}" >
                <i class="bi bi-circle"></i><span>Ciudades</span>
              </a>
            </li>
            @endpermission
            @permission('departamentos.index')
              <li>
                <a id="departamentos-menu" href="{{route('departamentos.index')}}" >
                  <i class="bi bi-circle"></i><span>Departamentos</span>
                </a>
              </li>
            @endpermission
            @permission('empleados.index')
              <li>
                <a id="personas-menu" href="{{route('empleados.index')}}" >
                  <i class="bi bi-circle"></i><span>Empleados</span>
                </a>
              </li>
            @endpermission
            @permission('estados-civiles.index')
              <li>
                <a id="estados-menu" href="{{route('estados-civiles.index')}}" >
                  <i class="bi bi-circle"></i><span>Estados Civiles</span>
                </a>
              </li>
            @endpermission
            @permission('marcas.index')
              <li>
                <a id="marcas-menu" href="{{route('marcas.index')}}" >
                  <i class="bi bi-circle"></i><span>Marcas</span>
                </a>
              </li>
            @endpermission
            @permission('nota-motivos.index')
              <li>
                <a id="nomta-motivos-menu" href="{{route('nota-motivos.index')}}" >
                  <i class="bi bi-circle"></i><span>Motivos NC</span>
                </a>
              </li>
            @endpermission
            @permission('proveedores.index')
              <li>
                <a id="proveedores-menu" href="{{route('proveedores.index')}}" >
                  <i class="bi bi-circle"></i><span>Proveedores</span>
                </a>
              </li>
            @endpermission
            @permission('sucursales.index')
              <li>
                <a id="sucursales-menu" href="{{route('sucursales.index')}}" >
                  <i class="bi bi-circle"></i><span>Sucursales</span>
                </a>
              </li>
            @endpermission
            @permission('stocks.index')
              <li>
                <a id="stocks-menu" href="{{route('stocks.index')}}" >
                  <i class="bi bi-circle"></i><span>Stocks</span>
                </a>
              </li>
            @endpermission
            @permission('timbrados.index')
              <li>
                <a id="timbrados-menu" href="{{route('timbrados.index')}}" >
                  <i class="bi bi-circle"></i><span>Timbrados</span>
                </a>
              </li> 
            @endpermission
            @permission('tipos-impuestos.index')
              <li>
                <a id="tipos-menu" href="{{route('tipos-impuestos.index')}}" >
                  <i class="bi bi-circle"></i><span>Tipos de Impuestos</span>
                </a>
              </li> 
            @endpermission
            @permission('unidades-medidas.index')
              <li>
                <a id="unidades-menu" href="{{route('unidades-medidas.index')}}" >
                  <i class="bi bi-circle"></i><span>Unidades de Medida</span>
                </a>
              </li> 
            @endpermission
          </ul>
        </li>
      @endpermission
      @permission('menu.compras')
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#compras-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-bag-fill"></i><span>COMPRAS</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="compras-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            @permission('materias-primas.index')
              <li>
                <a id="materias-menu" href="{{route('materias-primas.index')}}" >
                  <i class="bi bi-circle"></i><span>Materias Primas</span>
                </a>
              </li>
            @endpermission
            @permission('pedidos-compras.index')
              <li>
                <a id="pedidos-compras-menu" href="{{route('pedidos-compras.index')}}" >
                  <i class="bi bi-circle"></i><span>Pedidos de Compra</span>
                </a>
              </li>
            @endpermission
            @permission('presupuestos-compras.index')
              <li>
                <a id="presupuestos-compras-menu" href="{{route('presupuestos-compras.index')}}" >
                  <i class="bi bi-circle"></i><span>Presupuestos de Compra</span>
                </a>
              </li>
            @endpermission
            @permission('orden-compras.index')
              <li>
                <a id="orden-compras-menu" href="{{route('orden-compras.index')}}" >
                  <i class="bi bi-circle"></i><span>Orden de Compra</span>
                </a>
              </li>
            @endpermission
            @permission('compras.index')
              <li>
                <a id="compras-menu" href="{{route('compras.index')}}" >
                  <i class="bi bi-circle"></i><span>Compras</span>
                </a>
              </li>
            @endpermission
            @permission('libro-compras.index')
              <li>
                <a id="libro-compras-menu" href="{{route('libro-compras.index')}}" >
                  <i class="bi bi-circle"></i><span>Libro Compras</span>
                </a>
              </li>
            @endpermission
            @permission('ajuste-stocks.index')
              <li>
                <a id="ajuste-stocks-menu" href="{{route('ajuste-stocks.index')}}" >
                  <i class="bi bi-circle"></i><span>Ajuste Stock</span>
                </a>
              </li>
            @endpermission
          </ul>
        </li>
      @endpermission
      @permission('menu.configuraciones')
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#configuraciones-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-gear-fill"></i><span>CONFIGURACIONES</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="configuraciones-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            @permission('permisos.index')
              <li>
                <a id="permisos-menu" href="{{route('permisos.index')}}" >
                  <i class="bi bi-circle"></i><span>Permisos</span>
                </a>
              </li>
            @endpermission
            @permission('users.index')
              <li>
                <a id="users-menu" href="{{route('users.index')}}">
                  <i class="bi bi-circle"></i><span>Usuarios</span>
                </a>
              </li>
            @endpermission
          </ul>
        </li>
      @endpermission
    </ul>
  </aside><!-- End Sidebar-->