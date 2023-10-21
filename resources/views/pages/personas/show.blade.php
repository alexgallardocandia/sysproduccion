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
                              <h5 class="card-title">Persona <b>{{$persona->nombres}}</b></h5>
                              <a href="{{url('personas')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="row">
                            <div class="card-body col-6">
                              <!-- List group With Icons -->
                              <ul class="list-group">                                                                    
                                  <li class="list-group-item"><i class="ri-file-user-fill me-1 text-success"></i><b>Nombres: </b>{{$persona->nombres}}</li>
                                  <li class="list-group-item"><i class="ri-file-user-line me-1 text-success"></i><b>Apellidos: </b>{{$persona->apellidos}}</li>
                                  <li class="list-group-item"><i class="ri-fingerprint-2-line me-1 text-success"></i><b>Nro. Documento: </b>{{number_format($persona->ci,0,",",".")}}</li>
                                  <li class="list-group-item"><i class="ri-direction-fill me-1 text-success"></i><b>Direccion: </b>{{$persona->direccion}}</li>
                                  <li class="list-group-item"><i class="ri-cellphone-fill me-1 text-success"></i><b>Telefono: </b>{{$persona->telefono}}</li>
                                  <li class="list-group-item"><i class="ri-mail-fill me-1 text-success"></i><b>Correo: </b>{{$persona->email}}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Fecha Nacimiento: </b>{{$persona->fecha_nacimiento}}</li>
                              </ul><!-- End List group With Icons -->                              
                          </div>
                          <div class="card-body col-6">
                            <ul class="list-group">
                                <li class="list-group-item"><i class="ri-heart-2-fill me-1 text-success"></i><b>Estado Civil: </b>{{$persona->civil->descripcion}}</li>
                                  <li class="list-group-item"><i class="ri-node-tree me-1 text-success"></i><b>Cargo: </b>{{$persona->cargo->descripcion}}</li>
                                  <li class="list-group-item"><i class="ri-organization-chart me-1 text-success"></i><b>Sucursal: </b>{{$persona->Sucursal->descripcion}}</li>
                                  <li class="list-group-item"><i class="ri-building-fill me-1 text-success"></i><b>Ciudad: </b>{{$persona->Ciudad->descripcion}}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Creado: </b>{{$persona->created_at->format('d/m/Y H:m:s')}}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Modificado:</b>{{$persona->updated_at->format('d/m/Y H:m:s')}}</td>
                              </ul>
                          </div>
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
        $('#referenciales-nav').addClass("show");//coloca el menu en show
        $('#personas-menu').addClass("active");//coloca activo el submenu usuario
    });
</script>
@endsection