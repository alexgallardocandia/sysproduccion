@extends('layouts.principal')
@section('content')
  <div class="wrapper wrapper-content">
    <div class="row">
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5>Crear Presupuesto de Compra</h5>              
              </div>
              <div class="card-body">
                <div class="mb-3"></div>
                <form class="row g-3" id="form">
                  @csrf
                  <div class="col-md-3">
                    <label for="numero" class="form-label">Numero</label>
                    <input name="numero" id="numero" class="form-control" value="" format-number/>
                  </div>
                  <div class="col-md-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input name="fecha" type="date" id="fecha" max="{{date('Y-m-d')}}" class="form-control" required>
                  </div>
                  <div class="col-md-3">
                    <label for="validez" class="form-label">Validez</label>
                    <input name="validez" type="date" id="validez" min="{{date('Y-m-d')}}" class="form-control" required>
                  </div>
                  <div class="col-md-3">
                    <label for="proveedor_id" class="form-label">Proveedor</label>
                    <select class="form-select" name="proveedor_id" id="proveedor_id">
                      <option value="">Seleccione...</option>
                      @foreach ($proveedores as $proveedor )
                          <option value="@json($proveedor->id)">{{$proveedor->razon_social}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="pedido_compra_id" class="form-label">Pedido Compra</label>
                    <select class="form-select" name="pedido_compra_id" id="pedido_compra_id">
                      <option value="">Seleccione...</option>
                      @foreach ($pedidos_compras as $pedido )
                          <option value="@json($pedido->id)">{{$pedido->id.' | '.$pedido->user->persona->fullname.' | '.$pedido->fecha_pedido}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="row g-3">
                    <hr>
                    <p>Agregar Detalle</p>
                    <div class="col-md-2">
                      <label for="materia_id" class="col-sm-4 col-form-label">Materia P.</label>
                      <select class="form-select" name="materia_id" id="materia_id">
                        <option value="">Seleccione...</option>
                        @foreach($materias as $materia)                              
                          <option value='{{$materia->id}}'>{{$materia->descripcion}}</option>
                        @endforeach()                            
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label for="umedida_id" class="col-sm-8 col-form-label">Presentacion</label>
                      <select class="form-select" name="umedida_id" id="umedida_id">
                        <option selected>Seleccione una unidad</option>
                        @foreach($umedidas as $umedida)                              
                          <option value='{{$umedida->id}}'>{{$umedida->descripcion}}</option>
                        @endforeach()                            
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label for="cantidad" class="col-sm-4 col-form-label">Cantidad</label>
                      <input name="cantidad" id="cantidad" type="number" min="1" class="form-control">
                    </div>
                    <div class="col-md-2">
                      <label for="precio_unitario" class="col-sm-4 col-form-label">Precio</label>
                      <input name="precio_unitario" id="precio_unitario" type="text" class="form-control" format-number/>
                    </div>
                    <div class="col-md-3">
                      <label for="descuento" class="col-sm-4 col-form-label">Descuento</label>
                      <input name="descuento" id="descuento" type="text" class="form-control" format-number/>
                    </div>
                    <div class="col-md-1" style="margin-top:3.5%;">
                      <button id="btn_agregar" type="button" class="btn btn-primary"><b><i class="bi-plus-lg"></i></b></button>
                    </div>
                    <div id="oculto" class="card-body" hidden>
                      <h5 class="card-title">Detalle</h5>
                      <!-- Table with stripped rows -->
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Materia Prima</th>
                            <th scope="col">Presentacion</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Descuento</th>
                            <th scope="col">SubTotal</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody id="ped_det"></tbody>
                        <tfoot class="bold">
                            <tr>
                                <td colspan="3"></td>
                                <td id="td_total" class="text-right"></td>
                                <td id="td_total_precio" class="text-right"></td>
                                <td id="td_total_descuento" class="text-right"></td>
                                <td id="td_grand_total" class="text-right"></td>
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
                  </div>    
                </form>
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
      $('#compras-nav').addClass("show");//coloca el menu en show
      $('#presupuestos-compras-menu').addClass("active");//coloca activo el submenu usuario

      $('#form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "{{route('presupuestos-compras.store')}}",
          data: $(this).serialize(),            
          success: function (response) {
            window.location.href = "{{ route('presupuestos-compras.index') }}";
          },
          error:function(data){
            laravelErrorMessages(data);
          }
        });
      });
      
      $('#btn_agregar').click(function() {
        var materianame = $('#materia_id option:selected').text();
        var materia_id  = $('#materia_id option:selected').val();
        var umedida     = $('#umedida_id option:selected').text();
        var umedida_id  = $('#umedida_id option:selected').val();
        var cantidad    = $('#cantidad').val();
        var precio      = $('#precio_unitario').val();
        var descuento   = $('#descuento').val();

        if ( (materia_id == '' || umedida_id == '') || (cantidad == '' || precio == '') ) {
          swal.fire("Sistema","Favor completa todos los campos.","info");
        } else {
          if ( descuento == '' ) {
            descuento = 0;
            add_detail( materianame, materia_id, umedida, umedida_id, cantidad, precio.replace('.',''), descuento );
          } else {
            add_detail( materianame, materia_id, umedida, umedida_id, cantidad, precio.replace('.',''), descuento.replace('.','') );
          }
        }
      });        
    });

    function add_detail(materianame, materia_id, umedida, umedida_id, cantidad, precio, descuento){
      count++;
      var total = (parseInt(cantidad) * parseInt(precio)) - parseInt(descuento) ;
      $('#ped_det').append(
        '<tr>'+
          '<td>'+count+'</td>'+
          '<td>'+materianame+'</td>'+
          '<td>'+umedida+'</td>'+
          '<td>'+cantidad+'</td>'+
          '<td>'+$.number(precio, 0, ',', '.')+'</td>'+
          '<td>'+$.number(descuento, 0, ',', '.')+'</td>'+
          '<td>'+$.number(total, 0,',','.')+'</td>'+
          '<input type="hidden" name="materias[]" value="'+materia_id+'"/>'+
          '<input type="hidden" name="umedidas[]" value="'+umedida_id+'"/>'+
          '<input type="hidden" name="cantidades[]" value="'+cantidad+'"/>'+
          '<input type="hidden" name="precios[]" value="'+precio.replace('.','')+'"/>'+
          '<input type="hidden" name="descuentos[]" value="'+descuento.replace('.','')+'"/>'+
          '<input type="hidden" name="total[]" value="'+total+'"/>'+
          '<td><a href="javascript:;" onClick="removeRow(this);"><i class="ri-close-line"></a></i></td>'
        +'</tr>'
      );
      $('#materia_id').val('');
      $('#umedida_id').val('');
      $('#cantidad').val('');
      $('#precio_unitario').val('');
      $('#descuento').val('');
      calculateTotal();
      $('#oculto').prop('hidden',false);
    }
    function removeRow(t)
    {
        $(t).parent().parent().remove();
        count--;
        calculateTotal();
    }
    function calculateTotal()
    {
        var total_cantidad  = 0;
        var total_precio    = 0;
        var total_descuento = 0;
        var grand_total     = 0;

        $('input[name^="cantidades[]"]').each(function () {          
          total_cantidad += parseInt($(this).val());
        });
        $('input[name^="precios[]"]').each(function () {
          total_precio += parseInt($(this).val());
        });
        $('input[name^="descuentos[]"]').each(function () {          
          total_descuento += parseInt($(this).val());
        });
        $('input[name^="total[]"]').each(function () {          
          grand_total += parseInt($(this).val());
        });
        
        $("#td_total").html('<b>' + $.number(total_cantidad, 0, ',', '.')+'</b>');
        $("#td_total_precio").html('<b>' + $.number(total_precio, 0, ',', '.')+'</b>');
        $("#td_total_descuento").html('<b>' + $.number(total_descuento, 0, ',', '.')+'</b>');
        $("#td_grand_total").html('<b>' + $.number(grand_total, 0, ',', '.')+'</b>');

        $("#detail_total").val('');
        $("#detail_total").val(total_cantidad);
    }
</script>
@endsection
