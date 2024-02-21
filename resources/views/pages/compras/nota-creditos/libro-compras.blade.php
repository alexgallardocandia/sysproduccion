@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Libro Compras</h5>
              <div class="card-header">
                <form method="GET">
                    <div class="row">
                        <div class="form-group col-md-3">
                          <label for="compra_status">Estado</label>
                          <select name="compra_status" id="compra_status" class="form-control">
                            <option value="">Seleccion..</option>
                            @foreach (config('constants.compras-status') as $key => $compra)
                                <option value="{{$key}}" {{ $key==request()->compra_status ? 'selected' : '' }}>{{$compra}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="proveedor_id">Proveedor</label>
                          <select name="proveedor_id" id="proveedor_id" class="form-control selectpicker" data-live-search="true">
                            <option value="">Seleccion..</option>
                            @foreach ( $proveedores as $proveedor)
                                <option value="{{$proveedor->id}}" {{ $proveedor->id==request()->proveedor_id ? 'selected' : '' }}>{{$proveedor->razon_social}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="rango">Rango de Fecha</label>
                          <input type="text" class="flatpickr-range form-control" id="rango" name="rango" placeholder="Rango" value="{{request()->rango}}">
                          {{-- <input type="text" name="date_range"  class="form-control date_range text-center"  placeholder="Rango de fecha" value="{{ request()->date_range }}" autocomplete="off" date-range-mask> --}}
                      </div>
                    </div>
                    {{-- <div class="row">
                        <div class="form-group col-md-3">
                            <select name="voucher_box_id" class="form-control" select2>
                                <option value="">Seleccione un Punto Expedición</option>
                                @foreach($boxes as $key => $box)
                                <option value="{{ $key }}" {{ $key==request()->voucher_box_id ? 'selected' : '' }}>{{ $box }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::select('voucher_condition', config('constants.invoice_condition'), old('voucher_condition'), ['placeholder' => 'Seleccione Condicion', 'class' => 'form-control', 'select2']) }}
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::select('voucher_type[]', array_slice(config('constants.voucher_type'), 0, 2, true), request()->voucher_type, [ 'class' => 'form-control selectpicker', 'data-live-search' => 'true', 'multiple', 'data-actions-box'=>'true', 'data-none-Selected-Text' => 'Seleccione Tipo']) }}
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="date_range"  class="form-control date_range text-center"  placeholder="Rango de fecha" value="{{ request()->date_range }}" autocomplete="off" date-range-mask>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="form-group col-md-0 ">
                            <button type="submit" class="btn btn-primary" name="filter" value="1"><i class="bi bi-search"></i></button>
                            @if(request()->filter)
                                <a href="{{ request()->url() }}" class="btn btn-warning"><i class="bi bi-backspace"></i></a>
                            @endif
                        </div>
                    </div>
                </form>
              </div>
            </div>
            </div>
            <div class="card-body">                                     
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Nro.</th>
                      <th scope="col">Solicitante</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">Timbrado</th>
                      <th scope="col">Nro de Factura</th>
                      <th scope="col">Proveedor</th>
                      <th scope="col">Monto</th>
                      <th scope="col">Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($compras as $compra)  
                        <tr>
                          <td>{{$compra->id}}</td>
                          <td>{{$compra->orden_compra_id ? $compra->orden_compra->solicitante->fullname : 'ANULADO'}}</td>
                          <td>{{$compra->fecha}}</td>
                          <td>{{$compra->timbrado->numero}}</td>
                          <td>{{$compra->nro_factura}}</td>
                          <td>{{$compra->proveedor->razon_social}}</td>
                          <td>{{number_format($compra->getTotalDetalles(), 0, ',', '.')}}</td>
                          <td><span class="badge bg-{{ config('constants.compras-status-label.' . intval($compra->estado)) }}">{{ config('constants.compras-status.'. intval($compra->estado)) }}</span></td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $compras->appends(request()->query())->links() }}
              </div>
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
  $(document).ready(function(){
    $('#compras-nav').addClass('show');
    $('#libro-compras-menu').addClass('active');

    flatpickr('#rango', {
      mode: "range",
      dateFormat: "d/m/Y",
      locale: "es",
      conjunction: "-",
    });
  });
</script>
@endsection