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
                              <h5 class="card-title">Materia Prima <b>{{$materia->descripcion}}</b></h5>
                              <a href="{{url('materias-primas')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="row">
                            <div class="card-body col-6">
                              <!-- List group With Icons -->
                              <ul class="list-group">                                                                                                      
                                  <li class="list-group-item"><i class="ri-knife-fill me-1 text-success"></i><b>Cantidad: </b>{{$materia->cantidad.' '.$materia->umedida->signo}}</li>
                                  <li class="list-group-item"><i class="ri-money-dollar-circle-fill me-1 text-success"></i><b>Precio: </b>{{number_format($materia->precio,0,",",".")}}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Fecha Lote: </b>{{$materia->fecha_lote}}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Fecha Vencimiento: </b>{{$materia->fecha_vencimiento}}</li>
                              </ul><!-- End List group With Icons -->                              
                          </div>
                          <div class="card-body col-6">
                            <ul class="list-group">                                
                                <li class="list-group-item"><i class="ri-building-fill me-1 text-success"></i><b>Unidad de Medida: </b>{{$materia->umedida->descripcion}}</li>
                                <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Creado: </b>{{$materia->created_at->format('d/m/Y H:m:s')}}</li>
                                <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Modificado:</b>{{$materia->updated_at->format('d/m/Y H:m:s')}}</td>
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
        $('#compras-nav').addClass("show");//coloca el menu en show
        $('#materias-menu').addClass("active");//coloca activo el submenu usuario
    });
</script>
@endsection