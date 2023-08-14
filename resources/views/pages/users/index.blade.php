@extends('layouts.principal')
@section('content')  
<div class="wrapper wrapper-content">
  <div class="row">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5>Usuarios</h5>
              <a href="{{url('users/create')}}" class="btn btn-success btn-xs"><i class="ri-add-box-fill"></i>Agregar</a>
            </div>
            <div class="card-body">                          
              <!-- Table with stripped rows -->
              <table class="table ">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Creado</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($usuarios as $usuario)
                      <tr>
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->created_at->format('d/m/Y')}}</td>
                        <td>                        
                          <a href="{{url('users/' . $usuario->id)}}"><i class="bi bi-info-circle-fill"></i></a>
                          <a href="{{url('users/' . $usuario->id.'/edit')}}"><i class="bi bi-pencil-fill"></i></i></a>
                          <a href="#"><i class="bi bi-trash-fill"></i></a>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
              <!-- End Table with stripped rows -->
          </div>    
        </div>
      </div>
    </section>      
  </div>
</div>    
@endsection