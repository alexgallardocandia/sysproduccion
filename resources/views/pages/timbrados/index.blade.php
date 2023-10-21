@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Timbrados</h5>
              <a href="{{url('timbrados/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">                                     
              <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table table-striped datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Numero</th>
                      <th scope="col">Fecha Emision</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($timbrados as $timbrado)
                    
                        <tr>
                          <td>{{$timbrado->id}}</td>
                          <td>{{$timbrado->numero}}</td>                                                
                          <td>{{$timbrado->fecha_emision}}</td>                                                
                          <td><span class="badge bg-{{config('constants.timbrado-status-label.'.$timbrado->estado)}}">{{config('constants.timbrado-status.'.$timbrado->estado)}}</span></td>                                                
                          <td>                        
                            <a href="{{url('timbrados/' . $timbrado->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                              <a href="{{url('timbrados/' . $timbrado->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                              <a data-bs-toggle="modal" data-bs-target="#timbrado_delete" data-name="{{$timbrado->numero}}" data-id="{{ $timbrado->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
              <!-- End Table with stripped rows -->
          </div>  
                   
              <div class="modal fade" id="timbrado_delete" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar timbrado </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route('timbrados.delete')}}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <p>Deseas eliminar el timbrado <b><span id="timbrado_id"></span></b>?</p>
                        <input name="timbrado_id" type="hidden" id="id_timbrado"/>
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
    $('#referenciales-nav').addClass("show");//coloca el menu en show
    $('#timbrados-menu').addClass("active");//coloca activo el submenu usuario
    $('#timbrado_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var timbrado_id = button.data('id'); // Extraer el valor del atributo data-id
        var numero = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#timbrado_id').text(numero); // Insertar el valor en el modal
        $('#id_timbrado').val(timbrado_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection