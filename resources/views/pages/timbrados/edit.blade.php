@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Timbrado</h5>              
            </div>
            <div class="card-body">                                  
                <form method="POST" action="{{route('timbrados.update')}}">
                @csrf
                @method('PUT')
                    <div class="row mb-2">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Numero</b></label>
                        <div class="col-sm-3">
                        <input name="numero" type="number" min="100" class="form-control" value="{{$timbrado->numero}}" required>
                        <input name="timbrado_id" type="hidden" class="form-control" value="{{$timbrado->id}}" required>
                        </div>
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Tipo</b></label>
                        <div class="col-sm-3">
                            <select class="form-control" name="tipo" id="tipo">
                              <option value="{{$timbrado->tipo}}" selected>{{config('constants.timbrado-type.'.$timbrado->tipo)}}</option>
                              <option value="1">Compra</option>
                              <option value="2">Venta</option>
                            </select>                          
                        </div>
                    </div>     
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Fecha de Emision</b></label>
                        <div class="col-sm-3">
                        <input name="fecha_emision" type="date" id="fecha_mision" class="form-control" value="{{$timbrado->fecha_emision}}" required>
                        </div>
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Fecha de Vencimiento</b></label>
                        <div class="col-sm-3">
                        <input name="fecha_vencimiento" type="date" id="fecha_venimiento" class="form-control" value="{{$timbrado->fecha_vencimiento}}" required>
                        </div>
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