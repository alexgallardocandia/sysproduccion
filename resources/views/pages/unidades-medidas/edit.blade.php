@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Unidad de Medida {{$unidad->descripcion}}</h5>              
            </div>
            <div class="card-body">                   
                <form method="POST" action="{{route('unidades-medidas.update')}}">
                @csrf
                @method('PUT')
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                        <input name="descripcion" type="text" class="form-control" id="inputText" value="{{$unidad->descripcion}}" required>
                        <input name="unidad_id" type="hidden" class="form-control" id="inputText" value="{{$unidad->id}}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Signo</label>
                        <div class="col-sm-10">
                        <input name="signo" type="text" class="form-control" id="inputText" value="{{$unidad->signo}}" required>
                        </div>
                    </div>
                    <div class="">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Modificar</button>
                        <a href="{{url('unidades-medidas')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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