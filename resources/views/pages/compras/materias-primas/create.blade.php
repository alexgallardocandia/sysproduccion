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
                  <label for="fecha" class="form-label">Fecha</label>
                  <input name="fecha" type="date" id="fecha"  class="form-control" required>
                </div>
                <div class="col-md-3">
                  <label for="validez" class="form-label">Validez</label>
                  <input name="validez" type="date" id="validez"  class="form-control" required>
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
                  <label for="categoria_id" class="form-label">Categoria</label>
                  <select class="form-select" name="categoria_id" id="categoria_id">
                    <option value="">Seleccione...</option>
                    {{-- @foreach ($proveedores as $proveedor )
                        <option value="@json($proveedor->id)">{{$proveedor->razon_social}}</option>
                    @endforeach --}}
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="marca_id" class="form-label">Marca</label>
                  <select class="form-select" name="marca_id" id="marca_id">
                    <option value="">Seleccione...</option>
                    {{-- @foreach ($proveedores as $proveedor )
                        <option value="@json($proveedor->id)">{{$proveedor->razon_social}}</option>
                    @endforeach --}}
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="umedida_id" class="form-label">Unidad de Medida</label>
                  <select class="form-select" name="umedida_id" id="umedida_id">
                    <option value="">Seleccione...</option>
                    {{-- @foreach ($pedidos_compras as $pedido )
                        <option value="@json($pedido->id)">{{$pedido->id.' | '.$pedido->user->persona->fullname.' | '.$pedido->fecha_pedido}}</option>
                    @endforeach --}}
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
                
    });
</script>
@endsection