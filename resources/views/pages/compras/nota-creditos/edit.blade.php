@extends('layouts.principal')
@section('content')
  <div class="wrapper wrapper-content">
    <div class="row">
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5>Editar Presupuesto de Compra <b>#{{ $presupuesto_compra->id }}</b></h5>              
              </div>
              <div class="card-body">
                <div class="mb-3"></div>
                <form class="row g-3" id="form">
                  @csrf
                  <div class="col-md-3">
                    <label for="numero" class="form-label">Numero</label>
                    <input name="numero" id="numero" class="form-control" value="{{ $presupuesto_compra->numero }}" format-number/>
                    <input type="hidden" name="presupuesto_compra_id" value="@json($presupuesto_compra->id)"/>
                  </div>
                  <div class="col-md-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input name="fecha" type="text" id="fecha" class="form-control" value="{{$presupuesto_compra->fecha}}" required>
                  </div>
                  <div class="col-md-3">
                    <label for="validez" class="form-label">Validez</label>
                    <input name="validez" type="text" id="validez" class="form-control" value="{{$presupuesto_compra->validez}}" required>
                  </div>
                  <div class="col-md-3">
                    <label for="proveedor_id" class="form-label">Proveedor</label>
                    <select class="form-select" name="proveedor_id" id="proveedor_id">
                      <option value="@json($presupuesto_compra->proveedor_id)">{{ $presupuesto_compra->proveedor->razon_social }}</option>
                      <option value="">Seleccione...</option>
                      @foreach ($proveedores as $proveedor )
                          <option value="@json($proveedor->id)">{{$proveedor->razon_social}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="pedido_compra_id" class="form-label">Pedido Compra</label>
                    <select class="form-select" name="pedido_compra_id" id="pedido_compra_id">
                      @if($presupuesto_compra->pedido_compra_id)
                        <option value="@json($presupuesto_compra->pedido_compra_id)">{{$presupuesto_compra->pedido_compra->id. ' | ' .$presupuesto_compra->pedido_compra->user->empleado->fullname.' | '.$presupuesto_compra->pedido_compra->fecha_pedido}}</option>
                        <option value="">Seleccione...</option>
                        @foreach ($pedidos_compras as $pedido )
                            <option value="@json($pedido->id)">{{$pedido->id.' | '.$pedido->user->empleado->fullname.' | '.$pedido->fecha_pedido}}</option>
                        @endforeach
                      @else
                        <option value="">Seleccione...</option>
                        @foreach ($pedidos_compras as $pedido )
                            <option value="@json($pedido->id)">{{$pedido->id.' | '.$pedido->user->empleado->fullname.' | '.$pedido->fecha_pedido}}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="row g-3">
                    <hr>
                    <p>Agregar Detalle</p>
                    <div class="col-md-3">
                      <label for="materia_id" class="col-sm-4 col-form-label">Materia P.</label>
                      <select class="form-select" name="materia_id" id="materia_id">
                        <option value="">Seleccione...</option>
                        @foreach($materias as $materia)                              
                          <option value='{{$materia->id}}'>{{$materia->descripcion}}</option>
                        @endforeach()                            
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="cantidad" class="col-sm-4 col-form-label">Cantidad</label>
                      <input name="cantidad" id="cantidad" type="number" min="1" class="form-control">
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
                        <tbody id="ped_det"></tbody>
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
        $.ajax({
          type: "PUT",
          url: "{{route('presupuestos-compras.update')}}",
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
        var cantidad    = $('#cantidad').val();
        var precio      = $('#precio_unitario').val();

        if (materia_id == '' || (cantidad == '' || precio == '') ) {
          swal.fire("Sistema","Favor completa todos los campos.","info");
        } else {
          add_detail( materianame, materia_id, cantidad, precio.replace('.','') );
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

      chargeDetails();        
    });

    function add_detail(materianame, materia_id, cantidad, precio) {
      count++;
      var total = (parseInt(cantidad) * parseInt(precio));
      $('#ped_det').append(
        '<tr>'+
          '<td>'+count+'</td>'+
          '<td>'+materianame+'</td>'+
          '<td>'+cantidad+'</td>'+
          '<td>'+$.number(precio, 0, ',', '.')+'</td>'+
          '<td>'+$.number(total, 0,',','.')+'</td>'+
          '<input type="hidden" name="materias[]" value="'+materia_id+'"/>'+
          '<input type="hidden" name="cantidades[]" value="'+cantidad+'"/>'+
          '<input type="hidden" name="precios[]" value="'+precio+'"/>'+
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
    function removeRow(t) {
        $(t).parent().parent().remove();
        count--;
        calculateTotal();
    }
    function chargeDetails() {
      var detalles = @json($precargado);

      $.each(detalles, function (key, value) { 
        add_detail( value.materianame, value.materia_id, value.cantidad, value.precio );
      });
    }
    function calculateTotal() {
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
