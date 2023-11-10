@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Crear Usuario</h5>              
            </div>
            <div class="card-body">                                  
                <form class="row g-3" id="form">
                @csrf
                    <div class="col-md-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input name="nombre" type="text" class="form-control" id="inputText" required>
                    </div>
                    <div class="col-md-3">
                      <label for="email" class="form-label">Email</label>
                      <input name="email" type="email" class="form-control" id="inputEmail" required>
                    </div>
                    <div class="col-md-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="inputPassword" required>
                    </div>
                    <div class="col-md-3">
                      <label for="empleado_id" class="form-label">Empleado</label>
                          <div class="form-group">                                              
                            <select class="form-control select2" name="empleado_id" id="empleado_id">
                              <option value="">Seleccione...</option>
                              @foreach($empleados as $empleado)                              
                                <option value='{{$empleado->id}}'>{{$empleado->fullname}}</option>
                              @endforeach()                            
                            </select>
                          </div>
                    </div>
                    <div class="">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Guardar</button>
                        <a href="{{url('users')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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
    $('#referenciales-nav').addClass("show");
    $('#users-menu').addClass("active");

    $('#form').on('submit', function(e){
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "{{route('users.store')}}",
            data: $(this).serialize(),            
            success: function (response) {
              window.location.href = "{{ route('users.index') }}";
            },
            error:function(data){
              laravelErrorMessages(data);
            }
          });
        });
  });
</script>
@endsection