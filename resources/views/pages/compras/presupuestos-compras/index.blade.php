@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Presupuestos de Compras</h5>
              <a href="{{url('presupuestos-compras/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">                                     
              <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table table-striped datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Numero</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">Validez</th>
                      <th scope="col">Proveedor</th>
                      <th scope="col">Monto</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($presupuestos as $presupuesto)                  
                        <tr>
                          <td>{{$presupuesto->id}}</td>
                          <td>{{number_format($presupuesto->numero, 0, ',','.')}}</td>
                          <td>{{$presupuesto->fecha}}</td>
                          @dd($presupuesto->ValidezBool)
                          <td>{{$presupuesto->validez}} <span class="badge bg-{{ $presupuesto->ValidezBool ? 'success' : 'danger' }}">&nbsp;</span></td>
                          <td>{{$presupuesto->proveedor->razon_social}}</td>
                          <td>{{number_format($presupuesto->getTotalDetalles(), 0, ',', '.')}}</td>
                          <td><span class="badge bg-{{ config('constants.presupuestos-compras-status-label.' . intval($presupuesto->estado)) }}">{{ config('constants.presupuestos-compras-status.'. intval($presupuesto->estado)) }}</span></td>
                          <td>                        
                            <a href="{{url('presupuestos-compras/' . $presupuesto->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                              <a href="{{url('presupuestos-compras/' . $presupuesto->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                              <a data-bs-toggle="modal" data-bs-target="#presupuesto_delete" data-name="{{$presupuesto->descripcion}}" data-id="{{ $presupuesto->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
              <!-- End Table with stripped rows -->
          </div>  
                   
              <div class="modal fade" id="presupuestoc_delete" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar presupuesto </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route('presupuestos-compras.delete')}}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <p>Deseas eliminar la presupuesto <b><span id="presupuesto_id"></span></b>?</p>
                        <input name="presupuesto_id" type="hidden" id="id_presupuesto"/>
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
    $('#presupuestos-compras-menu').addClass('active');
    $('#presupuestoc_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var presupuesto_id = button.data('id'); // Extraer el valor del atributo data-id
        var descripcion = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#presupuesto_id').text(descripcion); // Insertar el valor en el modal
        $('#id_presupuesto').val(presupuesto_id); // Insertar el valor en el modal        
    });
  });
</script>
@endsection