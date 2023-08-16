@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Ciudad {{$ciudad->descripcion}}</h5>              
            </div>
            <div class="card-body">                   
                <form method="POST" action="{{route('ciudades.update')}}">
                @csrf
                @method('PUT')
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                        <input name="descripcion" type="text" class="form-control" id="inputText" value="{{$ciudad->descripcion}}" required>
                        <input name="ciudad_id" type="hidden" class="form-control" id="inputText" value="{{$ciudad->id}}" required>
                        </div>
                    </div>
                    <div class="card-footer">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Modificar</button>
                        <a href="{{url('ciudades')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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