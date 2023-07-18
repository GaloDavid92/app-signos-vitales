@extends('app')

@section('content')
    <div class="card">
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i
                                class="fa-solid fa-house"></i>&nbsp;Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="Personas"><i
                            class="fa-solid fa-people-group"></i>&nbsp;Personas</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container border p-4 mt-4">
        <h2><i class="fa-solid fa-people-group"></i>&nbsp;Adultos Mayores</h2>

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
                        <td>{{ $p->nombre }}</td>
                        <td>{{ $p->apellido }}</td>
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
                            <a class="btn btn-dark btn-sm" href="{{ route('signos_vitales', ['id' => $p->id]) }}">Signos
                                Viales</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="newPersona" tabindex="-1" aria-labelledby="newPersonaLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newPersonaLabel">Agregar Persona</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('persona-save') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">1.- DATOS DE IDENTIFICACIÓN PERSONAL DEL USUARIO</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nombre" class="form-label mt-2 small">Nombre</label>
                                            <input type="text" class="form-control form-control-sm" name="nombre"
                                                placeholder="Nombre" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="apellido" class="form-label mt-2 small">Apellido</label>
                                            <input type="text" class="form-control form-control-sm" name="apellido"
                                                placeholder="Apellido" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="identificacion" class="form-label mt-2 small">Identificacion</label>
                                            <input type="text" class="form-control form-control-sm" name="identificacion"
                                                placeholder="Identificacion" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="fecha_ingreso" class="form-label mt-2 small">Fecha de
                                                Ingreso</label>
                                            <input type="date" class="form-control form-control-sm" name="fecha_ingreso"
                                                placeholder="Fecha de Ingreso" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="fecha_nacimiento" class="form-label mt-2 small">Fecha
                                                Nacimiento</label>
                                            <input type="date" class="form-control form-control-sm"
                                                name="fecha_nacimiento" placeholder="Fecha Nacimiento" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="sexo" class="form-label mt-2 small">Sexo</label>
                                            <select name="sexo" class="form-control form-control-sm" required>
                                                <option></option>
                                                <option value="1">Masculino</option>
                                                <option value="0">Femenino</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="estado_civil" class="form-label mt-2 small">Estado Civil</label>
                                            <select name="estado_civil" class="form-control form-control-sm" required>
                                                <option></option>
                                                <option value="Soltero">Soltero</option>
                                                <option value="Casado">Casado</option>
                                                <option value="Viudo">Viudo</option>
                                                <option value="Divorciado">Divorciado</option>
                                                <option value="Unión Libre">Unión Libre</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="instruccion" class="form-label mt-2 small">Nivel de
                                                Instrucción</label>
                                            <select name="instruccion" class="form-control form-control-sm" required>
                                                <option></option>
                                                <option value="Analfabeto">Analfabeto</option>
                                                <option value="Primaria">Primaria</option>
                                                <option value="Secundaria">Secundaria</option>
                                                <option value="Superior">Superior</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="ocupacion" class="form-label mt-2 small">Profesión /
                                                Ocupación</label>
                                            <input type="text" class="form-control form-control-sm" name="ocupacion"
                                                placeholder="Ocupación" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header">2.- CONDICIONES AL INGRESO:</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="condicion_fisica" class="form-label mt-2 small">Condición
                                                Física</label>
                                            <textarea class="form-control form-control-sm" name="condicion_fisica" placeholder="Condición Física"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="condicion_psicologica" class="form-label mt-2 small">Condición
                                                Psicológica</label>
                                            <textarea class="form-control form-control-sm" name="condicion_psicologica" placeholder="Condición Psicológica"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="estado_salud" class="form-label mt-2 small">Estado de
                                                Salud</label>
                                            <textarea class="form-control form-control-sm" name="estado_salud" placeholder="Estado de Salud"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="vino_voluntad_propia" class="form-label mt-2 small">En caso de ser
                                                referido por otra institucion o instancia comunitaria (Especifíque):
                                                <br />¿Vino por propia voluntad?</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="radio" name="vino_voluntad_propia" value="Si"> Si
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="radio" name="vino_voluntad_propia" value="No"> No
                                                </div>
                                            </div>
                                            <input type="text" class="form-control form-control-sm"
                                                name="vino_voluntad_propia_especifique" placeholder="Especifique">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="recibe_algun_beneficio" class="form-label mt-2 small">Recibe algún
                                                beneficio social (Bono). Especifique:</label>
                                            <textarea class="form-control form-control-sm" name="recibe_algun_beneficio" placeholder="Especifique"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header">3.- SITUACIÓN FAMILIAR Y DE CONVIVENCIA</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="vive_con" class="form-label mt-2 small">¿Con quién vive?</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="radio" name="vive_con" value="Solo"> Solo
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="radio" name="vive_con" value="Conyuge"> Cónyuge/Pareja
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="radio" name="vive_con" value="Familiares"> Familiares
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="radio" name="vive_con" value="Otro"> Otro
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="num_personas_vive_con" class="form-label mt-2 small">Número de
                                                personas que viven con el adulto mayor: </label>
                                            <input type="number" class="form-control form-control-sm"
                                                onchange="addRows('num_personas_vive_con', 'tblConvivienteBody')" id="num_personas_vive_con"
                                                name="num_personas_vive_con" min="1">
                                        </div>
                                        <div class="col-md-9">
                                            <table class="table table-striped small" id="tblConviviente">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Nombre de convivientes sean o no familiares</th>
                                                        <th>Parentezco o afinidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tblConvivienteBody">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="calidad_relaciones" class="form-label mt-2 small">Calidad de las
                                                relaciones</label>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <input type="radio" name="calidad_relaciones" value="Buena"> Buena
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="radio" name="calidad_relaciones" value="Regular">
                                                    Regular
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="radio" name="calidad_relaciones" value="Mala"> Mala
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="calidad_relaciones_especifique" placeholder="Observaciones">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header">4.- OBSERVACIONES</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea class="form-control form-control-sm" name="observaciones" placeholder="Observaciones"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="responsable1" class="form-label mt-2 small">Responsables:</label>
                                            <input type="text" class="form-control form-control-sm"
                                                name="responsable1" placeholder="Coordinador">
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-sm"
                                                name="responsable2" placeholder="Facilitador">
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                </div>
                </form>
            </div>
        </div>

    </div>
    @foreach ($personas as $p)
        <div class="modal fade" id="{{ 'newPersona' . $p->id }}" tabindex="-1"
            aria-labelledby="{{ 'newPersonaLabel' . $p->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="{{ 'newPersonaLabel' . $p->id }}">Editar Persona
                            {{ $p->nombre }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('persona-update', ['id' => $p->id]) }}" method="post">
                        @method('PATCH')
                        @csrf
                        
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">1.- DATOS DE IDENTIFICACIÓN PERSONAL DEL USUARIO</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nombre" class="form-label mt-2 small">Nombre</label>
                                            <input type="text" class="form-control form-control-sm" name="nombre" value="{{ $p->nombre }}"
                                                placeholder="Nombre" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="apellido" class="form-label mt-2 small">Apellido</label>
                                            <input type="text" class="form-control form-control-sm" name="apellido" value="{{ $p->apellido }}"
                                                placeholder="Apellido" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="identificacion" class="form-label mt-2 small">Identificacion</label>
                                            <input type="text" class="form-control form-control-sm" name="identificacion" value="{{ $p->identificacion }}"
                                                placeholder="Identificacion" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="fecha_ingreso" class="form-label mt-2 small">Fecha de
                                                Ingreso</label>
                                            <input type="date" class="form-control form-control-sm" name="fecha_ingreso" value="{{ $p->fecha_ingreso }}"
                                                placeholder="Fecha de Ingreso" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="fecha_nacimiento" class="form-label mt-2 small">Fecha
                                                Nacimiento</label>
                                            <input type="date" class="form-control form-control-sm" name="fecha_nacimiento" value="{{ $p->fecha_nacimiento }}" 
                                                placeholder="Fecha Nacimiento" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="sexo" class="form-label mt-2 small">Sexo</label>
                                            <select name="sexo" class="form-control form-control-sm" required>
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
                                        <div class="col-md-3">
                                            <label for="estado_civil" class="form-label mt-2 small">Estado Civil</label>
                                            <select name="estado_civil" class="form-control form-control-sm" required value="{{ $p->estado_civil }}">
                                                <option></option>
                                                @if ($p->estado_civil == 'Soltero')
                                                    <option value="Soltero" selected>Soltero</option>
                                                    <option value="Casado">Casado</option>
                                                    <option value="Viudo">Viudo</option>
                                                    <option value="Divorciado">Divorciado</option>
                                                    <option value="Unión Libre">Unión Libre</option>
                                                @elseif ($p->estado_civil == 'Casado')
                                                    <option value="Soltero">Soltero</option>
                                                    <option value="Casado" selected>Casado</option>
                                                    <option value="Viudo">Viudo</option>
                                                    <option value="Divorciado">Divorciado</option>
                                                    <option value="Unión Libre">Unión Libre</option>
                                                @elseif ($p->estado_civil == 'Viudo')
                                                    <option value="Soltero">Soltero</option>
                                                    <option value="Casado">Casado</option>
                                                    <option value="Viudo" selected>Viudo</option>
                                                    <option value="Divorciado">Divorciado</option>
                                                    <option value="Unión Libre">Unión Libre</option>
                                                @elseif ($p->estado_civil == 'Divorciado')
                                                    <option value="Soltero">Soltero</option>
                                                    <option value="Casado">Casado</option>
                                                    <option value="Viudo">Viudo</option>
                                                    <option value="Divorciado" selected>Divorciado</option>
                                                    <option value="Unión Libre">Unión Libre</option>
                                                @elseif ($p->estado_civil == 'Unión Libre')
                                                    <option value="Soltero">Soltero</option>
                                                    <option value="Casado">Casado</option>
                                                    <option value="Viudo">Viudo</option>
                                                    <option value="Divorciado">Divorciado</option>
                                                    <option value="Unión Libre" selected>Unión Libre</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="instruccion" class="form-label mt-2 small">Nivel de
                                                Instrucción</label>
                                            <select name="instruccion" class="form-control form-control-sm" required>
                                                <option></option>
                                                @if ( $p->instruccion == "Analfabeto" )
                                                    <option value="Analfabeto" selected>Analfabeto</option>
                                                    <option value="Primaria">Primaria</option>
                                                    <option value="Secundaria">Secundaria</option>
                                                    <option value="Superior">Superior</option>
                                                @elseif ( $p->instruccion == "Primaria" )
                                                    <option value="Analfabeto">Analfabeto</option>
                                                    <option value="Primaria" selected>Primaria</option>
                                                    <option value="Secundaria">Secundaria</option>
                                                    <option value="Superior">Superior</option>
                                                @elseif ( $p->instruccion == "Secundaria" )
                                                    <option value="Analfabeto">Analfabeto</option>
                                                    <option value="Primaria">Primaria</option>
                                                    <option value="Secundaria" selected>Secundaria</option>
                                                    <option value="Superior">Superior</option>
                                                @elseif ( $p->instruccion == "Superior" )
                                                    <option value="Analfabeto">Analfabeto</option>
                                                    <option value="Primaria">Primaria</option>
                                                    <option value="Secundaria">Secundaria</option>
                                                    <option value="Superior" selected>Superior</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="ocupacion" class="form-label mt-2 small">Profesión /
                                                Ocupación</label>
                                            <input type="text" class="form-control form-control-sm" name="ocupacion" value="{{ $p->ocupacion }}"
                                                placeholder="Ocupación" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header">2.- CONDICIONES AL INGRESO:</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="condicion_fisica" class="form-label mt-2 small">Condición
                                                Física</label>
                                            <textarea class="form-control form-control-sm" name="condicion_fisica" placeholder="Condición Física">{{ $p->condicion_fisica }}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="condicion_psicologica" class="form-label mt-2 small">Condición
                                                Psicológica</label>
                                            <textarea class="form-control form-control-sm" name="condicion_psicologica" placeholder="Condición Psicológica">{{ $p->condicion_psicologica }}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="estado_salud" class="form-label mt-2 small">Estado de
                                                Salud</label>
                                            <textarea class="form-control form-control-sm" name="estado_salud" placeholder="Estado de Salud">{{ $p->estado_salud }}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="vino_voluntad_propia" class="form-label mt-2 small">En caso de ser
                                                referido por otra institucion o instancia comunitaria (Especifíque):
                                                <br />¿Vino por propia voluntad?</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    @if ( $p->vino_voluntad_propia == "Si")
                                                        <input type="radio" name="vino_voluntad_propia" value="Si" checked> Si
                                                    @else
                                                        <input type="radio" name="vino_voluntad_propia" value="Si"> Si
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    @if ( $p->vino_voluntad_propia == "No")
                                                        <input type="radio" name="vino_voluntad_propia" value="No" checked> No
                                                    @else
                                                        <input type="radio" name="vino_voluntad_propia" value="No"> No
                                                    @endif
                                                </div>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" value="{{ $p->vino_voluntad_propia_especifique }}"
                                                name="vino_voluntad_propia_especifique" placeholder="Especifique">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="recibe_algun_beneficio" class="form-label mt-2 small">Recibe algún
                                                beneficio social (Bono). Especifique:</label>
                                            <textarea class="form-control form-control-sm" name="recibe_algun_beneficio" placeholder="Especifique">{{ $p->recibe_algun_beneficio }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header">3.- SITUACIÓN FAMILIAR Y DE CONVIVENCIA</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="vive_con" class="form-label mt-2 small">¿Con quién vive?</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="radio" name="vive_con" value="Solo"
                                                    @if ( $p->vive_con == "Solo")
                                                        {{ "checked" }}
                                                    @endif
                                                    > Solo
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="radio" name="vive_con" value="Conyuge"
                                                    @if ( $p->vive_con == "Conyuge")
                                                        {{ "checked" }}
                                                    @endif
                                                    > Cónyuge/Pareja
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="radio" name="vive_con" value="Familiares"
                                                    @if ( $p->vive_con == "Familiares")
                                                        {{ "checked" }}
                                                    @endif
                                                    > Familiares
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="radio" name="vive_con" value="Otro"
                                                    @if ( $p->vive_con == "Otro")
                                                        {{ "checked" }}
                                                    @endif
                                                    > Otro
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="num_personas_vive_con" class="form-label mt-2 small">Número de
                                                personas que viven con el adulto mayor: </label>
                                            <input type="number" class="form-control form-control-sm" value="{{ $p->num_personas_vive_con }}"
                                                onchange="addRows('num_personas_vive_con_edit', 'tblConvivienteBodyEdit')" id="num_personas_vive_con_edit"
                                                name="num_personas_vive_con" min="1">
                                        </div>
                                        <div class="col-md-9">
                                            <table class="table table-striped small" id="tblConviviente">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Nombre de convivientes sean o no familiares</th>
                                                        <th>Parentesco o afinidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tblConvivienteBodyEdit">
                                                    @for ($i = 0; $i < $p->num_personas_vive_con; $i++)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control form-control-sm" name="nombre_personas_vive_con[]" 
                                                                value="{{ explode(";",$p->nombre_personas_vive_con)[$i] }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control form-control-sm" name="parentesco_vive_con[]" value="{{ explode(";",$p->parentesco_vive_con)[$i] }}">                                                                
                                                            </td>
                                                        </tr>                                                    
                                                        
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="calidad_relaciones" class="form-label mt-2 small">Calidad de las
                                                relaciones</label>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <input type="radio" name="calidad_relaciones" value="Buena"
                                                    @if ( $p->calidad_relaciones == "Buena")
                                                        {{ "checked" }}
                                                    @endif
                                                    > Buena
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="radio" name="calidad_relaciones" value="Regular"
                                                    @if ( $p->calidad_relaciones == "Regular")
                                                        {{ "checked" }}
                                                    @endif
                                                    >
                                                    Regular
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="radio" name="calidad_relaciones" value="Mala"
                                                    @if ( $p->calidad_relaciones == "Mala")
                                                        {{ "checked" }}
                                                    @endif
                                                    > Mala
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control form-control-sm" type="text" value="{{ $p->calidad_relaciones_especifique }}"
                                                        name="calidad_relaciones_especifique" placeholder="Observaciones">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header">4.- OBSERVACIONES</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea class="form-control form-control-sm" name="observaciones" placeholder="Observaciones">{{ $p->observaciones }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="responsable1" class="form-label mt-2 small">Responsables:</label>
                                            <input type="text" class="form-control form-control-sm" value="{{ $p->responsable1 }}"
                                                name="responsable1" placeholder="Coordinador">
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control form-control-sm" value="{{ $p->responsable2 }}"
                                                name="responsable2" placeholder="Facilitador">
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label mt-2">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                                        required value="{{ $p->nombre }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="apellido" class="form-label mt-2">Apellido</label>
                                    <input type="text" class="form-control" name="apellido" placeholder="Apellido"
                                        required value="{{ $p->apellido }}">
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
                                    <input type="text" class="form-control" name="diagnostico"
                                        placeholder="diagnostico" value="{{ $p->diagnostico }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="contacto" class="form-label mt-2">Prescripción Médica</label>
                                    <input type="text" class="form-control" name="prescripcion_medica"
                                        placeholder="prescripcion_medica" value="{{ $p->prescripcion_medica }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="contacto" class="form-label mt-2">Observaciones</label>
                                    <textarea type="text" class="form-control" name="observacion" placeholder="observacion">{{ $p->observacion }}</textarea>
                                </div>

                            </div>
                        </div> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function addRows(num, tabla) {
            var rowCount = document.getElementById(num).value;
            var tbody = document.getElementById(tabla);
            tbody.innerHTML = "";
            for (var i = 1; i <= rowCount; i++) {
                var newRow = document.createElement("tr");

                var cell1 = document.createElement("td");
                var cell2 = document.createElement("td");
                var cell3 = document.createElement("td");

                var input1 = document.createElement("input");
                input1.type = "text";
                input1.className = "form-control form-control-sm";
                input1.name = "nombre_personas_vive_con[]";
                input1.placeholder = "Nombre";
                input1.required = true;
                cell1.appendChild(input1);

                var input2 = document.createElement("input");
                input2.type = "text";
                input2.className = "form-control form-control-sm";
                input2.name = "parentesco_vive_con[]";
                input2.placeholder = "Parentezco";
                input2.required = true;
                cell2.appendChild(input2);

                newRow.appendChild(cell1);
                newRow.appendChild(cell2);

                tbody.appendChild(newRow);
            }
        }
    </script>
@endsection
