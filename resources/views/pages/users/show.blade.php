@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
      <section class="section">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="d-flex justify-content-between">
                              <h5 class="card-title">Usuario <b>{{$users->name}}</b></h5>
                              <a href="{{url('users')}}" class="btn btn-xs"><i class="ri-arrow-left-circle-fill"></i>Volver</a>
                          </div>
                          <div class="card-body">
                              <!-- List group With Icons -->
                              <ul class="list-group">
                                  <li class="list-group-item"><i class="ri-mail-line me-1 text-success"></i><b>Correo: </b>{{$users->email}}</li>
                                  <li class="list-group-item"><i class="ri-checkbox-circle-line me-1 text-primary"></i><b>Estado: </b> <span class="badge bg-{{config('constants.users-status-label.'.$users->status)}}" >{{config('constants.users-status.'.$users->status)}}</span></li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-success"></i><b>Creado: </b>{{$users->created_at->format('d/m/Y H:m:s')}}</li>
                                  <li class="list-group-item"><i class="ri-calendar-2-fill me-1 text-primary"></i><b>Modificado:</b>{{$users->updated_at->format('d/m/Y H:m:s')}}</td>                        
                              </ul><!-- End List group With Icons -->
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
  $(document).ready(function() {
    $('#referenciales-nav').addClass("show");
    $('#users-menu').addClass("active");    
  });
</script>
@endsection