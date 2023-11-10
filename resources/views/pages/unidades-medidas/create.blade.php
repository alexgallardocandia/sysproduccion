@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Crear Unidad de Medida</h5>              
            </div>
            <div class="card-body">                                  
                <form method="POST" action="{{route('unidades-medidas.store')}}">
                @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                        <input name="descripcion" type="text" class="form-control" required>
                        </div>
                    </div>  
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Abreviatura</label>
                        <div class="col-sm-10">
                        <input name="signo" type="text" class="form-control" required>
                        </div>
                    </div>                    
                    <div class="card-footer">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Guardar</button>
                        <a href="{{url('unidades-medidas')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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
        $('#unidades-menu').addClass("active");//coloca activo el submenu usuario
    });
    </script>
@endsection