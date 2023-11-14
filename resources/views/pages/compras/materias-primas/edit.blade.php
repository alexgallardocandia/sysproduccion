@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Materia Prima # {{ $materia_id->id }} </h5>              
            </div>
            <div class="card-body">                                  
              <form class="row g-3" id="form">
                @csrf
                <div class="col-md-3">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input name="nombre" id="nombre" class="form-control" value="{{ $materia_id->nombre }}" />
                  <input name="materia_id" id="materia_id" class="form-control" value="@json($materia_id->id)" hidden/>
                </div>
                <div class="col-md-3">
                  <label for="umedida_id" class="form-label">Unidad de Medida</label>
                  <select class="form-select" name="umedida_id" id="umedida_id">
                    <option value="@json($materia_id->unidad_medida_id)" >{{ $materia_id->unidad_medida->descripcion }}</option>
                    @foreach ($unidades as $unidad )
                        <option value="@json($unidad->id)">{{ $unidad->descripcion }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="marca_id" class="form-label">Marca</label>
                  <select class="form-select" name="marca_id" id="marca_id">
                    <option value="@json($materia_id->marca_id)" >{{ $materia_id->marca->nombre }}</option>
                    @foreach ($marcas as $marca )
                        <option value="@json($marca->id)">{{$marca->nombre}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="categoria_id" class="form-label">Categoria</label>
                  <select class="form-select" name="categoria_id" id="categoria_id">
                    <option value="@json($materia_id->categoria_id)" >{{ $materia_id->categoria->nombre }}</option>
                    @foreach ($categorias as $categoria )
                        <option value="@json($categoria->id)">{{$categoria->nombre}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="tipo" class="form-label">Tipo</label>
                  <select class="form-select" name="tipo" id="tipo">
                    <option value="@json($materia_id->tipo)" >{{ config('constants.materias-primas-tipos.'.$materia_id->tipo) }}</option>
                    <option value="1">PERECEDEROS</option>
                    <option value="2">NO PERECEDEROS</option>
                  </select>
                </div>
                <div class="row g-3">
                  <div class="card-footer">                        
                      <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Modificar</button>
                      <a href="{{url('materias-primas')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
                  </div>
                </div>
              </form>
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

        $('#form').on('submit', function(e) {
          e.preventDefault();
          $.ajax({
            type: "PUT",
            url: "{{route('materias-primas.update')}}",
            data: $(this).serialize(),            
            success: function (response) {
              window.location.href = "{{ route('materias-primas.index') }}";
            },
            error:function(response){
              laravelErrorMessages(response);
            }

          });
        });
    });
</script>
@endsection