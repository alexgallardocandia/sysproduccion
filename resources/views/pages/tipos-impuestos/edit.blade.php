@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Tipo de Impuesto {{$tipo->descripcion}}</h5>              
            </div>
            <div class="card-body">                   
                <form method="POST" action="{{route('tipos-impuestos.update')}}">
                @csrf
                @method('PUT')
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                        <input name="descripcion" type="text" class="form-control" id="inputText" value="{{$tipo->descripcion}}" required>
                        <input name="tipo_id" type="hidden" class="form-control" id="inputText" value="{{$tipo->id}}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Valor</label>
                        <div class="col-sm-10">
                        <input name="valor" type="number" step="0.01" class="form-control" id="inputText" value="{{$tipo->valor}}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Signo</label>
                        <div class="col-sm-10">
                        <input name="signo" type="text" class="form-control" id="inputText" value="{{$tipo->signo}}" required>
                        </div>
                    </div>
                    <div class="">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Modificar</button>
                        <a href="{{url('tipos-impuestos')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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