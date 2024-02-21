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
                              <h5 class="card-title">Nota Credito <b># {{ $nota->id }}</b></h5>
                              <a href="{{url('nota-creditos')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="row">
                            <div class="card-body col-6">
                              <!-- List group With Icons -->
                              <ul class="list-group">                                                                                      
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Fecha: </b>{{ $nota->fecha }}</li>
                                  <li class="list-group-item"><i class="bi bi-person-fill text-success"></i><b>Proveedor: </b>{{ $nota->proveedor->razon_social}}</li>
                                  <li class="list-group-item"><i class="ri-shopping-bag-3-fill me-1 text-success"></i><b>Motivo: </b>{{$nota->motivo->nombre}}</td>
                              </ul><!-- End List group With Icons -->                              
                            </div>
                            <div class="card-body col-6">
                                <ul class="list-group">                                                                        
                                    <li class="list-group-item"><i class="ri-money-dollar-circle-line"></i><b>Monto: </b>{{ number_format($nota->getTotalDetalles(), 0, ',', '.') }}</li>
                                    <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Creado: </b>{{$nota->created_at->format('d/m/Y H:m:s')}}</li>
                                    <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Modificado:</b>{{$nota->updated_at->format('d/m/Y H:m:s')}}</td>
                                    <li class="list-group-item"><i class="ri-shopping-bag-3-fill me-1 text-success"></i><b>Compra: </b>{{$nota->compra ? $nota->compra->id.'- '.($nota->compra->presupuesto_compra ? ($nota->compra->presupuesto_compra->solicitante_id ? $nota->compra->presupuesto_compra->solicitante->fullname :($nota->compra->presupuesto_compra->pedido_compra_id ? $nota->compra->presupuesto_compra->pedido_compra->empleado->fullname :'')) : ' ').' | '. $nota->compra->fecha : ''}}</td>
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
                                        <th align="center">Materia Prima</th>
                                        <th align="center">U. Medida</th>
                                        <th align="center">Cantidad</th>
                                        <th align="center">Precio</th>
                                        <th align="center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_cant     = 0;
                                        $total_precio   = 0;
                                        $total_general  = 0;
                                    @endphp
                                    @foreach ($nota->details as $detail)
                                        <tr>
                                            <td>{{$detail->materia_prima->nombre}}</td>
                                            <td>{{$detail->materia_prima->unidad_medida->descripcion}}</td>
                                            <td align="right">{{$detail->cantidad}}</td>
                                            <td align="right">{{number_format($detail->precio_unitario, 0, ',','.')}}</td>
                                            <td align="right">{{number_format(($detail->precio_unitario * $detail->cantidad ), 0, ',','.')}}</td>
                                        </tr>
                                        @php
                                            $total_cant     += $detail->cantidad;
                                            $total_precio   += $detail->precio_unitario;
                                            $total_general  += $detail->precio_unitario * $detail->cantidad;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bold">
                                        <td colspan="2" align="right">TOTAL: </td>
                                        <td align="right"><b>{{ $total_cant }}</b></td>
                                        <td align="right"><b>{{ number_format($total_precio, 0, ',', '.') }}</b></td>
                                        <td align="right"><b>{{ number_format($total_general, 0, ',', '.') }}</b></td>
                                        <td align="right"></td>
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
        $('#nota-creditos-menu').addClass("active");//coloca activo el submenu usuario
    });
</script>
@endsection