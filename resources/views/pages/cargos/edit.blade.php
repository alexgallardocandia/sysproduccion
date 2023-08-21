@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Cargo {{$cargos->descripcion}}</h5>              
            </div>
            <div class="card-body">                   
                <form method="POST" action="{{route('cargos.update')}}">
                @csrf
                @method('PUT')
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                        <input name="descripcion" type="text" class="form-control" id="inputText" value="{{$cargos->descripcion}}" required>
                        <input name="cargo_id" type="hidden" class="form-control" id="inputText" value="{{$cargos->id}}" required>
                        </div>
                    </div>
                    <div class="">                        
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Modificar</button>
                        <a href="{{url('cargos')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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
@section('script')
<script>
    $(document).ready(function() {
        $('#referenciales-nav').addClass("show");//coloca el menu en show
        $('#cargos-menu').addClass("active");//coloca activo el submenu usuario
    });
</script>
@endsection