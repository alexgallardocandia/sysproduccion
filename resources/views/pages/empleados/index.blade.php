@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Empleados</h5>
              <a href="{{url('empleados/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">                                     
              <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table table-striped datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombres y Apellidos</th>
                      <th scope="col">Direccion</th>
                      <th scope="col">Telefono</th>
                      <th scope="col">E-mail</th>
                      <th scope="col">Fecha Nacimiento</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($personas as $persona)                  
                        <tr>
                          <td>{{$persona->id}}</td>
                          <td>{{$persona->fullname}}</td>
                          <td>{{$persona->direccion}}</td>                                               
                          <td>{{$persona->telefono}}</td>                                               
                          <td>{{$persona->email}}</td>                                             
                          <td>{{$persona->fecha_nacimiento}}</td>                                               
                          <td>                        
                            <a href="{{url('empleados/' . $persona->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                              <a href="{{url('empleados/' . $persona->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                              <a data-bs-toggle="modal" data-bs-target="#persona_delete" data-name="{{$persona->fullname}}" data-id="{{ $persona->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
              <!-- End Table with stripped rows -->
          </div>  
                   
              <div class="modal fade" id="persona_delete" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar persona </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route('empleados.delete')}}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <p>Deseas eliminar la persona <b><span id="persona_id"></span></b>?</p>
                        <input name="persona_id" type="hidden" id="id_persona"/>
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
    $('#personas-menu').addClass('active');
    $('#persona_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var persona_id = button.data('id'); // Extraer el valor del atributo data-id
        var descripcion = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#persona_id').text(descripcion); // Insertar el valor en el modal
        $('#id_persona').val(persona_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection