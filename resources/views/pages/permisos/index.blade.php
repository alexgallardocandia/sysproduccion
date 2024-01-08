@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Permisos</h5>
              <a href="{{url('permisos/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">            
              <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table table-striped datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Nombre a mostrar</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($permisos as $permiso)
                    
                        <tr>
                          <td>{{$permiso->id}}</td>
                          <td>{{$permiso->name}}</td>                                                
                          <td>{{$permiso->display_name}}</td>                                                
                          <td>{{$permiso->description}}</td>                                                
                          <td>                        
                            <a href="{{url('permisos/' . $permiso->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                              <a href="{{url('permisos/' . $permiso->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                              <a data-bs-toggle="modal" data-bs-target="#permiso_delete" data-name="{{$permiso->descripcion}}" data-id="{{ $permiso->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
              <!-- End Table with stripped rows -->
          </div>               
          <div class="modal fade" id="permiso_delete" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Eliminar cargo </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{route('permisos.delete')}}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-body">
                    <p>Deseas eliminar el cargo <b><span id="permiso_id"></span></b>?</p>
                    <input name="permiso_id" type="hidden" id="id_permiso"/>
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
  $(document).ready(function(){
    $('#referenciales-nav').addClass('show');
    $('#cargos-menu').addClass('active');
    $('#cargo_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var permiso_id = button.data('id'); // Extraer el valor del atributo data-id
        var descripcion = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#permiso_id').text(descripcion); // Insertar el valor en el modal
        $('#id_permiso').val(permiso_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection