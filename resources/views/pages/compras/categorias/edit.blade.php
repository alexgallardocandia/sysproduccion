@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Categoria {{$categoria->nombre}}</h5>              
            </div>
            <div class="card-body">                   
                <form id="form">
                @csrf                
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input name="nombre" type="text" class="form-control" id="inputText" value="{{$categoria->nombre}}" required>
                        <input name="categoria_id" type="hidden" class="form-control" id="inputText" value="{{$categoria->id}}" required>
                        </div>
                    </div>  
                    <div class="">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Modificar</button>
                        <a href="{{url('categorias')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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
        $('#categorias-menu').addClass("active");//coloca activo el submenu usuario

        $('#form').on('submit', function(e) {
          e.preventDefault();

          $.ajax({
            type: "PUT",
            url: "{{route('categorias.update')}}",
            data: $(this).serialize(),
            success: function (response) {
              window.location.href = "{{ route('categorias.index') }}";
            },
            error: function(response) {
              laravelErrorMessages(data);
            }
          });
        });
    });
</script>
@endsection