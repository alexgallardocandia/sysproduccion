@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Cargos</h5>
              <a href="{{url('cargos/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
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
                  @foreach ($cargos as $cargo)
                  
                      <tr>
                        <td>{{$cargo->id}}</td>
                        <td>{{$cargo->descripcion}}</td>                                                
                        <td>                        
                          <a href="{{url('cargos/' . $cargo->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                            <a href="{{url('cargos/' . $cargo->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#cargo_delete" data-name="{{$cargo->descripcion}}" data-id="{{ $cargo->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
              <!-- End Table with stripped rows -->
          </div>  
                   
              <div class="modal fade" id="cargo_delete" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar cargo </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route('cargos.delete')}}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <p>Deseas eliminar el cargo <b><span id="cargo_id"></span></b>?</p>
                        <input name="cargo_id" type="hidden" id="id_cargo"/>
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
        var cargo_id = button.data('id'); // Extraer el valor del atributo data-id
        var descripcion = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#cargo_id').text(descripcion); // Insertar el valor en el modal
        $('#id_cargo').val(cargo_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection