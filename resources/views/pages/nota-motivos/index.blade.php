@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Motivos de Notas de Creditos</h5>
              <a href="{{url('nota-motivos/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table table-striped datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($nota_motivos as $nota_motivo)
                    
                        <tr>
                          <td>{{$nota_motivo->id}}</td>
                          <td>{{$nota_motivo->nombre}}</td>                                                
                          <td>                        
                            <a href="{{url('nota-motivos/' . $nota_motivo->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                              <a href="{{url('nota-motivos/' . $nota_motivo->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                              <a data-bs-toggle="modal" data-bs-target="#nota_motivo_delete" data-name="{{$nota_motivo->nombre}}" data-id="{{ $nota_motivo->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
              <!-- End Table with stripped rows -->
          </div>                     
          <div class="modal fade" id="nota_motivo_delete" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Eliminar Motivo </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{route('nota-motivos.delete')}}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-body">
                    <p>Deseas eliminar el motivo <b><span id="motivo_id"></span></b>?</p>
                    <input name="motivo_id" type="hidden" id="id_motivo"/>
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
    $('#nota-motivos-menu').addClass('active');
    $('#departamento_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var motivo_id = button.data('id'); // Extraer el valor del atributo data-id
        var descripcion = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#motivo_id').text(descripcion); // Insertar el valor en el modal
        $('#id_motivo').val(motivo_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection