@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Proveedores</h5>
              <a href="{{url('proveedores/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">                                     
              <!-- Table with stripped rows -->
              <table class="table ">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Razon Social</th>
                    <th scope="col">RUC</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">E-mail</th>                    
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($proveedores as $proveedor)                  
                      <tr>
                        <td>{{$proveedor->id}}</td>
                        <td>{{$proveedor->razon_social}}</td>                                               
                        <td>{{$proveedor->ruc}}</td>                                               
                        <td>{{$proveedor->telefono}}</td>                                               
                        <td>{{$proveedor->email}}</td>                                             
                        <td>                        
                          <a href="{{url('proveedores/' . $proveedor->id)}}"><i class="bi bi-info-circle-fill"></i></a>                          
                            <a href="{{url('proveedores/' . $proveedor->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                            <a data-bs-toggle="modal" data-bs-target="#proveedor_delete" data-name="{{$proveedor->nombres}}" data-id="{{ $proveedor->id }}"><i class="bi bi-trash-fill"></i></a>                                                    
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
              <!-- End Table with stripped rows -->
          </div>  
                   
              <div class="modal fade" id="proveedor_delete" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar proveedor </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route('proveedores.delete')}}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        <p>Deseas eliminar el proveedor <b><span id="proveedor_id"></span></b>?</p>
                        <input name="proveedor_id" type="hidden" id="id_proveedor"/>
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
    $('#proveedor_delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var proveedor_id = button.data('id'); // Extraer el valor del atributo data-id
        var descripcion = button.data('name'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#proveedor_id').text(descripcion); // Insertar el valor en el modal
        $('#id_proveedor').val(proveedor_id); // Insertar el valor en el modal        
    });
</script>
@endsection