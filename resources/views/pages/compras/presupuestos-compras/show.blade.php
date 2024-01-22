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
                              <h5 class="card-title">Presupuesto de Compra <b># {{ $presupuestocompra->id }}</b></h5>
                              <a href="{{url('presupuestos-compras')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="row">
                            <div class="card-body col-6">
                              <!-- List group With Icons -->
                              <ul class="list-group">                                                                                                      
                                  <li class="list-group-item"><i class="ri-artboard-2-line"></i><b>Numero: </b> {{ $presupuestocompra->numero }} </li>
                                  <li class="list-group-item"><i class="bi bi-question-lg text-success"></i><b>Estado: </b><span class="badge bg-{{ config('constants.presupuestos-compras-status-label.' . intval($presupuestocompra->estado)) }}">{{ config('constants.presupuestos-compras-status.'. intval($presupuestocompra->estado)) }}</span></li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Fecha: </b>{{ $presupuestocompra->fecha }}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Validez: </b>{{ $presupuestocompra->validez }}</li>
                                  <li class="list-group-item"><i class="bi bi-person-fill text-success"></i><b>Proveedor: </b>{{ $presupuestocompra->proveedor->razon_social }}</li>
                              </ul><!-- End List group With Icons -->                              
                            </div>
                            <div class="card-body col-6">
                                <ul class="list-group">                                                                        
                                    <li class="list-group-item"><i class="ri-money-dollar-circle-line"></i><b>Monto: </b>{{ number_format($grand_total, 0, ',', '.') }}</li>
                                    <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Creado: </b>{{$presupuestocompra->created_at->format('d/m/Y H:m:s')}}</li>
                                    <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Modificado:</b>{{$presupuestocompra->updated_at->format('d/m/Y H:m:s')}}</td>
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
                                    <th>Presentacion</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    {{-- <th>Descuento</th> --}}
                                    <th></th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td>{{$detail->materia_prima->nombre}}</td>
                                        <td>{{$detail->materia_prima->unidad_medida->descripcion}}</td>
                                        <td>{{$detail->cantidad}}</td>
                                        <td>{{number_format($detail->precio_unitario, 0, ',','.')}}</td>
                                        {{-- <td>{{number_format($detail->descuento, 0, ',','.')}}</td> --}}
                                        <td>{{number_format(($detail->precio_unitario * $detail->cantidad ) - $detail->descuento, 0, ',','.')}}</td>
                                        <td><b></b><span class="badge bg-{{ config('constants.presupuestos-compras-detalles-status-label.' . intval($detail->estado)) }}">{{ config('constants.presupuestos-compras-detalles-status.'. intval($detail->estado)) }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bold">
                                    <td colspan="2"></td>
                                    <td class="text-right"><b>{{ $total_cant }}</b></td>
                                    <td class="text-right"><b>{{ number_format($total_precio, 0, ',', '.') }}</b></td>
                                    {{-- <td class="text-right"><b>{{ number_format($total_desc, 0, ',', '.') }}</b></td> --}}
                                    <td class="text-right"><b>{{ number_format($grand_total, 0, ',', '.') }}</b></td>
                                    <td class="text-right"></td>
                                </tr>
                            </tfoot>
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