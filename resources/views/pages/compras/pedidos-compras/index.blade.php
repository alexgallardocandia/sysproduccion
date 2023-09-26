@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Pedidos de Compras</h5>
              <a href="{{url('pedidos-compras/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">                                     
              <!-- Table with stripped rows -->
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pedidosc as $pedidoc)                  
                      <tr>
                        <td>{{$pedidoc->id}}</td>
                        <td>{{Carbon\Carbon::createFromFormat('Y-m-d', $pedidoc->fecha_pedido)->format('d/m/Y')}}</td>                                               
                        <td><span class="badge bg-{{ config('constants.pedidos-compras-prioridad-label.' . intval($pedidoc->prioridad)) }}">{{ config('constants.pedidos-compras-prioridad.'. intval($pedidoc->prioridad)) }}</span></td>
                        <td>{{$pedidoc->user->name}}</td>                                               
                        <td><span class="badge bg-{{ config('constants.pedidos-compras-status-label.' . intval($pedidoc->estado)) }}">{{ config('constants.pedidos-compras-status.'. intval($pedidoc->estado)) }}</span></td>
                        <td>                        
                          <a href="{{url('pedidos-compras/' . $pedidoc->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                            <a href="{{url('pedidos-compras/' . $pedidoc->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#pedidoc_delete" data-name="{{$pedidoc->descripcion}}" data-id="{{ $pedidoc->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
              <!-- End Table with stripped rows -->
          </div>  
                   
              <div class="modal fade" id="pedidoc_delete" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar pedidoc </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route('pedidos-compras.delete')}}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <p>Deseas eliminar la pedidoc <b><span id="pedidoc_id"></span></b>?</p>
                        <input name="pedidoc_id" type="hidden" id="id_pedidoc"/>
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
    $('#pedidos-compras-menu').addClass('active');
    $('#pedidoc_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var pedidoc_id = button.data('id'); // Extraer el valor del atributo data-id
        var descripcion = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#pedidoc_id').text(descripcion); // Insertar el valor en el modal
        $('#id_pedidoc').val(pedidoc_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection