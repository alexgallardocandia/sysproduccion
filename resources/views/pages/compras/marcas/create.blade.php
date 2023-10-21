@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Crear Marca</h5>              
            </div>
            <div class="card-body">                                  
                <form id="form">
                @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input name="nombre" type="text" class="form-control">
                        </div>
                    </div>                    
                    <div class="card-footer">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Guardar</button>
                        <a href="{{url('marcas')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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
        $('#marcas-menu').addClass("active");//coloca activo el submenu usuario

        $('#form').on('submit', function(e){
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "{{route('marcas.store')}}",
            data: $(this).serialize(),            
            success: function (response) {
              window.location.href = "{{ route('marcas.index') }}";
            },
            error:function(data){
              laravelErrorMessages(data);
            }
          });
        });
    });
</script>
@endsection