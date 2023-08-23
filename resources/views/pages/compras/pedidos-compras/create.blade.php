@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Crear Pedido de Compra</h5>              
            </div>
            <div class="card-body">                                  
                <form method="POST" action="{{route('pedidos-compras.store')}}">
                  @csrf
                  <div class="form-group">
                    <div class="row mb-3">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Prioridad</label>
                      <div class="col-sm-4">
                        <select class="form-control select2" name="prioridad" id="prioridad">                              
                          <option value='3'>Baja</option>
                          <option value='2'>Media</option>
                          <option value='1'>Alta</option>
                        </select>
                      </div>
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha</label>
                      <div class="col-sm-4">
                        <input name="fecha" type="text" class="form-control" value="{{now()->format('d/m/Y')}}" readonly>
                      </div>                      
                    </div>              
                    <div class="row mb-3">                                                              
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Solicitante</label>
                        <div class="col-sm-4">
                          <div class="form-group">                                              
                            <select class="form-control select2" name="user_id" id="user_id">
                              <option selected>Seleccione una persona</option>
                              @foreach($personas as $persona)                              
                                <option value='{{$persona->id}}'>{{$persona->nombres. ' '.$persona->apellidos}}</option>
                              @endforeach()                            
                            </select>
                          </div>                          
                        </div>                                             
                    </div>
            </div>
            <div class="card-footer">
              <form id="form-detail">
                <div class="form-group">
                <div class="row mb-3">                                            
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Materia Prima</label>
                    <div class="col-sm-2">
                      <div class="form-group">                                              
                        <select class="form-control select2" name="materia_id" id="materia_id">
                          <option selected>Seleccione una materia prima</option>
                          @foreach($materias as $materia)                              
                            <option value='{{$materia->id}}'>{{$materia->descripcion}}</option>
                          @endforeach()                            
                        </select>
                      </div>
                    </div>  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Cantidad</label>
                    <div class="col-sm-2">
                      <input name="cantidad" id="cantidad" type="number" min="1" class="form-control" required>
                    </div> 
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Unidad de medida</label>
                    <div class="col-sm-2">
                      <div class="form-group">                                              
                        <select class="form-control select2" name="umedida_id" id="umedida_id">
                          <option selected>Seleccione una unidad</option>
                          @foreach($umedidas as $umedida)                              
                            <option value='{{$umedida->id}}'>{{$umedida->descripcion}}</option>
                          @endforeach()                            
                        </select>
                      </div>
                    </div> 
                    <div class="col-2">
                      <button id="btn_agregar" type="button" class="btn btn-primary"><i class="bi-plus-lg"></i> Agregar</button>
                    </div>
                </div>
              </form>
            </div>
            <div id="oculto" class="card-body" hidden>
              <h5 class="card-title">Detalle</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Materia Prima</th>
                    <th scope="col">Unidad Medida</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col"></th>                    
                  </tr>
                </thead>
                <tbody id="ped_det"></tbody>
              </table>
              <!-- End Table with stripped rows -->            
            </div>
            <div class="card-footer">                        
                <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Guardar</button>
                <a href="{{url('pedidos-compras')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
            </div>
          </form><!-- End Horizontal Form -->
          </div>    
        </div>
      </div>
    </section>      
  </div>
</div>    
@endsection
@section('script')
<script>
    var count = 0;
    $(document).ready(function() {
        $('#compras-nav').addClass("show");//coloca el menu en show
        $('#pedidos-compras-menu').addClass("active");//coloca activo el submenu usuario
        $('#btn_agregar').click(function(){
          var materianame = $('#materia_id option:selected').text();
          var materia = $('#materia_id').val();
          var cantidad = $('#cantidad').val();
          var umedida = $('#umedida_id option:selected').text();
          if(materia === 'Seleccione una materia prima' || cantidad == 0|| cantidad == '' || umedida === 'Seleccione una unidad'){           
            swal.fire("Hay campos vacios","Favor completa todos los campos...","error");
          }else{
            /*$.ajax({
                url: 'ped',
                method: 'GET', // Puede ser 'POST', 'PUT', 'DELETE', etc.
                dataType: 'json', // El tipo de datos esperado en la respuesta, por ejemplo, 'json' o 'html'
                data: { // Datos a enviar en la solicitud (opcional)
                    clave1: 'valor1',
                    clave2: 'valor2'
                },
                success: function(response) {
                    // Manejar la respuesta exitosa aquí
                    console.log(response);
                },
                error: function(error) {
                    // Manejar errores aquí
                    console.error(error);
                }
            });*/
            $('#oculto').prop('hidden',false);
            add_detail(materianame, cantidad,umedida);
            $('#materia_id').val('Seleccione una materia prima');
            $('#cantidad').val('');
            $('#umedida_id').val('Seleccione una unidad');
          }
        });        
    });
    
    function add_detail(mat, cant,ume){
      count++;
      $('#ped_det').append(
        '<tr>'+
          '<td>'+count+'</td>'+
          '<td name="materias[]">'+mat+'</td>'+
          '<td name="cantidades[]">'+ume+'</td>'+
          '<td name="cantidades[]">'+cant+'</td>'+          
          '<td><i class="ri-close-line"></i></td>'
        +'</tr>'        
      );
    };
</script>
@endsection