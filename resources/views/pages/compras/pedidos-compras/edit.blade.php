@extends('layouts.principal')
@section('content')
  <div class="wrapper wrapper-content">
    <div class="row">
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5>Editar Pedido de Compra #{{$pedido_id->id}}</h5>              
              </div>
              <div class="card-body">
                <div class="mb-3"></div>
                <form class="row g-3" id="form">
                  @csrf
                  <div class="col-md-3">
                    <label for="persona_id" class="form-label">Solicitante</label>
                    <input id="user" class="form-control" value="{{ $pedido_id->user->persona->fullname }}" readonly/>
                    <input name="user_id" id="user_id" type="hidden" value="{{ $pedido_id->user_id }}"/>
                    <input type="hidden" name="pedido_compra_id" value="@json($pedido_id->id)" />
                  </div>
                  <div class="col-md-3">
                    <label for="departamento_id" class="form-label">Departamento</label>
                    <input id="departamento" class="form-control" value="{{ $pedido_id->user->persona->cargo->departamento->nombre }}" readonly>
                    <input name="departamento_id" id="departamento_id" type="hidden" value="{{ $pedido_id->user->persona->cargo->departamento->id }}" />
                  </div>
                  <div class="col-md-3">
                    <label for="sucursal_id" class="form-label">Sucursal</label>
                    <input id="sucursal" class="form-control" value="{{ $pedido_id->user->persona->sucursal->descripcion }}" readonly>
                    <input name="sucursal_id" id="sucursal_id" type="hidden" value="{{ $pedido_id->user->persona->sucursal->id }}" />
                  </div>
                  <div class="col-md-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input name="fecha" id="fecha" class="form-control" value="{{ $pedido_id->fecha_pedido }}" readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="fecha" class="form-label">Prioridad</label>
                    <select class="form-select" name="prioridad" id="prioridad">
                      <option value="{{ $pedido_id->prioridad }}">{{ config('constants.pedidos-compras-prioridad.'.$pedido_id->prioridad) }}</option>
                      <option value='3'>Baja</option>
                      <option value='2'>Media</option>
                      <option value='1'>Alta</option>
                    </select>
                  </div>
                  <div class="row g-3">
                    <div class="col-md-3">
                      <label for="materia_id" class="col-sm-4 col-form-label">Materia Prima</label>
                      <select class="form-select" id="materia_id">
                        <option value="">Seleccione...</option>
                        @foreach($materias as $materia)                              
                          <option value='{{$materia->id}}'>{{$materia->nombre}}</option>
                        @endforeach()                            
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="cantidad" class="col-sm-4 col-form-label">Cantidad</label>
                      <input id="cantidad" type="number" min="1" class="form-control">
                    </div>
                    <div class="col-md-3" id="presentacion">
                      <label for="presentacion" class="col-sm-8 col-form-label">Presentacion</label>
                    </div>
                    <div class="col-md-3" id="unidad">
                      <label for="unidad" class="col-sm-8 col-form-label">Unidad de Medida</label>
                    </div>
                    <div class="col-md-3" id="categoria">
                      <label for="categoria" class="col-sm-8 col-form-label">Categoria</label>
                  </div>
                    <div class="col-md-3" style="margin-top:3.5%;">
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
                        <th scope="col">Materia Prima</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody id="ped_det"></tbody>
                    <tfoot class="bold">
                        <tr>
                            <td colspan="2"></td>
                            <td id="td_total" class="text-right"></td>                                            
                        </tr>
                    </tfoot>
                  </table>
                  <input type="hidden" name="detail_total" id="detail_total" value="0">
                  <!-- End Table with stripped rows -->            
                </div>
                <div class="card-footer">                        
                    <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Modificar</button>
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

      $.ajax({
        type: "PUT",
        url: "{{route('pedidos-compras.update')}}",
        data: $(this).serialize(),            
        success: function (response) {
          // window.location.href = "{{ route('pedidos-compras.index') }}";
        },
        error:function(data) {
          laravelErrorMessages(data);
        }
      });

    });

    $('#materia_id').on('change', function() {
      getAttributes();
    });

    $('#btn_agregar').click(function() {
      afterAddDetails();
    }); 

    chargeDetails();

  });

  function getAttributes() {
      var data  = { 'materia_id' : $('#materia_id option:selected').val() };

      $.ajax({
        type: "POST",
        url: "{{ url('pedidos-compras/ajax-attributes') }}",
        data: data,
        success: function (response) {
          
          $('#presentacion').append( '<input type="text" class="form-control" value="'+response.materia.presentacion+'" readonly>' );
          $('#unidad').append( '<input type="text" class="form-control" value="'+response.materia.unidad+'" readonly>' );
          $('#categoria').append( '<input type="text" class="form-control" value="'+response.materia.categoria+'" readonly>' );

        },
        error:function(response) {
          laravelErrorMessages(response);
        }
        
      });
  }

  function chargeDetails() {

      var details = @json($detalles);

      $.each(details, function (key, value) { 

        add_detail(value.materianame, value.cantidad, value.materia_id);

      });

  }

  function add_detail(materianame, cantidad, materia_id) {

      count++;

      $('#ped_det').append(
        '<tr>'+
          '<td>'+count+'</td>'+
          '<td>'+materianame+'</td>'+
          '<td>'+$.number(cantidad, 0, ',', '.')+'</td>'+
          '<input type="hidden" name="materias[]" value="'+materia_id+'"/>'+
          '<input type="hidden" name="cantidades[]" value="'+cantidad+'"/>'+
          '<td><a href="javascript:;" onClick="removeRow(this);"><i class="ri-close-line"></a></i></td>'
        +'</tr>'
      );

      calculateTotal();

      $('#presentacion').empty();
      $('#presentacion').append( '<label for="presentacion" class="col-sm-8 col-form-label">Presentacion</label>' );
      $('#unidad').empty();
      $('#unidad').append( '<label for="presentacion" class="col-sm-8 col-form-label">Unidad de Medida</label>' );
      $('#categoria').empty();
      $('#categoria').append( '<label for="presentacion" class="col-sm-8 col-form-label">Categoria</label>' );
      
      $('#oculto').prop('hidden',false);

  }
  function afterAddDetails() {

        var materianame = $('#materia_id option:selected').text();
        var materia     = $('#materia_id').val();
        var cantidad    = $('#cantidad').val();

        if ( (materia === 'Seleccione una materia prima') || (cantidad == 0) || (cantidad == '') ) {
          
          swal.fire("Hay campos vacios","Favor completa todos los campos...","error");

        } else {

          add_detail(materianame, cantidad, materia);

          $('#materia_id').val('');
          $('#cantidad').val('');

        }
  }

  function removeRow(t) {

        $(t).parent().parent().remove();

        count--;
        
        calculateTotal();
  }
  function calculateTotal() {

        var total = 0;
        $( 'input[name^="cantidades[]"]' ).each( function () {          
            total += parseInt($(this).val());
        });

        $("#td_total").html('<b>' + $.number(total, 0, ',', '.')+'</b>');

        $("#detail_total").val('');

        $("#detail_total").val(total);
  }
</script>
@endsection
