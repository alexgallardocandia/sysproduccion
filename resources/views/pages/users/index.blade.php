@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Usuarios</h5>
              <a href="{{url('users/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">                                     
              <!-- Table with stripped rows -->
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($usuarios as $usuario)
                  
                      <tr>
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td><span class="badge bg-{{ config('constants.users-status-label.' . intval($usuario->status)) }}">{{ config('constants.users-status.'. intval($usuario->status)) }}</span></td>                        
                        <td>                        
                          <a href="{{url('users/' . $usuario->id)}}"><i class="bi bi-info-circle-fill"></i></a>
                          @if($usuario->status == 1)
                            <a href="{{url('users/' . $usuario->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#user_delete" data-name="{{$usuario->name}}" data-id="{{ $usuario->id }}"><i class="bi bi-trash-fill"></i></a>                          
                          @endif
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
              <!-- End Table with stripped rows -->
          </div>  
                   
              <div class="modal fade" id="user_delete" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Inactivar Usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route('user.delete')}}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <p>Deseas inactivar el usuario <b><span id="userId"></span></b></p>
                        <input name="id_usuario" type="hidden" id="id_usuario"/>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Si</button>
                      </div>
                    </form>                    
                  </div>
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
    $('#user_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var userId = button.data('id'); // Extraer el valor del atributo data-id
        var username = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#userId').text(username); // Insertar el valor en el modal
        $('#id_usuario').val(userId); // Insertar el valor en el modal
        console.log(userId);
    });
  });
</script>
@endsection