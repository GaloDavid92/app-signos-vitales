@extends('app')
@section('content')
    @error('presion')
        <h6 class="alert alert-danger">{{ $message }}</h6>
    @enderror
    <div class="card">
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i
                                class="fa-solid fa-house"></i>&nbsp;Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('personas') }}"><i
                                class="fa-solid fa-people-group"></i>&nbsp;Personas</a></li>
                    <li class="breadcrumb-item active" aria-current="Personas">Signos Vitales</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container border p-4 mt-4">
        <h2>Signos Vitales</h2>
        <h3>{{ $persona->nombre . ' ' . $persona->apellido }}</h3>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cantidad de valores fuera del rango</h5>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-danger">
                            <div class="card-body">
                                <h5 class="card-title">Frecuencia Cardiaca</h5>
                                {{ $problems['frecuencia_cardiaca'] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-danger">
                            <div class="card-body">
                                <h5 class="card-title">Frec. Respiratoria</h5>
                                {{ $problems['frecuencia_respiratoria'] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-danger">
                            <div class="card-body">
                                <h5 class="card-title">Presión Arterial</h5>
                                Sistólica: {{ $problems['presion_sistolica'] }} &nbsp;
                                Diastólica: {{ $problems['presion_diastolica'] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-danger">
                            <div class="card-body">
                                <h5 class="card-title">Temperatura</h5>
                                {{ $problems['temperatura'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>        
        <br>
        @if (auth()->user()->role == 'USER')
            <div class="container-fluid">
                <form action="{{ route('signos-save') }}" method="post">
                    @csrf
                    <input type="number" name="id_persona" style="display: none;" value="{{ $persona->id }}">
                    <table class="table">
                        <thead>
                            <th>Frec cardiaca</th>
                            <th>Frec respiratoria</th>
                            <th>Presion arterial</th>
                            <th>Temperatura</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="number" name="frecuencia_cardiaca" id="" class="form-control"
                                        required></td>
                                <td><input type="number" name="frecuencia_respiratoria" id="" class="form-control"
                                        required></td>
                                <td>
                                    <input type="text" name="presion" id="" class="form-control" required>
                                </td>
                                <td><input type="number" name="temperatura" id="" class="form-control" required
                                        step="0.01" /></td>
                                <td>
                                    <button type="submit" id="" class="btn btn-success btn-sm">
                                        <i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        @endif
    </div>
    <div class="container border p-4 mt-4 table-responsive">
        <table class="table table-striped data-table">
            <thead>
                <th>Frecuancia Cardiaca</th>
                <th>Frecuancia respiratoria</th>
                <th>Presion Arterial</th>
                <th>Temperatura</th>
                <th>Fecha</th>
                <th>Registrado por:</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($persona->signosVitales as $sv)
                    <tr>
                        @if ($sv->frecuencia_cardiaca >= 60 && $sv->frecuencia_cardiaca <= 80)
                            <td>{{ $sv->frecuencia_cardiaca }}</td>
                        @else
                            <td class="text-danger"><strong>{{ $sv->frecuencia_cardiaca }}</strong></td>
                        @endif
                        @if ($sv->frecuencia_respiratoria >= 12 && $sv->frecuencia_respiratoria <= 20)
                            <td>{{ $sv->frecuencia_respiratoria }}</td>
                        @else
                            <td class="text-danger"><strong>{{ $sv->frecuencia_respiratoria }}</strong></td>
                        @endif
                        <td>
                            @if ($sv->presion_sistolica >= 110 && $sv->presion_sistolica <= 140)
                                {{ $sv->presion_sistolica }} /
                            @else
                                <strong class="text-danger">{{ $sv->presion_sistolica }}</strong> /
                            @endif
                            @if ($sv->presion_diastolica >= 70 && $sv->presion_diastolica <= 90)
                                {{ $sv->presion_diastolica }}
                            @else
                                <strong class="text-danger">{{ $sv->presion_diastolica }}</strong>
                            @endif
                        </td>
                        @if ($sv->temperatura >= 36 && $sv->temperatura <= 37.2)
                            <td>{{ $sv->temperatura }}</td>
                        @else
                            <td class="text-danger"><strong>{{ $sv->temperatura }}</strong></td>
                        @endif
                        <td>{{ $sv->updated_at }}</td>
                        <td>{{ $sv->usuario->name }}</td>
                        <td>
                            @if (auth()->user()->role == 'USER')
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-toggle="modal"
                                    data-placement="top" title="Eliminar" data-bs-target="#{{ 'deleteSV' . $sv->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>

    @foreach ($persona->signosVitales as $sv)
        <div class="modal fade" id="{{ 'deleteSV' . $sv->id }}" tabindex="-1" role="dialog"
            aria-labelledby="{{ 'deleteSVLabel' . $sv->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{{ 'deleteSVLabel' . $sv->id }}">Eliminar registro?</h5>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('signos_vitales', [$sv->id]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                axisY: {
                    title: "Signos Vitales"
                },
                legend: {
                    cursor: "pointer",
                    dockInsidePlotArea: true,
                    itemclick: toggleDataSeries
                },
                data: [{
                        type: "spline",
                        name: "Frecuencia Cardiaca",
                        toolTipContent: "Frecuencia Cardiaca: {y}",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datos['fc']); ?>
                    },
                    {
                        type: "spline",
                        name: "Frecuencia Respiratorias",
                        toolTipContent: "Frecuencia Respiratorias: {y}",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datos['fr']); ?>
                    },
                    {
                        type: "spline",
                        name: "Presion Sistólica",
                        toolTipContent: "Presion Sistólica: {y}",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datos['ps']); ?>
                    },
                    {
                        type: "spline",
                        name: "Presion Diastolica",
                        toolTipContent: "Presion Diastolica: {y}",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datos['pd']); ?>
                    },
                    {
                        type: "spline",
                        name: "Temperatura",
                        toolTipContent: "Temperatura: {y} °C",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datos['tm']); ?>
                    },
                ]
            });
            chart.render();

            function toggleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart.render();
            }
        }
    </script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
@endsection
