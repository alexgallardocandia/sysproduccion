@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Ciudades</h5>
              <a href="{{url('ciudades/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">                                     
              <!-- Table with stripped rows -->
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($ciudades as $ciudad)                  
                      <tr>
                        <td>{{$ciudad->id}}</td>
                        <td>{{$ciudad->descripcion}}</td>                                                
                        <td>                        
                          <a href="{{url('ciudades/' . $ciudad->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                            <a href="{{url('ciudades/' . $ciudad->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#ciudad_delete" data-name="{{$ciudad->descripcion}}" data-id="{{ $ciudad->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
              <!-- End Table with stripped rows -->
          </div>  
                   
              <div class="modal fade" id="ciudad_delete" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar ciudad </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route('ciudades.delete')}}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <p>Deseas eliminar el ciudad <b><span id="ciudad_id"></span></b>?</p>
                        <input name="ciudad_id" type="hidden" id="id_ciudad"/>
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
    $('#ciudades-menu').addClass('active');
    $('#ciudad_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var ciudad_id = button.data('id'); // Extraer el valor del atributo data-id
        var descripcion = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#ciudad_id').text(descripcion); // Insertar el valor en el modal
        $('#id_ciudad').val(ciudad_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection