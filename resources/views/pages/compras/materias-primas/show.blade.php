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
                              <h5 class="card-title">Materia Prima <b>{{$materia_id->nombre}}</b></h5>
                              <a href="{{url('materias-primas')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="row">
                            <div class="card-body col-6">
                              <!-- List group With Icons -->
                              <ul class="list-group">                                                                                                      
                                  <li class="list-group-item"><i class="bi bi-shield-fill-check me-1 text-success"></i><b>Marca: </b>{{ $materia_id->marca->nombre }}</li>
                                  <li class="list-group-item"><i class="bi bi-clipboard-minus me-1 text-success"></i><b>Categoria: </b>{{$materia_id->categoria_id ? $materia_id->categoria->nombre : '' }}</li>
                                  <li class="list-group-item"><i class="bi bi-card-list me-1 text-success"></i><b>Tipo: </b>{{config('constants.materias-primas-tipos.'.$materia_id->tipo)}}</li>
                              </ul><!-- End List group With Icons -->                              
                          </div>
                          <div class="card-body col-6">
                            <ul class="list-group">                                
                                <li class="list-group-item"><i class="ri-building-fill me-1 text-success"></i><b>Unidad de Medida: </b>{{$materia_id->unidad_medida->descripcion}}</li>
                                <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Creado: </b>{{$materia_id->created_at->format('d/m/Y H:m:s')}}</li>
                                <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Modificado:</b>{{$materia_id->updated_at->format('d/m/Y H:m:s')}}</td>
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