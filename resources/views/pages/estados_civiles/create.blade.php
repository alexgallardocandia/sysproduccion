@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Crear Estado Civil</h5>              
            </div>
            <div class="card-body">                                  
                <form method="POST" action="{{route('estados-civiles.store')}}">
                @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                        <input name="descripcion" type="text" class="form-control" id="descripcion" required>
                        </div>
                    </div>                   
                        <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i> Guardar</button>
                        <a href="{{url('estados-civiles')}}" class="btn btn-danger"><i class="ri-close-circle-fill"></i> Cancelar</a>
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