@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Materias Primas</h5>
              <a href="{{url('materias-primas/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">                                     
              <!-- Table with stripped rows -->
              <table class="table ">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Fecha Vencimiento</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($materias as $materia)                  
                      <tr>
                        <td>{{$materia->id}}</td>
                        <td>{{$materia->descripcion}}</td>                                               
                        <td>{{$materia->cantidad}}  <b>{{$materia->umedida->signo}}</b></td>
                        <td>{{$materia->precio}}</td>                                               
                        <td>{{$materia->fecha_vencimiento}}</td>                                               
                        <td>                        
                          <a href="{{url('materias-primas/' . $materia->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                            <a href="{{url('materias-primas/' . $materia->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#materia_delete" data-name="{{$materia->descripcion}}" data-id="{{ $materia->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
              <!-- End Table with stripped rows -->
          </div>  
                   
              <div class="modal fade" id="materia_delete" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar materia </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route('materias-primas.delete')}}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <p>Deseas eliminar la materia <b><span id="materia_id"></span></b>?</p>
                        <input name="materia_id" type="hidden" id="id_materia"/>
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
    $('#compras-nav').addClass('show');
    $('#materias-menu').addClass('active');
    $('#materia_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var materia_id = button.data('id'); // Extraer el valor del atributo data-id
        var descripcion = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#materia_id').text(descripcion); // Insertar el valor en el modal
        $('#id_materia').val(materia_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection