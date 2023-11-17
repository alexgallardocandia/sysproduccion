@extends('layouts.principal')
@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Crear Empleado</h5>
                        </div>
                        <div class="card-body">
                            <form id="form">
                                @csrf
                                <div class="form-group">
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nombres</label>
                                        <div class="col-sm-4">
                                            <input name="nombres" type="text" class="form-control" required>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Apellidos</label>
                                        <div class="col-sm-4">
                                            <input name="apellidos" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nro de CI</label>
                                        <div class="col-sm-4">
                                            <input name="ci" type="text" class="form-control" format-number
                                                required>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Direccion</label>
                                        <div class="col-sm-4">
                                            <input name="direccion" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Telefono</label>
                                        <div class="col-sm-4">
                                            <input name="telefono" type="text" class="form-control" format-number
                                                required>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-4">
                                            <input name="email" type="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha de
                                            Nacimiento</label>
                                        <div class="col-sm-4">
                                            <input name="fecha_nacimiento" type="date" class="form-control" required>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Estado Civil</label>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select class="form-control select2" name="estado_id" id="estado_id">
                                                    @foreach ($eciviles as $ecivil)
                                                        <option value='{{ $ecivil->id }}'>{{ $ecivil->descripcion }}
                                                        </option>
                                                    @endforeach()
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Cargo</label>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select class="form-control select2" name="cargo_id" id="cargo_id">
                                                    @foreach ($cargos as $cargo)
                                                        <option value='{{ $cargo->id }}'>{{ $cargo->descripcion }}
                                                        </option>
                                                    @endforeach()
                                                </select>
                                            </div>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Sucursal</label>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select class="form-control select2" name="sucursal_id"
                                                    id="sucursal_id">
                                                    @foreach ($sucursales as $sucursal)
                                                        <option value='{{ $sucursal->id }}'>{{ $sucursal->descripcion }}
                                                        </option>
                                                    @endforeach()
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="ri-save-3-fill"></i>
                                        Guardar</button>
                                    <a href="{{ url('empleados') }}" class="btn btn-danger"><i
                                            class="ri-close-circle-fill"></i> Cancelar</a>
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
            $('#referenciales-nav').addClass("show"); //coloca el menu en show
            $('#personas-menu').addClass("active"); //coloca activo el submenu usuario

            $('#form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('empleados.store') }}",
                    data: $(this).serialize(),
                    success: function(response) {
                      window.location.href = "{{ route('empleados.index') }}";
                    },
                    error: function(response) {
                        laravelErrorMessages(response);
                    }
                });

            });
        });
    </script>
@endsection
