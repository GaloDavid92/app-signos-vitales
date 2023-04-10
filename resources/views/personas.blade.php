@extends('app')

@section('content')
    <div class="card">
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="fa-solid fa-house"></i>&nbsp;Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="Personas"><i class="fa-solid fa-people-group"></i>&nbsp;Personas</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container border p-4 mt-4">
        <h2><i class="fa-solid fa-people-group"></i>&nbsp;Personas</h2>


        @error('title')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        
        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
            <div class="alert alert-succes alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex flex-row-reverse mb-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newPersona">
                Nuevo&nbsp;<i class="fa-solid fa-person-circle-plus"></i>
            </button>
        </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="newPersona" tabindex="-1" aria-labelledby="newPersonaLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newPersonaLabel">Agregar Persona</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('persona-save') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label mt-2">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="apellido" class="form-label mt-2">Apellido</label>
                                    <input type="text" class="form-control" name="apellido" placeholder="Apellido"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="identificacion" class="form-label mt-2">Identificacion</label>
                                    <input type="text" class="form-control" name="identificacion" placeholder="Identificacion"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="fecha_nacimiento" class="form-label mt-2">Fecha Nacimiento</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento"
                                        placeholder="Fecha Nacimiento" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sexo" class="form-label mt-2">Sexo</label>
                                    <select name="sexo" class="form-control" required>
                                        <option></option>
                                        <option value="1">Masculino</option>
                                        <option value="0">Femenino</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="contacto" class="form-label mt-2">Diagnóstico</label>
                                    <input type="text" class="form-control" name="diagnostico" placeholder="Diagnóstico">
                                </div>
                                <div class="col-md-6">
                                    <label for="contacto" class="form-label mt-2">Prescripción Médica</label>
                                    <input type="text" class="form-control" name="prescripcion_medica" placeholder="Prescripción Médica">
                                </div>
                                <div class="col-md-6">
                                    <label for="contacto" class="form-label mt-2">Observaciones</label>
                                    <textarea class="form-control" name="observacion" placeholder="Observaciones"></textarea>
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
                <th>Apellido</th>
                <th>Identificacion</th>
                <th>Fecha Nacimiento</th>
                <th>Sexo</th>
            </thead>
            <tbody>
                @foreach ($personas as $p)
                    <tr>
                        <td>{{ $p->nombre . ' ' . $p->apellido }}</td>
                        <td>{{ $p->identificacion }}</td>
                        <td>{{ $p->fecha_nacimiento }}</td>
                        <td>
                            @if ($p->sexo)
                                Masculino
                            @else
                                Femenino
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-toggle="tooltip"
                                data-placement="top" title="Editar" data-bs-target="#{{ 'newPersona' . $p->id }}">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                            <a class="btn btn-dark btn-sm"
                                href="{{ route('signos_vitales', ['id' => $p->id]) }}">Signos Viales</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @foreach ($personas as $p)
            <div class="modal fade" id="{{ 'newPersona' . $p->id }}" tabindex="-1"
                aria-labelledby="{{ 'newPersonaLabel' . $p->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="{{ 'newPersonaLabel' . $p->id }}">Editar Persona
                                {{ $p->nombre }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('persona-update', ['id' => $p->id]) }}" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label mt-2">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                                            required value="{{ $p->nombre }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="apellido" class="form-label mt-2">Apellido</label>
                                        <input type="text" class="form-control" name="apellido"
                                            placeholder="Apellido" required value="{{ $p->apellido }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="identificacion" class="form-label mt-2">Identificacion</label>
                                        <input type="text" class="form-control" name="identificacion"
                                            placeholder="Apellido" required value="{{ $p->identificacion }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="fecha_nacimiento" class="form-label mt-2">Fecha Nacimiento</label>
                                        <input type="date" class="form-control" name="fecha_nacimiento"
                                            placeholder="Fecha Nacimiento" required value="{{ $p->fecha_nacimiento }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sexo" class="form-label mt-2">Sexo</label>
                                        <select name="sexo" class="form-control" required>
                                            <option></option>
                                            @if ($p->sexo == '1')
                                                <option value="1" selected>Masculino</option>
                                                <option value="0">Femenino</option>
                                            @else
                                                <option value="1">Masculino</option>
                                                <option value="0" selected>Femenino</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contacto" class="form-label mt-2">Diagnóstico</label>
                                        <input type="text" class="form-control" name="diagnostico" placeholder="diagnostico" value="{{ $p->diagnostico }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contacto" class="form-label mt-2">Prescripción Médica</label>
                                        <input type="text" class="form-control" name="prescripcion_medica" placeholder="prescripcion_medica" value="{{ $p->prescripcion_medica }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contacto" class="form-label mt-2">Observaciones</label>
                                        <textarea type="text" class="form-control" name="observacion" placeholder="observacion">{{ $p->observacion }}</textarea>
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
