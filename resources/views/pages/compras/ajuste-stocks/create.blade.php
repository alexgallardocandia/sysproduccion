@extends('layouts.principal')
@section('content')
  <div class="wrapper wrapper-content">
    <div class="row">
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5>Crear Compra</h5>
              </div>
              <div class="card-body">
                <div class="mb-3"></div>
                <form class="row g-3" id="form">
                  @csrf
                    <div class="col-md-3">
                      <label for="orden_compra_id" class="form-label">Orden de Compra</label>
                      <select class="selectpicker form-control" name="orden_compra_id" id="orden_compra_id" data-live-search="true" >
                        <option value="">Seleccione...</option>
                        @foreach ($orden_compras as $orden_compra )
                            <option value="@json($orden_compra->id)">{{$orden_compra->id.'|'.$orden_compra->fecha.'|'.number_format($orden_compra->getTotalDetalles(), 0, ',', '.')}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3" id="div-proveedor">
                      <label for="proveedor_id" class="form-label">Proveedor</label>
                      <input name="proveedor_id" type="text" id="proveedor_id" class="form-control" readonly >
                    </div>
                    <div class="col-md-3">
                      <label for="fecha" class="form-label">Fecha</label>
                      <input name="fecha" type="text" id="fecha" class="form-control" value="dd/mm/YY" required>
                    </div>
                    <div class="col-md-3">
                      <label for="timbrado_id" class="form-label">Timbrado</label>
                      <select class="selectpicker form-control" name="timbrado_id" id="timbrado_id" data-live-search="true" >
                        <option value="">Seleccione...</option>
                        @foreach ($timbrados as $timbrado )
                            <option value="@json($timbrado->id)">{{$timbrado->numero}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="nro_factura" class="form-label">Nro. de Factura</label>
                      <input type="text" class="form-control" name="nro_factura" id="nro_factura" invoice-purchase-mask required />
                    </div>
                    <div class="col-md-3" id="div-condicion">
                      <label for="condicion" class="form-label">Condicion</label>
                      <select name="condicion" id="condicion" class="selectpicker form-control" data-live-search="true">
                        <option value="">Seleccione...</option>
                        @foreach ( config('constants.type_condition') as $key => $condicion )
                            <option value="{{$key}}">{{ $condicion }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3" id="cant_cuotas" hidden>
                      <label for="nro_cuotas" class="form-label">Cant. Cuotas</label>
                      <input name="nro_cuotas"  id="nro_cuotas" type="number" min="0" max="100" value="1" class="form-control" format-number required>
                    </div>
                    <div class="col-md-3" id="frecuencia" hidden>
                      <label for="frecuencia" class="form-label">Frecuencia</label>
                      <input name="frecuencia"  id="frecuencia" type="number" min="0" max="31" value="1" class="form-control" format-number required>
                    </div>
                    <div class="col-md-3">
                      <label for="descuento" class="form-label">Descuento</label>
                      <input name="descuento"  id="descuento" type="number" min="0" max="100" class="form-control" format-number required>
                    </div>
                  <div class="row g-3">
                    {{-- <hr>
                    <p>Agregar Detalle</p>
                    <div class="col-md-3">
                      <label for="materia_id" class="col-sm-4 col-form-label">Materia P.</label> --}}
                      {{-- <select class="selectpicker" data-live-search="true" name="materia_id" id="materia_id">
                        <option value="">Seleccione...</option>
                        @foreach($materias as $materia)                              
                          <option value='{{$materia->id}}'>{{$materia->nombre.' | '.$materia->unidad_medida->descripcion}}</option>
                        @endforeach()                            
                      </select> --}}
                    {{-- </div>
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
                    </div> --}}
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
                                <td></td>
                                {{-- <td id="td_total_precio" class="text-right"></td> --}}
                                <td id="td_grand_total" class="text-right"></td>
                                <td></td>
                            </tr>
                        </tfoot>
                      </table>
                      <input type="hidden" name="detail_total" id="detail_total" value="0">
                      <!-- End Table with stripped rows -->            
                    </div>
                    <div class="card-footer">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Guardar</button>
                        <a href="{{url('orden-compras')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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
    var solicitante = '';
    var solicitante_id = '';

    $(function() {

      $('#compras-nav').addClass("show");//coloca el menu en show
      $('#compras-menu').addClass("active");//coloca activo el submenu usuario

      $('#form').on('submit', function(e) {

        e.preventDefault();
        $('input[type=submit]').prop('disable', true);

        $.ajax({
          type: "POST",
          url: "{{route('compras.store')}}",
          data: $(this).serialize(),            
          success: function (response) {
            redirect("{{ route('compras.index') }}");
          },
          error:function(data){
            laravelErrorMessages(data);
            $('input[type=submit]').prop('disable', false);

          }
        });
      });
      
      $('#orden_compra_id').on('change', function() { 
          $.ajax({
            type: "POST",
            url: "{{url('ajax/getorden')}}",
            data: $(this).serialize(),
            success: function (data) {
              $('#pre_det').html('');
              $.each(data, function (key, value) { 
                proveedor = value.proveedor;
                proveedor_id = value.proveedor_id;
                showPedidoCompraDetalle(value.materianame, value.materia_id, value.cantidad, value.precio);
              });

              // var $option = $('#proveedor_id').find('option[value="' + proveedor + '"]');

              // console.log(proveedor);
              if ( proveedor != '' && proveedor_id != '' ) {

                $('#div-proveedor').html('');
                $('#div-proveedor').append(
                  '<label for="proveedor_id" class="form-label">Proveedor</label>'+
                  '<input type="hidden" name="proveedor_id" class="form-control" value="'+proveedor_id+'" readonly/>'+
                  '<input type="text" class="form-control" value="'+proveedor+'" readonly/>'
                );

              }

            },
            error:function(data) {

              laravelErrorMessages(data);
              $('#oculto').prop('hidden', true);

            }

          });
      });

      $('#condicion').on('change', function(){
        if($(this).val() != '' && $(this).val() != 1) {
          $('#cant_cuotas').prop('hidden', false);
          $('#frecuencia').prop('hidden', false);
        }else {
          $('#cant_cuotas').prop('hidden', true);
          $('#frecuencia').prop('hidden', true);
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
        // $('#materia_id').select('');
        $('#cantidad').val('');
        $('#precio_unitario').val('');
        
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
    function showPedidoCompraDetalle(materianame, materia_id, cantidad, precio)
    {
      count++;
        $('#pre_det').append(
          '<tr name="detalle[]" id="detalle">'+
            '<td>'+count+'</td>'+
            '<td>'+materianame+'</td>'+
            '<td id="td_cantidad_'+materia_id+'">'+$.number(cantidad,0,',','.')+'</td>'+
            '<td><input type="text" name="precios_td[]" format-number class="form-control" id="td_precio_'+materia_id+'" value="'+ precio +'" onkeyup="recalculateTotal(this)" readonly/></td>'+
            '<td name="subtotales[]" id="td_subtotal_'+materia_id+'">'+$.number((precio * cantidad),0,',','.')+'</td>'+
            '<input type="hidden" name="materias[]" value="'+materia_id+'"/>'+
            '<input type="hidden" id="cantidad_'+materia_id+'" name="cantidades[]" value="'+cantidad+'"/>'+
            '<input type="hidden" id="precio_'+materia_id+'" name="precios[]" value="'+precio+'"/>'+
            '<input type="hidden" id="precio_total_'+materia_id+'" name="precios_total[]" value="'+precio * cantidad+'"/>'+
            '<td></td>'+
            // '<td><a href="javascript:;" onClick="removeRow(this);"><i class="ri-close-line"></a></i></td>'
          +'</tr>'
        );
        calculateTotal();
      $('#oculto').prop('hidden', false);

    }

    function recalculateTotal(param)
    {

      var ids = param.id.split('_');
      var total_cantidad  = 0;
      var precio          = 0;
      var total_precio    = 0;
      var cantidad        = 0;
      var grand_total     = 0;


      precio = parseInt($('#td_precio_'+ids[2]).val());

      cantidad = parseInt($('#td_cantidad_'+ids[2]).text().replace('.',''));

      $('#td_subtotal_'+ids[2]).html($.number(precio * cantidad, 0,',','.'));
      $('#precio_'+ids[2]).val(precio);


      $('td[name^="subtotales[]"]').each(function (key, value) {
        grand_total += parseInt($(this).text().replace('.',''));
      });
      $("#td_grand_total").html('<b>' + $.number(grand_total, 0, ',', '.')+'</b>');
      $('input[name^="precios_total[]"]').val(grand_total);

    }

    function add_detail( materianame, materia_id, cantidad, precio ) 
    {
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
            '<td name="subtotales[]" id="td_subtotal_'+materia_id+'">'+$.number((precio * cantidad),0,',','.')+'</td>'+
            '<input type="hidden" name="materias[]" value="'+materia_id+'"/>'+
            '<input type="hidden" id="cantidad_'+materia_id+'" name="cantidades[]" value="'+cantidad+'"/>'+
            '<input type="hidden" id="precio_'+materia_id+'" name="precios[]" value="'+precio+'"/>'+
            '<input type="hidden" id="precio_total_'+materia_id+'" name="precios_total[]" value="'+precio * cantidad+'"/>'+
            '<td><a href="javascript:;" onClick="removeRow(this);"><i class="ri-close-line"></a></i></td>'
          +'</tr>'
        );
  
        calculateTotal();
      }
      $('#cantidad').val('');
      $('#precio_unitario').val('');
      $('#materia_id').selectpicker('val',''); //selecciona el valor vacio
      // $('#materia_id').selectpicker('render');
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
      });
      $("#td_grand_total").html('<b>' + $.number(grand_total, 0, ',', '.')+'</b>');

    }
</script>
@endsection
