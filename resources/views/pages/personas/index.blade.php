@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Personas</h5>
              <a href="{{url('personas/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">                                     
              <!-- Table with stripped rows -->
              <table class="table ">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($personas as $persona)                  
                      <tr>
                        <td>{{$persona->id}}</td>
                        <td>{{$persona->descripcion}}</td>                                                
                        <td>                        
                          <a href="{{url('personas/' . $persona->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                            <a href="{{url('personas/' . $persona->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#persona_delete" data-name="{{$persona->descripcion}}" data-id="{{ $persona->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
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
                    <form method="POST" action="{{route('personas.delete')}}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <p>Deseas eliminar el persona <b><span id="persona_id"></span></b>?</p>
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
    $('#persona_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var persona_id = button.data('id'); // Extraer el valor del atributo data-id
        var descripcion = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#persona_id').text(descripcion); // Insertar el valor en el modal
        $('#id_persona').val(persona_id); // Insertar el valor en el modal        
    });
</script>
@endsection