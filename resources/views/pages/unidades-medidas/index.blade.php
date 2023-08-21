@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Unidades de Medida</h5>
              <a href="{{url('unidades-medidas/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">                                     
              <!-- Table with stripped rows -->
              <table class="table ">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Abreviatura</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($unidades as $unidad)
                  
                      <tr>
                        <td>{{$unidad->id}}</td>
                        <td>{{$unidad->descripcion}}</td>                                                
                        <td>{{$unidad->signo}}</td>                                                
                        <td>                        
                          <a href="{{url('unidades-medidas/' . $unidad->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                            <a href="{{url('unidades-medidas/' . $unidad->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#unidad_delete" data-name="{{$unidad->descripcion}}" data-id="{{ $unidad->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
              <!-- End Table with stripped rows -->
          </div>  
                   
              <div class="modal fade" id="unidad_delete" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar unidad </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route('unidades-medidas.delete')}}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <p>Deseas eliminar la unidad <b><span id="unidad_id"></span></b>?</p>
                        <input name="unidad_id" type="hidden" id="id_unidad"/>
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
  $( document ).ready(function() {
    $('#referenciales-nav').addClass("show");//coloca el menu en show
    $('#unidades-menu').addClass("active");//coloca activo el submenu usuario
    $('#unidad_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var unidad_id = button.data('id'); // Extraer el valor del atributo data-id
        var descripcion = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#unidad_id').text(descripcion); // Insertar el valor en el modal
        $('#id_unidad').val(unidad_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection