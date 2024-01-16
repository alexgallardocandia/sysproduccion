@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Usuario {{$users->name}}</h5>              
            </div>
            <div class="card-body">                   
                <form class="row g-3" method="POST" action="{{route('user.update')}}">
                @csrf
                @method('PUT')
                    <div class="col-md-3">
                        <label for="inputEmail3" class="form-label">Nombre</label>
                        <input name="nombre" type="text" class="form-control" id="inputText" value="{{$users->name}}" required>
                        <input name="user_id" type="hidden" class="form-control" id="inputText" value="{{$users->id}}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="inputEmail3" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" id="inputEmail" value="{{$users->email}}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="inputPassword3" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="inputPassword">
                    </div>
                    <div class="col-md-3">
                      <label for="empleado_id" class="form-label">Empleado</label>
                          <div class="form-group">                                              
                            <select class="form-control select2" name="empleado_id" id="empleado_id">
                              <option value="@json($users->empleado_id)">{{$users->empleado->fullname}}</option>
                              <option value="">Seleccione...</option>
                              @foreach($empleados as $empleado)                              
                                <option value='{{$empleado->id}}'>{{$empleado->fullname}}</option>
                              @endforeach()                            
                            </select>
                          </div>
                    </div>
                    <div class="col-md-12">
                      <label for="permission_id" class="form-label">Permisos</label>
                      <select class="form-select" name="permission_id[]" id="multiple-select-optgroup-field" data-placeholder="Seleccionar Permisos" multiple>
                        @foreach ($permisos as $description => $value)
                          <optgroup label="{{ $description }}">
                            @foreach ($value as $key => $permission)
                              <option value="{{$permission->id}}" {{ in_array($permission->id, $users->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>{{$permission->display_name}}</option>
                            @endforeach
                          </optgroup>
                        @endforeach
                      </select>
                    </div>
                    <div class="">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Modificar</button>
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
    $('#configuraciones-nav').addClass("show");//coloca el menu en show
    $('#users-menu').addClass("active");//coloca activo el submenu usuario
    $('#multiple-select-optgroup-field').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        closeOnSelect: false,
    });
  });
</script>
@endsection