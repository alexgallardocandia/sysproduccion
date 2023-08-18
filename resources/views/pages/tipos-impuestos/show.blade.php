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
                              <h5 class="card-title">Tipo de Impuesto <b>{{$tipo->descripcion}}</b></h5>
                              <a href="{{url('tipos-impuestos')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="card-body">
                              <!-- List group With Icons -->
                              <ul class="list-group">                                                                    
                                  <li class="list-group-item"><i class="ri-percent-fill me-1 text-success"></i><b>Valor: </b>{{$tipo->valor}}</li>
                                  <li class="list-group-item"><i class="ri-forbid-2-fill me-1 text-success"></i><b>Signo: </b>{{$tipo->signo}}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Creado: </b>{{$tipo->created_at->format('d/m/Y H:m:s')}}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-primary"></i><b>Modificado:</b>{{$tipo->updated_at->format('d/m/Y H:m:s')}}</td>                        
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