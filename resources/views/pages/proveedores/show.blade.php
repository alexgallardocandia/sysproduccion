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
                              <h5 class="card-title">Proveedor <b>{{$proveedor->nombres}}</b></h5>
                              <a href="{{url('proveedores')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="row">
                            <div class="card-body col-6">
                              <!-- List group With Icons -->
                              <ul class="list-group">                                                                    
                                  <li class="list-group-item"><i class="ri-file-user-fill me-1 text-success"></i><b>Razon Social: </b>{{$proveedor->razon_social}}</li>
                                  <li class="list-group-item"><i class="ri-fingerprint-2-line me-1 text-success"></i><b>RUC: </b>{{$proveedor->ruc}}</li>
                                  <li class="list-group-item"><i class="ri-direction-fill me-1 text-success"></i><b>Direccion: </b>{{$proveedor->direccion}}</li>
                                  <li class="list-group-item"><i class="ri-cellphone-fill me-1 text-success"></i><b>Telefono: </b>{{$proveedor->telefono}}</li>

                              </ul><!-- End List group With Icons -->                              
                          </div>
                          <div class="card-body col-6">
                            <ul class="list-group">
                                <li class="list-group-item"><i class="ri-mail-fill me-1 text-success"></i><b>Correo: </b>{{$proveedor->email}}</li>
                                <li class="list-group-item"><i class="ri-building-fill me-1 text-success"></i><b>Ciudad: </b>{{$proveedor->Ciudad->descripcion}}</li>
                                <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Creado: </b>{{$proveedor->created_at->format('d/m/Y H:m:s')}}</li>
                                <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Modificado:</b>{{$proveedor->updated_at->format('d/m/Y H:m:s')}}</td>
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