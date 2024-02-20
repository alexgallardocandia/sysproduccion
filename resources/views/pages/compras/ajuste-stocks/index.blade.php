@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Ajuste de Stock</h5>
              @permission('ajuste-stocks.create')
                <a href="{{url('ajuste-stocks/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
              @endpermission
            </div>
            <div class="card-body">                                     
              <div class="table-responsive">
                <table class="table table-striped datatable">
                  <thead>
                    <tr>
                      <th scope="col">Nro.</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">Almacen</th>
                      <th scope="col">Creado Por</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($ajuste_stocks as $ajuste_stock)  
                        <tr>
                          <td>{{$ajuste_stock->id}}</td>
                          <td>{{$ajuste_stock->fecha}}</td>
                          <td>{{$ajuste_stock->almacen->descripcion}}</td>
                          <td>{{$ajuste_stock->user->empleado->fullname}}</td>
                          <td><span class="badge bg-{{ config('constants.ajuste-stocks-status-label.'.$ajuste_stock->estado) }}">{{ config('constants.ajuste-stocks-status.'.$ajuste_stock->estado) }}</span></td>
                          <td align="center"> 
                            @if ($ajuste_stock->estado == 1)
                              <a href="{{url('ajuste-stocks/' . $ajuste_stock->id)}}"><i class="bi bi-info-circle-fill"></i></a>
                              <a href="{{url('ajuste-stocks/' . $ajuste_stock->id . '/pdf')}}" target="new"><i class="bi bi-file-pdf-fill"></i></a>
                              <a data-bs-toggle="modal" data-bs-target="#ajuste_delete" data-number="{{$ajuste_stock->id}}" data-id="{{ $ajuste_stock->id }}"><i class="bi bi-trash-fill"></i></a>
                            @endif
                            @if ($ajuste_stock->estado == 3)
                              <a href="{{url('compras/' . $ajuste_stock->id)}}"><i class="bi bi-info-circle-fill"></i></a>
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
            <div class="modal fade" id="ajuste_delete" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Anular Ajuste </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="POST" action="{{route('ajuste-stocks.delete')}}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                      <p>Deseas anular el ajuste Nro. <b><span id="ajuste_id"></span></b>?</p>
                      <input name="ajuste_id" type="hidden" id="id_ajuste"/>
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
                      <p>Deseas aprobar la orden Nro. <b><span id="ajuste_id"></span></b>?</p>
                      <input name="ajuste_id" type="hidden" id="id_ajuste_aprove"/>
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
    $('#ajuste-stocks-menu').addClass('active');

    $('#ajuste_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var ajuste_id = button.data('id'); // Extraer el valor del atributo data-id
        var number = button.data('number'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#ajuste_id').text(number); // Insertar el valor en el modal
        $('#id_ajuste').val(ajuste_id); // Insertar el valor en el modal        
    });

    $('#orden_aprove').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var ajuste_id = button.data('id'); // Extraer el valor del atributo data-id
        var number = button.data('number'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#ajuste_id').text(number); // Insertar el valor en el modal
        $('#id_ajuste_aprove').val(ajuste_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection