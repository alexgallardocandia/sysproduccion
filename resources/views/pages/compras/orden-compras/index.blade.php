@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Ordenes de Compras</h5>
              {{-- @permission('orden-compras.create')
                <a href="{{url('orden-compras/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
              @endpermission --}}
            </div>
            <div class="card-body">                                     
              <div class="table-responsive">
                <table class="table table-striped datatable">
                  <thead>
                    <tr>
                      <th scope="col">Nro.</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">Solicitante</th>
                      <th scope="col">Autorizado por</th>
                      <th scope="col">Proveedor</th>
                      <th scope="col">Monto</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orden_compra as $orden_compra)  
                        <tr>
                          <td>{{$orden_compra->id}}</td>
                          <td>{{$orden_compra->fecha}}</td>
                          <td>{{$orden_compra->solicitante->fullname}}</td>
                          <td>{{$orden_compra->autorizador_id ? $orden_compra->autorizador->fullname : ''  }}</td>
                          <td>{{$orden_compra->presupuesto_compra->proveedor->razon_social}}</td>
                          <td>{{number_format($orden_compra->getTotalDetalles(), 0, ',', '.')}}</td>
                          <td><span class="badge bg-{{ config('constants.orden-compras-status-label.' . intval($orden_compra->estado)) }}">{{ config('constants.orden-compras-status.'. intval($orden_compra->estado)) }}</span></td>
                          <td> 
                            @if ($orden_compra->estado == 2)
                              <a href="{{url('orden-compras/' . $orden_compra->id)}}"><i class="bi bi-info-circle-fill"></i></a>
                              <a href="{{url('orden-compras/' . $orden_compra->id . '/pdf')}}" target="new"><i class="bi bi-file-pdf-fill"></i></a>
                            @endif
                            @if ($orden_compra->estado == 3)
                              <a href="{{url('orden-compras/' . $orden_compra->id)}}"><i class="bi bi-info-circle-fill"></i></a>
                            @endif
                            @if ($orden_compra->estado != 2 && $orden_compra->estado != 3)
                              @permission('orden-compras.aprove')
                                <a data-bs-toggle="modal" data-bs-target="#orden_aprove" data-number="{{$orden_compra->id}}" data-id="{{ $orden_compra->id }}"><i class="bi bi-check-circle-fill"></i></a>
                              @endpermission
                              <a href="{{url('orden-compras/' . $orden_compra->id)}}"><i class="bi bi-info-circle-fill"></i></a>
                              {{-- <a href="{{url('orden-compras/' . $orden_compra->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a> --}}
                              <a data-bs-toggle="modal" data-bs-target="#orden_delete" data-number="{{$orden_compra->id}}" data-id="{{ $orden_compra->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                            @endif   
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>     
          {{-- MODAL RECHAZAR --}}
            <div class="modal fade" id="orden_delete" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Rechazar Orden </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="POST" action="{{route('orden-compras.delete')}}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                      <p>Deseas rechazar la orden Nro. <b><span id="orden_id"></span></b>?</p>
                      <input name="orden_id" type="hidden" id="id_orden"/>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary">Si</button>
                    </div>
                  </form>                    
                </div>
              </div>
            </div>
          {{-- MODAL RECHAZAR --}}
          {{-- MODAL APROBAR --}}
            <div class="modal fade" id="orden_aprove" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Aprobar Orden </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="POST" action="{{route('orden-compras.aprove')}}">
                    @csrf
                    <div class="modal-body">
                      <p>Deseas aprobar la orden Nro. <b><span id="orden_id"></span></b>?</p>
                      <input name="orden_id" type="hidden" id="id_orden_aprove"/>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary">Si</button>
                    </div>
                  </form>                    
                </div>
              </div>
            </div>
          {{-- MODAL APROBAR --}}

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
    $('#orden-compras-menu').addClass('active');

    $('#orden_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var orden_id = button.data('id'); // Extraer el valor del atributo data-id
        var number = button.data('number'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#orden_id').text(number); // Insertar el valor en el modal
        $('#id_orden').val(orden_id); // Insertar el valor en el modal        
    });

    $('#orden_aprove').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var orden_id = button.data('id'); // Extraer el valor del atributo data-id
        var number = button.data('number'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#orden_id').text(number); // Insertar el valor en el modal
        $('#id_orden_aprove').val(orden_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection