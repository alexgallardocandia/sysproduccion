@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
      <section class="section">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="d-flex justify-content-between">
                              <h5 class="card-title">Permiso <b>#{{$permiso_id->id}}</b></h5>
                              <a href="{{url('permisos')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="card-body">
                              <!-- List group With Icons -->
                              <ul class="list-group">
                                  <li class="list-group-item"><b>Nombre: </b>{{$permiso_id->name}}</li>
                                  <li class="list-group-item"><b>Nombre a Mostrar: </b>{{$permiso_id->display_name}}</li>
                                  <li class="list-group-item"><b>Descripcion: </b>{{$permiso_id->description}}</li>
                                  <li class="list-group-item"><b>Creado: </b>{{$permiso_id->created_at->format('d/m/Y H:m:s')}}</li>
                                  <li class="list-group-item"><b>Modificado:</b>{{$permiso_id->updated_at->format('d/m/Y H:m:s')}}</td>                        
                              </ul><!-- End List group With Icons -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#configuraciones-nav').addClass("show");//coloca el menu en show
        $('#permisos-menu').addClass("active");//coloca activo el submenu usuario
    });
</script>
@endsection