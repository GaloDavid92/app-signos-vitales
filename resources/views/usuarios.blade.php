@extends('app')

@section('content')
    <div class="card">
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="fa-solid fa-house"></i>&nbsp;Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="Personas"><i class="fa-solid fa-people-group"></i>&nbsp;Usuarios</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container border p-4 mt-4">
        <h2><i class="fa-solid fa-people-group"></i>&nbsp;Usuarios</h2>


        @error('password_confirm')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror

        @if (session('success'))
            <div class="alert alert-succes alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex flex-row-reverse mb-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newUsuario">
                Nuevo&nbsp;<i class="fa-solid fa-person-circle-plus"></i>
            </button>
        </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="newUsuario" tabindex="-1" aria-labelledby="newUsuarioLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newUsuarioLabel">Agregar Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('usuario-save') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label mt-2">Nombre</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nombre" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label mt-2">Correo</label>
                                    <input type="email" class="form-control" name="email" placeholder="Correo"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label mt-2">Contraseña</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Contraseña" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label mt-2">Confirmar</label>
                                    <input type="password" class="form-control" name="password_confirm"
                                        placeholder="Contraseña" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover" id="tblPersonas">
            <thead>
                <th>Nombre</th>
                <th>Correo</th>
            </thead>
            <tbody>
                @foreach ($usuarios as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->email }}</td>
                        <td>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-toggle="tooltip"
                                data-placement="top" title="Editar" data-bs-target="#{{ 'newUsuario' . $p->id }}">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @foreach ($usuarios as $p)
            <div class="modal fade" id="{{ 'newUsuario' . $p->id }}" tabindex="-1"
                aria-labelledby="{{ 'newUsuarioLabel' . $p->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="{{ 'newUsuarioLabel' . $p->id }}">Editar Usuario
                                {{ $p->nombre }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('usuario-update', ['id' => $p->id]) }}" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label mt-2">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nombre"
                                            required value="{{ $p->name }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label mt-2">Correo</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Correo" required value="{{ $p->email }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password" class="form-label mt-2">Contraseña</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Contraseña" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password" class="form-label mt-2">Confirmar</label>
                                        <input type="password" class="form-control" name="password_confirm"
                                            placeholder="Contraseña" required>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
