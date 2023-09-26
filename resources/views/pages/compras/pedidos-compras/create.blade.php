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
                <form id="form">
                  @csrf
                  <div class="form-group">
                    <div class="row mb-3">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Prioridad</label>
                      <div class="col-sm-4">
                        <select class="form-select" name="prioridad" id="prioridad">                              
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
                            <select class="form-select" name="user_id" id="user_id">
                              <option>Seleccione...</option>
                              @foreach($personas as $persona)
                                <option value='{{$persona->id}}'>{{$persona->nombres. ' '.$persona->apellidos}}</option>
                              @endforeach()                            
                            </select>
                          </div>                          
                        </div>                                             
                    </div>
                  </div>
                  <div class="card-footer">                    
                      <div class="form-group">
                        <div class="row mb-1">                                            
                            <label for="materia_id" class="col-sm-2 col-form-label">Materia Prima</label>
                            <div class="col-sm-2">
                              <div class="form-group">                                              
                                <select class="form-select" name="materia_id" id="materia_id">
                                  <option value="">Seleccione...</option>
                                  @foreach($materias as $materia)                              
                                    <option value='{{$materia->id}}'>{{$materia->descripcion}}</option>
                                  @endforeach()                            
                                </select>
                              </div>
                            </div>  
                            <label for="cantidad" class="col-sm-1 col-form-label">Cantidad</label>
                            <div class="col-sm-1">
                              <input name="cantidad" id="cantidad" type="number" min="1" class="form-control">
                            </div> 
                            <label for="umedida_id" class="col-sm-2 col-form-label">Unidad de medida</label>
                            <div class="col-sm-2">
                              <div class="form-group">                                              
                                <select class="form-select" name="umedida_id" id="umedida_id">
                                  <option selected>Seleccione una unidad</option>
                                  @foreach($umedidas as $umedida)                              
                                    <option value='{{$umedida->id}}'>{{$umedida->descripcion}}</option>
                                  @endforeach()                            
                                </select>
                              </div>
                            </div> 
                            <div class="col-2">
                              <button id="btn_agregar" type="button" class="btn btn-primary"><b><i class="bi-plus-lg"></i></b></button>
                            </div>
                        </div>
                      </div>
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
                      <tfoot class="bold">
                          <tr>
                              <td colspan="3"></td>
                              <td id="td_total" class="text-right"></td>                                            
                          </tr>
                      </tfoot>
                    </table>
                    <input type="hidden" name="detail_total" id="detail_total" value="0">
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
        </div>
      </section>      
    </div>
  </div>
@endsection
@section('script')
<script>
    var count = 0;
    $(document).ready(function() {      

        $('#form').on('submit', function(e){
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "{{url('pedidos-compras')}}",
            data: $(this).serialize(),            
            success: function (response) {
              window.location.href = "{{ route('pedidos-compras.index') }}";
            },
            error:function(data){
              laravelErrorMessages(data);
            }
          });
        });

        $('#compras-nav').addClass("show");//coloca el menu en show
        $('#pedidos-compras-menu').addClass("active");//coloca activo el submenu usuario
        $('#btn_agregar').click(function(){
          var materianame = $('#materia_id option:selected').text();
          var materia     = $('#materia_id').val();
          var cantidad    = $('#cantidad').val();
          var umedida     = $('#umedida_id option:selected').text();
          var umedida_id  = $('#umedida_id option:selected').val();

          if(materia === 'Seleccione una materia prima' || cantidad == 0|| cantidad == '' || umedida === 'Seleccione una unidad'){           
            swal.fire("Hay campos vacios","Favor completa todos los campos...","error");
          }else{
            $('#oculto').prop('hidden',false);

            add_detail(materianame, cantidad,umedida,materia, umedida_id);

            $('#materia_id').val('Seleccione una materia prima');
            $('#cantidad').val('');
            $('#umedida_id').val('Seleccione una unidad');
          }
        });        
    });
    
    function add_detail(mat, cant,ume, mat_id, ume_id){
      count++;
      $('#ped_det').append(
        '<tr>'+
          '<td>'+count+'</td>'+
          '<td>'+mat+'</td>'+
          '<td>'+ume+'</td>'+
          '<td>'+cant+'</td>'+
          '<input type="hidden" name="materias[]" value="'+mat_id+'"/>'+
          '<input type="hidden" name="umedidas[]" value="'+ume_id+'"/>'+
          '<input type="hidden" name="cantidades[]" value="'+cant+'"/>'+
          '<td><a href="javascript:;" onClick="removeRow(this);"><i class="ri-close-line"></a></i></td>'
        +'</tr>'
      );
      calculateTotal();
    }
    function removeRow(t)
    {
        $(t).parent().parent().remove();
        count--;
    }
    function calculateTotal()
    {
        var total = 0;
        $('input[name^="cantidades[]"]').each(function ()
        {          
            total += parseInt($(this).val());
        });
        $("#td_total").html('<b>' + $.number(total, 0, ',', '.')+'</b>');            
        $("#detail_total").val('');
        $("#detail_total").val(total);
    }
</script>
@endsection
