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
                      <input name="fecha" type="text" id="fecha" class="form-control" value="dd/mm/YY" required>
                    </div>
                    <div class="col-md-3">
                      <label for="validez" class="form-label">Validez</label>
                      <input name="validez" type="text" id="validez" class="form-control" value="dd/mm/YY" required>
                    </div>
                    {{-- <div class="col-md-3">
                      <label for="monto_descuento" class="form-label">Monto Descuento</label>
                      <input name="monto_descuento" type="text" id="monto_descuento" class="form-control" format-number required>
                    </div> --}}
                    {{-- <div class="col-md-3">
                      <label for="tipo_descuento" class="form-label">Tipo Descuento</label>
                      <select name="tipo_descuento" id="tipo_descuento" class="form-select">
                        <option value="">Seleccione...</option>
                        @foreach (config('constants.tipo-descuento') as $key => $item)
                          <option value="{{$key}}">{{$item}}</option>
                        @endforeach
                      </select>
                    </div> --}}
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
                        <option value="0">Seleccione...</option>
                        @foreach ($pedidos_compras as $pedido )
                            <option value="@json($pedido->id)">{{$pedido->id.' | '.$pedido->user->empleado->fullname.' | '.$pedido->fecha_pedido}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <div class="row g-3" id="pedido_compra_detalles_div" hidden>
                        <div class="">
                          <label for="pedido_compra_detalles" class="form-label">Detalles del Pedido de Compra</label>
                          <!-- Table Variants -->
                          <table class="table">
                            <thead class="table-primary">
                              <tr>
                                <th scope="col">Materia Prima</th>
                                <th scope="col">Cantidad</th>
                              </tr>
                            </thead>
                            <tbody id="detail_body"></tbody>
                          </table>
                          <!-- End Table Variants -->
                        </div>
                      </div>
                    </div>
                  <div class="row g-3">
                    <hr>
                    <p>Agregar Detalle</p>
                    <div class="col-md-3">
                      <label for="materia_id" class="col-sm-4 col-form-label">Materia P.</label>
                      <select class="form-select" name="materia_id" id="materia_id">
                        <option value="">Seleccione...</option>
                        @foreach($materias as $materia)                              
                          <option value='{{$materia->id}}'>{{$materia->nombre.' | '.$materia->unidad_medida->descripcion}}</option>
                        @endforeach()                            
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="cantidad" class="col-sm-4 col-form-label">Cantidad</label>
                      <input name="cantidad" id="cantidad" type="text" class="form-control" format-number>
                    </div>
                    <div class="col-md-3">
                      <label for="precio_unitario" class="col-sm-4 col-form-label">Precio</label>
                      <input name="precio_unitario" id="precio_unitario" type="text" class="form-control" format-number/>
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
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">SubTotal</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody id="pre_det"></tbody>
                        <tfoot class="bold">
                            <tr>
                                <td colspan="2"></td>
                                <td id="td_total" class="text-right"></td>
                                <td id="td_total_precio" class="text-right"></td>
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
        $('input[type=submit]').prop('disable', true);
        $.ajax({
          type: "POST",
          url: "{{route('presupuestos-compras.store')}}",
          data: $(this).serialize(),            
          success: function (response) {
            redirect("{{ route('presupuestos-compras.index') }}");
          },
          error:function(data){
            laravelErrorMessages(data);
            $('input[type=submit]').prop('disable', false);

          }
        });
      });
      
      $('#pedido_compra_id').on('change', function() {        
        if ( $(this).val() != 0  ) {
          $.ajax({
            type: "POST",
            url: "{{url('ajax/getdetailspedidos')}}",
            data: $(this).serialize(),
            success: function (data) {
              $('#detail_body').html('');
              $.each(data.detalles, function (key, value) {
                showPedidoCompraDetalle(value.materianame, value.materia_id, value.cantidad);
              });
            },
            error:function(data) {
              laravelErrorMessages(data);
              $('#pedido_compra_detalles_div').prop('hidden', true);
            }
          });
        } else {
          $('#pedido_compra_detalles_div').prop('hidden', true);
        }
      });


      $('#btn_agregar').click(function() {
        var materianame = $('#materia_id option:selected').text();
        var materia_id  = $('#materia_id option:selected').val();
        var cantidad    = $('#cantidad').val();
        var precio      = $('#precio_unitario').val();

        if ( materia_id == '' || cantidad == '' || precio == '' ) {
          swal.fire("Sistema","Favor completa todos los campos.","info");
        } else {
          add_detail( materianame, materia_id,cantidad, precio.replace('.',''));
          $('#oculto').prop('hidden', false);
        }
      });
      flatpickr("#validez",{
        minDate: "today", // Impide seleccionar fechas anteriores a la actual
        dateFormat: "d/m/Y", // Formato de fecha
      });
      flatpickr("#fecha",{
        maxDate: "today", // Impide seleccionar fechas mayores a la actual
        dateFormat: "d/m/Y", // Formato de fecha
      });
    });

    function showPedidoCompraDetalle(materianame, materia_id, cantidad)
    {
      $('#detail_body').append(
        '<tr class="table-info">'+
          '<td>'+materianame+'</td>'+
          '<td>'+$.number(cantidad, 0, ',', '.')+'</td>'
        +'</tr>'
      );
      $('#pedido_compra_detalles_div').prop('hidden', false);
    }

    function add_detail( materianame, materia_id, cantidad, precio ) {
      var old_cantidad = 0; //CONTENDRA EL VALOR ANTERIOR DE LA CANTIDAD
      var new_cantidad = 0; //CONTENDRA LA SUMA DEL VALOR ANTERIOR Y EL NUEVO
      var append       = true; //SE VUELVE FALSE CUANDO ES LA MISMA MATERIA_ID
      var new_subtotal = 0;

      $('input[name^="materias[]"]').each( function (key, value) {//RECORREMOS LAS MATERIAS

        if($(this).val() == materia_id)//SI YA EXISTE UNA MATERIA PRIMA EN EL DETALLE 
        {

          old_cantidad = $('#td_cantidad_'+materia_id).text();//GUARDAMOS EL VALOR ACTUAL DE ESTE TD
          new_cantidad = parseInt(old_cantidad.replace('.','')) + parseInt(cantidad); //GUARDAMOS LA SUMA DE LA CANTIDAD VIEJA CON LA NUEVA
          new_subtotal = new_cantidad * precio;
          $('#td_cantidad_'+materia_id).html(''); //LIMPIAMOS EL TD
          $('#td_cantidad_'+materia_id).html($.number(new_cantidad, 0, ',','.')); //MANDAMOS LA NUEVA CANTIDAD AL TD

          $('#cantidad_'+materia_id).val(new_cantidad); //MANDAMOS LA NUEVA CANTIDAD EN EL INPUT
          $('#td_subtotal_'+materia_id).html(new_subtotal); //MANDAMOS EL NUEVO SUBTOTAL EN EL INPUT
          $('#precio_total_'+materia_id).val(new_subtotal);

          append = false;
          
          calculateTotal();
        }
      });
      if(append)
      {

        count++;
        $('#pre_det').append(
          '<tr name="detalle" id="detalle">'+
            '<td>'+count+'</td>'+
            '<td>'+materianame+'</td>'+
            '<td id="td_cantidad_'+materia_id+'">'+$.number(cantidad,0,',','.')+'</td>'+
            '<td id="td_precio_'+materia_id+'">'+$.number(precio,0,',','.')+'</td>'+
            '<td id="td_subtotal_'+materia_id+'">'+$.number((precio * cantidad),0,',','.')+'</td>'+
            '<input type="hidden" name="materias[]" value="'+materia_id+'"/>'+
            '<input type="hidden" id="cantidad_'+materia_id+'" name="cantidades[]" value="'+cantidad+'"/>'+
            '<input type="hidden" id="precio_'+materia_id+'" name="precios[]" value="'+precio+'"/>'+
            '<input type="hidden" id="precio_total_'+materia_id+'" name="precios_total[]" value="'+precio * cantidad+'"/>'+
            '<td><a href="javascript:;" onClick="removeRow(this);"><i class="ri-close-line"></a></i></td>'
          +'</tr>'
        );
  
        calculateTotal();
      }
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
        
        $('input[name^="cantidades[]"]').each(function () {
          total_cantidad += parseInt($(this).val());
        });
        $('input[name^="precios[]"]').each(function () {
          total_precio += parseInt($(this).val());
        });
        
        $("#td_total").html('<b>' + $.number(total_cantidad, 0, ',', '.')+'</b>');
        $("#td_total_precio").html('<b>' + $.number(total_precio, 0, ',', '.')+'</b>');

        $("#detail_total").val('');
        $("#detail_total").val(total_cantidad);
        calculateGrandTotal();
    }
    function calculateGrandTotal()
    {
      var grand_total     = 0;

      $('input[name^="precios_total[]"]').each(function () {
        grand_total += parseInt($(this).val());
        console.log(grand_total);
      });
      $("#td_grand_total").html('<b>' + $.number(grand_total, 0, ',', '.')+'</b>');

    }
</script>
@endsection
