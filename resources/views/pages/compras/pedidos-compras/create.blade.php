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
                <div class="mb-3"></div>
                <form class="row g-3" id="form">
                  @csrf
                  <div class="col-md-4">
                    <label for="empleado_id" class="form-label">Solicitante</label>
                    <select name="empleado_id" id="empleado_id" class="selectpicker form-control" data-live-search="true">
                      <option value="">Seleccione</option>
                      @foreach ($empleados as $empleado)
                        <option value="@json($empleado->id)">{{ $empleado->fullname }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input name="fecha" id="fecha" class="form-control" value="{{ date('d/m/Y') }}" readonly>
                  </div>
                  <div class="col-md-4">
                    <label for="fecha" class="form-label">Prioridad</label>
                    <select class="form-select" name="prioridad" id="prioridad">
                      <option value='3'>Baja</option>
                      <option value='2'>Media</option>
                      <option value='1'>Alta</option>
                    </select>
                  </div>
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label for="materia_id" class="col-sm-4 col-form-label">Materia Prima</label>
                      <select class="form-control selectpicker" data-live-search="true" name="materia_id" id="materia_id">
                        <option value="">Seleccione...</option>
                        @foreach($materias as $materia)                              
                          <option value='{{$materia->id}}'>{{$materia->nombre.' | '.$materia->unidad_medida->descripcion}}</option>
                        @endforeach()                            
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="cantidad" class="col-sm-4 col-form-label">Cantidad</label>
                      <input name="cantidad" id="cantidad" type="text" class="form-control" format-number/>
                    </div>
                    <div class="col-md-4" style="margin-top:3.5%;">
                      <button id="btn_agregar" type="button" class="btn btn-primary"><b><i class="bi-plus-lg"></i></b></button>
                    </div>
                </div>              
                <div id="oculto" class="card-body" hidden>
                  <h5 class="card-title">Detalle</h5>
                  <!-- Table with stripped rows -->
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">Materia Prima</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody id="ped_det"></tbody>
                    <tfoot class="bold">
                        <tr>
                            <td colspan="2"></td>
                            <td id="td_total" class="text-right"></td>                                            
                            <td></td>                                            
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
                </form>
                <div class="mb-3"></div>
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
        $('#pedidos-compras-menu').addClass("active");//coloca activo el submenu usuario

        $('#form').on('submit', function(e) {
          
          e.preventDefault();

          $('button[type=submit]').prop('disabled', true);
          $.ajax({
            type: "POST",
            url: "{{route('pedidos-compras.store')}}",
            data: $(this).serialize(),            
            success: function (response) {
              window.location.href = "{{ route('pedidos-compras.index') }}";
            },
            error:function(data){
              laravelErrorMessages(data);
              $('button[type=submit]').prop('disabled', false);

            }
          });
        });

        $('#btn_agregar').click(function() {
          
          var materianame = $('#materia_id option:selected').text();
          var materia     = $('#materia_id').val();
          var cantidad    = $('#cantidad').val().replace('.','');

          if ( (materia == '') || (cantidad == 0) || (cantidad == '') ) {

            swal.fire("Hay campos vacios","Favor completa todos los campos...","error");
          } 
          else {
            $('#oculto').prop('hidden', false);
            add_detail(materianame, cantidad, materia);

            $('#materia_id').val('');
            $('#cantidad').val('');
          }
        });
        // flatpickr("#fecha",{
        //   minDate: "today", // Impide seleccionar fechas anteriores a la actual
        //   dateFormat: "d/m/Y", // Formato de fecha
        // });
        flatpickr("#fecha",{
          maxDate: "today", // Impide seleccionar fechas mayores a la actual
          dateFormat: "d/m/Y", // Formato de fecha
        });
    });
    function add_detail( materianame, cantidad,materia_id ) {
      var old_cantidad = 0; //CONTENDRA EL VALOR ANTERIOR DE LA CANTIDAD
      var new_cantidad = 0; //CONTENDRA LA SUMA DEL VALOR ANTERIOR Y EL NUEVO
      var append       = true; //SE VUELVE FALSE CUANDO ES LA MISMA MATERIA_ID

      $('input[name^="materias[]"]').each( function (key, value) {//RECORREMOS LAS MATERIAS

        if($(this).val() == materia_id)//SI YA EXISTE UNA MATERIA PRIMA EN EL DETALLE 
        {

          old_cantidad = $('#td_cantidad_'+materia_id).text();//GUARDAMOS EL VALOR ACTUAL DE ESTE TD
          new_cantidad = parseInt(old_cantidad.replace('.','')) + parseInt(cantidad); //GUARDAMOS LA SUMA DE LA CANTIDAD VIEJA CON LA NUEVA
          $('#td_cantidad_'+materia_id).html(''); //LIMPIAMOS EL TD
          $('#td_cantidad_'+materia_id).html($.number(new_cantidad, 0, ',','.')); //MANDAMOS LA NUEVA CANTIDAD AL TD

          $('#cantidad_'+materia_id).val(new_cantidad); //MANDAMOS LA NUEVA CANTIDAD EN EL INPUT

          append = false;
          
          calculateTotal();
          clearInputsDetails();
        }

      });
      if(append)
      {

        count++;
        $('#ped_det').append(
          '<tr name="detalle">'+
            '<td>'+count+'</td>'+
            '<td>'+materianame+'</td>'+
            '<td id="td_cantidad_'+materia_id+'">'+$.number(cantidad,0,',','.')+'</td>'+
            '<input type="hidden" name="materias[]" value="'+materia_id+'"/>'+
            '<input type="hidden" id="cantidad_'+materia_id+'" name="cantidades[]" value="'+cantidad+'"/>'+
            '<td><a href="javascript:;" onClick="removeRow(this);"><i class="ri-close-line"></a></i></td>'
          +'</tr>'
        );
  
        calculateTotal();
        clearInputsDetails();
      }
    }

    function clearInputsDetails() 
    {

      $('#presentacion').empty();
      $('#unidad').empty();
      $('#categoria').empty();

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
