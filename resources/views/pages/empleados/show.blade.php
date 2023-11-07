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
                              <h5 class="card-title">Persona <b>{{$empleado->fullname}}</b></h5>
                              <a href="{{url('empleados')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="row">
                            <div class="card-body col-6">
                              <!-- List group With Icons -->
                              <ul class="list-group">                                                                    
                                  <li class="list-group-item"><i class="ri-file-user-fill me-1 text-success"></i><b>Nombres: </b>{{$empleado->nombres}}</li>
                                  <li class="list-group-item"><i class="ri-file-user-line me-1 text-success"></i><b>Apellidos: </b>{{$empleado->apellidos}}</li>
                                  <li class="list-group-item"><i class="ri-fingerprint-2-line me-1 text-success"></i><b>Nro. Documento: </b>{{number_format($empleado->ci,0,",",".")}}</li>
                                  <li class="list-group-item"><i class="ri-direction-fill me-1 text-success"></i><b>Direccion: </b>{{$empleado->direccion}}</li>
                                  <li class="list-group-item"><i class="ri-cellphone-fill me-1 text-success"></i><b>Telefono: </b>{{$empleado->telefono}}</li>
                                  <li class="list-group-item"><i class="ri-mail-fill me-1 text-success"></i><b>Correo: </b>{{$empleado->email}}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Fecha Nacimiento: </b>{{$empleado->fecha_nacimiento}}</li>
                              </ul><!-- End List group With Icons -->                              
                          </div>
                          <div class="card-body col-6">
                            <ul class="list-group">
                                <li class="list-group-item"><i class="ri-heart-2-fill me-1 text-success"></i><b>Estado Civil: </b>{{$empleado->civil_id}}</li>
                                  <li class="list-group-item"><i class="ri-node-tree me-1 text-success"></i><b>Cargo: </b>{{$empleado->cargo->descripcion}}</li>
                                  <li class="list-group-item"><i class="ri-organization-chart me-1 text-success"></i><b>Sucursal: </b>{{$empleado->Sucursal->descripcion}}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Creado: </b>{{$empleado->created_at->format('d/m/Y H:m:s')}}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Modificado:</b>{{$empleado->updated_at->format('d/m/Y H:m:s')}}</td>
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