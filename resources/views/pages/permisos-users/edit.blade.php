@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Permiso #{{$permiso->id}}</h5>              
            </div>
            <div class="card-body">                                  
                <form id="form">
                @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input name="name" type="text" class="form-control" value="{{$permiso->name}}">
                        <input name="permiso_id" type="hidden" class="form-control" value="{{$permiso->id}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                      <label for="display_name" class="col-sm-2 col-form-label">Nombre a Mostrar</label>
                      <div class="col-sm-10">
                      <input name="display_name" type="text" class="form-control" value="{{$permiso->display_name}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="description" class="col-sm-2 col-form-label">Descripcion</label>
                      <div class="col-sm-10">
                      <input name="description" type="text" class="form-control" value="{{$permiso->description}}">
                      </div>
                    </div>               
                    <div class="card-footer">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Modificar</button>
                        <a href="{{url('permisos')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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
        $('#configuraciones-nav').addClass("show");//coloca el menu en show
        $('#permisos-menu').addClass("active");//coloca activo el submenu usuario

        $('#form').on('submit', function(e){
          e.preventDefault();
          $.ajax({
            type: "PUT",
            url: "{{route('permisos.update')}}",
            data: $(this).serialize(),            
            success: function (response) {
              window.location.href = "{{ route('permisos.index') }}";
            },
            error:function(data){
              laravelErrorMessages(data);
            }
          });
        });
    });
</script>
@endsection