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
                  <div class="col-md-3">
                    <label for="persona_id" class="form-label">Solicitante</label>
                    <input name="user" id="user" class="form-control" value="{{auth()->user()->persona ? auth()->user()->persona->fullname:''}}" readonly/>
                    <input name="user_id" id="user_id" type="hidden" value="{{auth()->user()->id}}"/>
                  </div>
                  <div class="col-md-3">
                    <label for="departamento_id" class="form-label">Departamento</label>
                    <input name="departamento" id="departamento" class="form-control" value="{{auth()->user()->persona->cargo->departamento->nombre}}" readonly>
                    <input name="departamento_id" id="departamento_id" type="hidden" value="{{auth()->user()->persona->cargo->departamento->id}}" />
                  </div>
                  <div class="col-md-3">
                    <label for="sucursal_id" class="form-label">Sucursal</label>
                    <input name="sucursal" id="sucursal" class="form-control" value="{{auth()->user()->persona->sucursal->descripcion}}" readonly>
                    <input name="sucursal_id" id="sucursal_id" type="hidden" value="{{auth()->user()->persona->sucursal->id}}" />
                  </div>
                  <div class="col-md-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input name="fecha" id="fecha" class="form-control" value="{{ date('d/m/Y') }}" readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="fecha" class="form-label">Prioridad</label>
                    <select class="form-select" name="prioridad" id="prioridad">
                      <option value='3'>Baja</option>
                      <option value='2'>Media</option>
                      <option value='1'>Alta</option>
                    </select>
                  </div>
                  <div class="row g-3">
                    <div class="col-md-3">
                      <label for="materia_id" class="col-sm-4 col-form-label">Materia Prima</label>
                      <select class="form-select" name="materia_id" id="materia_id">
                        <option value="">Seleccione...</option>
                        @foreach($materias as $materia)                              
                          <option value='{{$materia->id}}'>{{$materia->nombre}}</option>
                        @endforeach()                            
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="cantidad" class="col-sm-4 col-form-label">Cantidad</label>
                      <input name="cantidad" id="cantidad" type="number" min="1" class="form-control">
                    </div>
                    <div class="col-md-3">
                      <label for="umedida_id" class="col-sm-8 col-form-label">Presentacion</label>
                      <select class="form-select" name="umedida_id" id="umedida_id">
                        <option selected>Seleccione una unidad</option>
                        @foreach($umedidas as $umedida)                              
                          <option value='{{$umedida->id}}'>{{$umedida->descripcion}}</option>
                        @endforeach()                            
                      </select>
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
        
        $('#persona_id').on('change', function(){
          
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
