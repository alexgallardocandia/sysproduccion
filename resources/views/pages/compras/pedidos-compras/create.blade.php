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
                    <label for="persona_id" class="form-label">Solicitante</label>
                    <input name="user" id="user" class="form-control" value="{{auth()->user()->empleado ? auth()->user()->empleado->fullname:''}}" readonly/>
                    <input name="user_id" id="user_id" type="hidden" value="{{auth()->user()->id}}"/>
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
                      <select class="form-select" name="materia_id" id="materia_id">
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

        $('#form').on('submit', function(e){
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "{{route('pedidos-compras.store')}}",
            data: $(this).serialize(),            
            success: function (response) {
              window.location.href = "{{ route('pedidos-compras.index') }}";
            },
            error:function(data){
              laravelErrorMessages(data);
            }
          });
        });

        $('#btn_agregar').click(function() {
          var materianame = $('#materia_id option:selected').text();
          var materia     = $('#materia_id').val();
          var cantidad    = $('#cantidad').val();

          if ( (materia === 'Seleccione una materia prima') || (cantidad == 0) || (cantidad == '') ) {

            swal.fire("Hay campos vacios","Favor completa todos los campos...","error");
          } 
          else {
            $('#oculto').prop('hidden',false);

            add_detail(materianame, cantidad, materia);

            $('#materia_id').val('Seleccione una materia prima');
            $('#cantidad').val('');
            $('#umedida_id').val('Seleccione una unidad');
          }
        }); 
        
        $('#persona_id').on('change', function(){
          
        });
    });
    function add_detail( materianame, cantidad,materia_id ) {

      count++;
      $('#ped_det').append(
        '<tr>'+
          '<td>'+count+'</td>'+
          '<td>'+materianame+'</td>'+
          '<td>'+cantidad+'</td>'+
          '<input type="hidden" name="materias[]" value="'+materia_id+'"/>'+
          '<input type="hidden" name="cantidades[]" value="'+cantidad+'"/>'+
          '<td><a href="javascript:;" onClick="removeRow(this);"><i class="ri-close-line"></a></i></td>'
        +'</tr>'
      );

      calculateTotal();
      clearInputsDetails();

      $('#presentacion').append( '<label for="presentacion" class="col-sm-8 col-form-label">Presentacion</label>' );
      $('#unidad').append( '<label for="presentacion" class="col-sm-8 col-form-label">Unidad de Medida</label>' );
      $('#categoria').append( '<label for="presentacion" class="col-sm-8 col-form-label">Categoria</label>' );
    }

    function clearInputsDetails() {

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
