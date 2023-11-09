@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Crear Timbrado</h5>              
            </div>
            <div class="card-body">                                  
                <form class="row g-3" method="POST" action="{{route('timbrados.store')}}">
                  @csrf
                    <div class="col-md-3">
                      <label for="numero" class="form-label">Numero</label>
                      <input name="numero" type="text" class="form-control" format-number required>
                    </div>
                    <div class="col-md-3">
                      <label for="proveedor_id" class="form-label"><b>Proveedor</b></label>
                      <select class="form-control" name="proveedor_id" id="proveedor_id">
                        @foreach ($proveedores as $prov)
                          <option value="@json($prov->id)">{{ $prov->razon_social }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="inputEmail3" class="form-label"><b>Fecha de Emision</b></label>
                      <input name="fecha_emision" type="date" id="fecha_mision" max="{{date('Y-m-d')}}" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                      <label for="inputEmail3" class="form-label"><b>Fecha de Vencimiento</b></label>
                      <input name="fecha_vencimiento" type="date" id="fecha_venimiento" min="{{date('Y-m-d')}}" class="form-control" required>
                    </div>
                    <div class="card-footer">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Guardar</button>
                        <a href="{{url('timbrados')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
                    </div>
                </form><!-- End Horizontal Form -->
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
      $('#referenciales-nav').addClass("show");//coloca el menu en show
      $('#timbrados-menu').addClass("active");//coloca activo el submenu usuario
    });
      flatpickr("#fecha_vencimiento",{
        minDate: "today", // Impide seleccionar fechas anteriores a la actual
        dateFormat: "d-m-Y", // Formato de fecha
      });
      flatpickr("#fecha_emision",{
        maxDate: "today", // Impide seleccionar fechas mayores a la actual
        dateFormat: "d-m-Y", // Formato de fecha
      });
  </script>
@endsection