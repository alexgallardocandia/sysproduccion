@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Compras</h5>
              @permission('compras.create')
                <a href="{{url('compras/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
              @endpermission
            </div>
            <div class="card-body">                                     
              <div class="table-responsive">
                <table class="table table-striped datatable">
                  <thead>
                    <tr>
                      <th scope="col">Nro.</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">Timbrado</th>
                      <th scope="col">Nro de Factura</th>
                      <th scope="col">Proveedor</th>
                      <th scope="col">Monto</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($compras as $compra)  
                        <tr>
                          <td>{{$compra->id}}</td>
                          <td>{{$compra->fecha}}</td>
                          <td>{{$compra->timbrado}}</td>
                          <td>{{$compra->nro_factura}}</td>
                          <td>{{$compra->proveedor->razon_social}}</td>
                          <td>{{number_format($compra->getTotalDetalles(), 0, ',', '.')}}</td>
                          <td><span class="badge bg-{{ config('constants.compras-status-label.' . intval($compra->estado)) }}">{{ config('constants.compras-status.'. intval($compra->estado)) }}</span></td>
                          <td> 
                            @if ($compra->estado == 2)
                              <a href="{{url('compras/' . $compra->id)}}"><i class="bi bi-info-circle-fill"></i></a>
                              <a href="{{url('compras/' . $compra->id . '/pdf')}}" target="new"><i class="bi bi-file-pdf-fill"></i></a>
                              {{-- <a data-bs-toggle="modal" data-bs-target="#compra_delete" data-number="{{$compra->id}}" data-id="{{ $compra->id }}"><i class="bi bi-trash-fill"></i></a> --}}
                            @endif
                            @if ($compra->estado == 3)
                              <a href="{{url('compras/' . $compra->id)}}"><i class="bi bi-info-circle-fill"></i></a>
                            @endif
                            {{-- @if ($compra->estado != 2 && $compra->estado != 3)
                              @permission('compras.aprove')
                                <a data-bs-toggle="modal" data-bs-target="#orden_aprove" data-number="{{$compra->id}}" data-id="{{ $compra->id }}"><i class="bi bi-check-circle-fill"></i></a>
                              @endpermission
                              <a href="{{url('compras/' . $compra->id)}}"><i class="bi bi-info-circle-fill"></i></a>
                              {{-- <a href="{{url('orden-compras/' . $compra->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a> --}}
                           {{-- @endif    --}}
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>     
          {{-- MODAL RECHAZAR --}}
            <div class="modal fade" id="compra_delete" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Anular Compra </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="POST" action="{{route('compras.delete')}}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                      <p>Deseas anular la compra Nro. <b><span id="compra_id"></span></b>?</p>
                      <input name="compra_id" type="hidden" id="id_compra"/>
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
                      <p>Deseas aprobar la orden Nro. <b><span id="compra_id"></span></b>?</p>
                      <input name="compra_id" type="hidden" id="id_compra_aprove"/>
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
    $('#compras-menu').addClass('active');

    $('#compra_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var compra_id = button.data('id'); // Extraer el valor del atributo data-id
        var number = button.data('number'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#compra_id').text(number); // Insertar el valor en el modal
        $('#id_compra').val(compra_id); // Insertar el valor en el modal        
    });

    $('#orden_aprove').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var compra_id = button.data('id'); // Extraer el valor del atributo data-id
        var number = button.data('number'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#compra_id').text(number); // Insertar el valor en el modal
        $('#id_compra_aprove').val(compra_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection