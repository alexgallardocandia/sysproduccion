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
                              <h5 class="card-title">Ajuste <b># {{ $ajuste->id }}</b></h5>
                              <a href="{{url('ajuste-stocks')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="row">
                            <div class="card-body col-6">
                              <!-- List group With Icons -->
                              <ul class="list-group">                                                                                      
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Fecha: </b>{{ $ajuste->fecha }}</li>
                                  <li class="list-group-item"><i class="bi bi-person-fill text-success"></i><b>Almacen: </b>{{ $ajuste->almacen->descripcion}}</li>
                                  <li class="list-group-item"><i class="bi bi-person-fill text-success"></i><b>Creado Por: </b>{{ $ajuste->user->empleado->fullname}}</li>
                                  {{-- <li class="list-group-item"><i class="ri-money-dollar-circle-line"></i><b>Estado: </b>{{ number_format($ajuste->descuento, 0, ',', '.') }} %</li> --}}
                              </ul><!-- End List group With Icons -->                              
                            </div>
                            <div class="card-body col-6">
                                <ul class="list-group">                                                                        
                                    <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Creado: </b>{{$ajuste->created_at->format('d/m/Y H:m:s')}}</li>
                                    <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Modificado:</b>{{$ajuste->updated_at->format('d/m/Y H:m:s')}}</td>
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
                                        <th align="center">Stock Sistema</th>
                                        <th align="center">Stock Fisico</th>
                                        <th align="center">Motivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cant_stock_total     = 0;
                                        $cant_almacen_total   = 0;
                                        $total_general  = 0;
                                    @endphp
                                    @foreach ($ajuste->details as $detail)
                                        <tr>
                                            <td>{{$detail->materia_prima->nombre.' - '.$detail->materia_prima->unidad_medida->descripcion}}</td>
                                            <td>{{$detail->cant_stock}}</td>
                                            <td align="left">{{$detail->cant_almacen}}</td>
                                            <td align="left">{{$detail->motivo}}</td>
                                        </tr>
                                        @php
                                            $cant_stock_total     += $detail->cant_stock;
                                            $cant_almacen_total   += $detail->cant_almacen;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bold">
                                        <td colspan="" align="left">TOTAL: </td>
                                        <td align="left"><b>{{ $cant_stock_total }}</b></td>
                                        <td align="left"><b>{{ number_format($cant_almacen_total, 0, ',', '.') }}</b></td>
                                        <td></td>
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
        $('#ajuste-stocks-menu').addClass("active");//coloca activo el submenu usuario
    });
</script>
@endsection