@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Stocks</h5>
              {{-- <a href="{{url('stocks/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a> --}}
              <div class="card-header">
                <form method="GET">
                    <div class="row">
                        <div class="form-group col-md-3">
                          <label for="almacen_id">Almacen</label>
                          <select name="almacen_id" id="almacen_id" class="form-control selectpicker" data-live-search="true">
                            <option value="">Seleccion..</option>
                            @foreach ($almacenes as $almacen)
                                <option value="{{$almacen->id}}" {{ $almacen->id == request()->almacen_id ? 'selected' : '' }}>{{$almacen->descripcion}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="materia_prima_id">Materia Prima</label>
                          <select name="materia_prima_id" id="materia_prima_id" class="form-control selectpicker" data-live-search="true">
                            <option value="">Seleccion..</option>
                            @foreach ( $materias as $materia)
                                <option value="{{$materia->id}}" {{ $materia->id==request()->materia_prima_id ? 'selected' : '' }}>{{$materia->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <button type="submit" class="btn btn-primary" name="filter" value="1"><i class="bi bi-search"></i></button>
                          @if(request()->filter)
                              <a href="{{ request()->url() }}" class="btn btn-warning"><i class="bi bi-backspace"></i></a>
                          @endif
                      </div>
                    </div>
                </form>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <!-- Table with stripped rows -->
                <table class="table table-striped ">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Almacen</th>
                      <th scope="col">Materia Prima</th>
                      <th scope="col">Minimo</th>
                      <th scope="col">Maximo</th>
                      <th scope="col">Stock Actual</th>
                      <th scope="col">Creado</th>
                      <th scope="col">Actualizado</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($stocks as $stock)
                    
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$stock->almacen->descripcion}}</td>
                          <td>{{$stock->materia_prima->nombre}}</td>
                          <td>{{$stock->cantidad_minima}}</td>
                          <td>{{$stock->cantidad_maxima}}</td>
                          <td>{{$stock->actual}}</td>
                          <td>{{$stock->created_at}}</td>
                          <td>{{$stock->updated_at}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $stocks->appends(request()->query())->links() }}
              </div>
            </div>
              <!-- End Table with stripped rows -->
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

    $('#referenciales-nav').addClass('show');
    $('#stocks-menu').addClass('active');

  });
</script>
@endsection