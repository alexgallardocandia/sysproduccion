@extends('layouts.principal')
@section('content')
  <div class="wrapper wrapper-content">
    <div class="row">
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5>Crear Ajuste</h5>
              </div>
              <div class="card-body">
                <div class="mb-3"></div>
                <form class="row g-3" id="form">
                  @csrf
                    <div class="col-md-6">
                      <label for="fecha" class="form-label">Fecha</label>
                      <input name="fecha" type="text" id="fecha" class="form-control" value="{{ now()->format('d/m/Y') }}" readonly>
                    </div>
                    <div class="col-md-6">
                      <label for="almacen_id" class="form-label">Almacen</label>
                      <select class="selectpicker form-control" name="almacen_id" id="almacen_id" data-live-search="true" >
                        <option value="">Seleccione...</option>
                        @foreach ($almacenes as $almacen )
                            <option value="@json($almacen->id)">{{$almacen->descripcion}}</option>
                        @endforeach
                      </select>
                      <input type="text" id="almacen_show" class="form-control" readonly hidden/>
                    </div>
                    <div class="row g-3">
                      <hr>
                      <p>Detalle de Ajuste</p>
                      <div class="col-md-4">
                        <div class="col-md-12">
                          <label for="materia_id" class="col-sm-6 col-form-label">Materia P.</label>
                        </div>
                        <div class="col-md-12">
                        <select class="selectpicker col-md-12" data-live-search="true" name="materia_id" id="materia_id">
                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12">
                          <label for="cant_stock" class="col-sm-6 col-form-label">En Stock</label>
                        </div>
                        <div class="col-md-12">
                          <input name="cant_stock" id="cant_stock" type="text" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="col-md-12">
                          <label for="cant_almacen" class="col-sm-4 col-form-label">En Fisico</label>
                        </div>
                        <div class="col-md-12">
                          <input name="cant_almacen" id="cant_almacen" type="text" class="form-control" format-number/>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="motivo" class="col-sm-4 col-form-label">Motivo</label>
                        <textarea name="motivo" id="motivo" type="text" class="form-control"></textarea>
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
                              <th scope="col">En Stock</th>
                              <th scope="col">Stock Fisico</th>
                              <th scope="col">Motivo</th>
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
                          <a href="{{url('ajuste-stocks')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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

    $(function() {

      $('#compras-nav').addClass("show");//coloca el menu en show
      $('#ajuste-stocks-menu').addClass("active");//coloca activo el submenu usuario

      $('#form').on('submit', function(e) {

        e.preventDefault();
        $('input[type=submit]').prop('disable', true);

        $.ajax({
          type: "POST",
          url: "{{route('ajuste-stocks.store')}}",
          data: $(this).serialize(),            
          success: function (response) {
            redirect("{{ route('ajuste-stocks.index') }}");
          },
          error:function(data){
            laravelErrorMessages(data);
            $('input[type=submit]').prop('disable', false);

          }
        });
      });

      $('#almacen_id').on('change', function() {

        $('#almacen_show').val($(this).find('option:selected').text());
        $('#almacen_show').prop('hidden', false);
        $('#almacen_id').selectpicker('hide');

        $.ajax({
          type: "POST",
          url: "{{url('ajax/ajuste-stocks/getMateriaPrima')}}",
          data: $(this).serialize(),            
          success: function (data) {
            $('#materia_id').html('');
            $('#materia_id').append('<option value="" >Seleccione...</option');
            $.each(data, function(index, value){
                $('#materia_id').append('<option value="'+value.id+'" >'+value.nombre+'</option');
            });
            $('#materia_id').selectpicker('refresh');
          },
          error:function(data){
            laravelErrorMessages(data);
          }
        });

      });

      $('#materia_id').on('change', function(){

        $.ajax({
          type: "POST",
          url: "{{url('ajax/ajuste-stocks/getStockMateria')}}",
          data: { materia_id: $(this).val(), almacen_id: $('#almacen_id').find('option:selected').val() } ,
          success: function (data) {
            $('#cant_stock').val('');
            $('#cant_stock').val(parseInt(data.actual));
          },
          error:function(data){
            laravelErrorMessages(data);
          }
        });
      });

      $('#btn_agregar').click(function() {

        var materianame = $('#materia_id option:selected').text();
        var materia_id  = $('#materia_id option:selected').val();
        var en_stock    = $('#cant_stock').val();
        var stock_fisico    = $('#cant_almacen').val();
        var motivo      = $('#motivo').val();

        if ( materia_id == '' || en_stock == '' || stock_fisico == '' || motivo == '') {

          swal.fire("Sistema","Favor completa todos los campos.","info");
        
        } else {

          addDetail( materianame, materia_id,en_stock, stock_fisico.replace('.',''), motivo);

        }
        $('#materia_id').selectpicker('val','');
        $('#cant_almacen').val('');
        $('#cant_stock').val(0);
        $('#motivo').val('');
        
      });
    });
    function addDetail(materianame, materia_id,en_stock, stock_fisico, motivo)
    {
      count++;
        $('#pre_det').append(
          '<tr name="detalle[]" id="detalle">'+
            '<td>'+count+'</td>'+
            '<td>'+materianame+'</td>'+
            '<td>'+$.number(en_stock,0,',','.')+'</td>'+
            '<td>'+$.number(stock_fisico,0,',','.')+'</td>'+
            '<td>'+motivo+'</td>'+
            '<input type="hidden" name="materias[]" value="'+materia_id+'"/>'+
            '<input type="hidden" name="stock_fisico[]" value="'+stock_fisico+'"/>'+
            '<input type="hidden" name="en_stock[]" value="'+en_stock+'"/>'+
            '<input type="hidden" name="motivos[]" value="'+motivo+'"/>'+
            '<td></td>'+
            '<td><a href="javascript:;" onClick="removeRow(this);"><i class="ri-close-line"></a></i></td>'
          +'</tr>'
        );
      $('#oculto').prop('hidden', false);

    }

    function removeRow(t)
    {
        $(t).parent().parent().remove();
        count--;
        calculateTotal();
    }

</script>
@endsection
