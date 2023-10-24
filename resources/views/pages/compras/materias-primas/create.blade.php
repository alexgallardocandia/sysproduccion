@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Crear Materia Prima</h5>              
            </div>
            <div class="card-body">                                  
              <form class="row g-3" id="form">
                @csrf
                <div class="col-md-3">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input name="nombre" id="nombre" class="form-control" />
                </div>
                <div class="col-md-3">
                  <label for="categoria_id" class="form-label">Categoria</label>
                  <select class="form-select" name="categoria_id" id="categoria_id">
                    <option value="">Seleccione...</option>
                    @foreach ($categorias as $categoria )
                        <option value="@json($categoria->id)">{{$categoria->nombre}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="presentacion" class="form-label">Presentacion</label>
                  <select class="form-select" name="presentacion" id="presentacion">
                    <option value="">Seleccione...</option>
                    <option value="1">Unidad</option>
                    <option value="2">Caja</option>
                  </select>
                </div>
                <div class="col-md-3" id="div-fecha">
                  <label for="fecha_lote" class="form-label">Fecha Lote</label>
                  <input name="fecha_lote" type="date" id="fecha_lote"  class="form-control">
                </div>
                <div class="col-md-3" id="div-validez">
                  <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
                  <input name="fecha_vencimiento" type="date" id="fecha_vencimiento"  class="form-control">
                </div>
                {{-- <div class="col-md-3">
                  <label for="type" class="form-label">Tipo</label>
                  <select class="form-select" name="type" id="type">
                    <option value="">Seleccione...</option>
                    @foreach ($proveedores as $proveedor )
                        <option value="@json($proveedor->id)">{{$proveedor->razon_social}}</option>
                    @endforeach
                  </select>
                </div> --}}
                <div class="col-md-3">
                  <label for="marca_id" class="form-label">Marca</label>
                  <select class="form-select" name="marca_id" id="marca_id">
                    <option value="">Seleccione...</option>
                    @foreach ($marcas as $marca )
                        <option value="@json($marca->id)">{{$marca->nombre}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="umedida_id" class="form-label">Unidad de Medida</label>
                  <select class="form-select" name="umedida_id" id="umedida_id">
                    <option value="">Seleccione...</option>
                    @foreach ($unidades as $unidad )
                        <option value="@json($unidad->id)">{{ $unidad->descripcion }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="row g-3">
                  <div class="card-footer">                        
                      <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Guardar</button>
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
            type: "POST",
            url: "{{route('materias-primas.store')}}",
            data: $(this).serialize(),            
            success: function (response) {
              window.location.href = "{{ route('materias-primas.index') }}";
            },
            error:function(response){
              laravelErrorMessages(response);
            }

          });
        });


        $('#categoria_id').on('change', function() {
          
          if( $('#categoria_id option:selected').val() == 4 || $('#categoria_id option:selected').val() == 5 ) {//SI ES FRUTA O  VERDURAS
            $('#div-fecha').hide();
            $('#div-validez').hide();
          } else {
            $('#div-fecha').show();
            $('#div-validez').show();
          }
        });
    });
</script>
@endsection