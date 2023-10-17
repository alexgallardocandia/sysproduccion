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
                <form method="POST" action="{{route('user.update')}}">
                @csrf
                @method('PUT')
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input name="nombre" type="text" class="form-control" id="inputText" value="{{$users->name}}" required>
                        <input name="user_id" type="hidden" class="form-control" id="inputText" value="{{$users->id}}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input name="email" type="email" class="form-control" id="inputEmail" value="{{$users->email}}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                        <input name="password" type="password" class="form-control" id="inputPassword" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Persona</label>
                        <div class="col-sm-10">
                          <div class="form-group">                                              
                            <select class="form-control select2" name="persona_id" id="persona_id">
                              <option value="@json($users->persona_id)">{{$users->persona->fullname}}</option>
                              <option value="">Seleccione...</option>
                              @foreach($personas as $persona)                              
                                <option value='{{$persona->id}}'>{{$persona->fullname}}</option>
                              @endforeach()                            
                            </select>
                          </div>                          
                        </div> 
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
    $('#referenciales-nav').addClass("show");//coloca el menu en show
    $('#users-menu').addClass("active");//coloca activo el submenu usuario
  });
</script>
@endsection