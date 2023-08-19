@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Proveedor</h5>              
            </div>
            <div class="card-body">                                  
                <form method="POST" action="{{route('proveedores.update')}}">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Razon Social</label>
                    <div class="col-sm-4">
                      <input name="razon_social" type="text" class="form-control" value="{{$proveedor->razon_social}}" required>
                      <input name="proveedor_id" type="hidden" class="form-control" value="{{$proveedor->id}}" required>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">RUC</label>
                    <div class="col-sm-4">
                      <input name="ruc" type="text" class="form-control" value="{{$proveedor->ruc}}" required>
                    </div>                      
                  </div>                    
                  <div class="row mb-3">       
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Telefono</label>
                      <div class="col-sm-4">
                        <input name="telefono" type="text" class="form-control" value="{{$proveedor->telefono}}" required>
                      </div>                
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Direccion</label>
                      <div class="col-sm-4">
                        <input name="direccion" type="text" class="form-control" value="{{$proveedor->direccion}}" required>
                      </div>                                            
                  </div>
                  <div class="row mb-3">                        
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-4">
                        <input name="email" type="email" class="form-control" value="{{$proveedor->email}}" required>
                      </div>            
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Ciudad</label>
                      <div class="col-sm-4">
                        <div class="form-group">                                              
                          <select class="form-control select2" name="ciudad_id" id="ciudad_id">
                            <option selected value="{{$proveedor->ciudad_id}}">{{$proveedor->Ciudad->descripcion}}</option>
                            @foreach($ciudades as $ciudad)                              
                              <option value='{{$ciudad->id}}'>{{$ciudad->descripcion}}</option>
                            @endforeach()                            
                          </select>
                        </div>                          
                      </div> 
                  </div>
                </div>                    
                <div class="card-footer">                        
                    <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Guardar</button>
                    <a href="{{url('proveedores')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
                </div>
              </form><!-- End Horizontal Form -->
            </div>
          </div>    
        </div>
      </div>
    </section>      
  </div>
</div>    
@endsection