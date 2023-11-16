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
                              <h5 class="card-title">Pedido de Compra <b>#{{$pedido_id->id}}</b></h5>
                              <a href="{{url('pedidos-compras')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="row">
                            <div class="card-body col-6">
                              <!-- List group With Icons -->
                              <ul class="list-group">                                                                                                      
                                  <li class="list-group-item"><i class="bi bi-layers-half text-success"></i><b>Prioridad: </b><span class="badge bg-{{ config('constants.pedidos-compras-prioridad-label.' . intval($pedido_id->prioridad)) }}">{{ config('constants.pedidos-compras-prioridad.'. intval($pedido_id->prioridad)) }}</span></li>
                                  <li class="list-group-item"><i class="bi bi-question-lg text-success"></i><b>Estado: </b><span class="badge bg-{{ config('constants.pedidos-compras-status-label.' . intval($pedido_id->estado)) }}">{{ config('constants.pedidos-compras-status.'. intval($pedido_id->estado)) }}</span></li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Fecha: </b>{{$pedido_id->fecha_pedido}}</li>
                                  <li class="list-group-item"><i class="bi bi-person-fill text-success"></i><b>Solicitante: </b>{{$pedido_id->user->empleado->fullname}}</li>
                              </ul><!-- End List group With Icons -->                              
                            </div>
                            <div class="card-body col-6">
                                <ul class="list-group">                                    
                                    <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Creado: </b>{{$pedido_id->created_at->format('d/m/Y H:m:s')}}</li>
                                    <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Modificado:</b>{{$pedido_id->updated_at->format('d/m/Y H:m:s')}}</td>
                                </ul>
                            </div>
                          </div>                          
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title"><b>Detalle</b></h5>                            
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Materia Prima</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>                                    
                                    @foreach ($pedido_id->details as $detail)
                                    
                                        <td>{{$detail->materia_prima->nombre}}</td>
                                        <td>{{number_format($detail->cantidad, 0, ',', '.').' '.$detail->materia_prima->unidad_medida->signo}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>                       
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
        $('#compras-nav').addClass("show");//coloca el menu en show
        $('#pedidos-compras-menu').addClass("active");//coloca activo el submenu usuario
    });
</script>
@endsection