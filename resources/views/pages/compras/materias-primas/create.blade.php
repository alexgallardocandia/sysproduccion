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
                <form method="POST" action="{{route('materias-primas.store')}}">
                @csrf
                  <div class="form-group">
                    <div class="row mb-3">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Descripcion</label>
                      <div class="col-sm-4">
                        <input name="descripcion" type="text" class="form-control" required>
                      </div>
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Cantidad</label>
                      <div class="col-sm-4">
                        <input name="cantidad" type="number" class="form-control" required>
                      </div>                      
                    </div>                    
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-4">
                          <input name="precio" type="number" class="form-control" required>
                        </div>
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha de Lote</label>
                        <div class="col-sm-4">
                          <input name="fecha_lote" type="date" class="form-control" required>
                        </div>                                                                 
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha de Vencimiento</label>
                        <div class="col-sm-4">
                          <input name="fecha_vencimiento" type="date" class="form-control" required>
                        </div>                                             
                    
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Unidad de Medida</label>
                        <div class="col-sm-4">
                          <div class="form-group">                                              
                            <select class="form-control select2" name="umedida_id" id="umedida_id">
                              @foreach($unidades as $unidad)                              
                                <option value='{{$unidad->id}}'>{{$unidad->descripcion}}</option>
                              @endforeach()                            
                            </select>
                          </div>                          
                        </div>                                             
                    </div>
                       
                  <div class="card-footer">                        
                      <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Guardar</button>
                      <a href="{{url('materias-primas')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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
        $('#compras-nav').addClass("show");//coloca el menu en show
        $('#materias-menu').addClass("active");//coloca activo el submenu usuario
    });
</script>
@endsection