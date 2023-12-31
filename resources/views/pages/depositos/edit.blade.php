@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Deposito</h5>              
            </div>
            <div class="card-body">                                  
                <form method="POST" action="{{route('depositos.update')}}">
                @csrf
                @method('PUT')
                    <div class="row mb-3">
                        <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="">
                        <input name="descripcion" type="text" class="form-control" value="{{$deposito->descripcion}}" required>
                        <input name="deposito_id" type="hidden" class="form-control" value="{{$deposito->id}}" required>
                        </div>
                        <label for="sucursal_id" class="col-sm-2 col-form-label">Sucursal</label>
                        <div class="">
                          <div class="form-group">                                              
                            <select class="form-control select2" name="sucursal_id" id="sucursal_id">
                              @foreach($sucursales as $sucursal)                              
                                <option value='{{$sucursal->id}}'>{{$sucursal->descripcion}}</option>
                              @endforeach()
                            </select>
                          </div>                          
                        </div>   
                    </div>                    
                    <div class="card-footer">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Guardar</button>
                        <a href="{{url('depositos')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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
        $('#depositos-menu').addClass("active");//coloca activo el submenu usuario
    });
</script>
@endsection