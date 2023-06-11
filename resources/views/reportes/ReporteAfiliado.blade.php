<!-- Vista Blade con menú de navegación y formularios de reporte -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Generar Informes de Afiliados</div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="reporteDiarioTab" data-toggle="tab" href="#reporteDiario">Reporte Diario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reporteMensualTab" data-toggle="tab" href="#reporteMensual">Reporte Mensual</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reporteAnualTab" data-toggle="tab" href="#reporteAnual">Reporte Anual</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4">
                        <div class="tab-pane fade show active" id="reporteDiario">
                            <h5>Reporte Diario</h5>
                            <form action="{{ route('reporte-afiliado-diario') }}" method="POST">
                                @csrf
                                <!-- Agrega los campos del formulario para el reporte diario aquí -->
                                <button type="submit" class="btn btn-primary">Generar Reporte Diario</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="reporteMensual">
                            <h5>Reporte Mensual</h5>
                            {{-- <form action="{{ route('generarInformes') }}" method="POST">
                                @csrf
                                <!-- Agrega los campos del formulario para el reporte mensual aquí -->
                                <button type="submit" class="btn btn-primary">Generar Reporte Mensual</button>
                            </form> --}}
                            {{-- <form action="{{ route('generarInformes') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="anioMensual">Año:</label>
                                    <input type="number" name="anioMensual" id="anioMensual" class="form-control" min="1900" max="{{ date('Y') }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Generar Reporte Mensual</button>
                            </form> --}}
                            <form action="{{ route('reporte-afiliado-mensual') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="mesMensual">Mes:</label>
                                    <select name="mesMensual" id="mesMensual" class="form-control" required>
                                        <option value="01">Enero</option>
                                        <option value="02">Febrero</option>
                                        <option value="03">Marzo</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Mayo</option>
                                        <option value="06">Junio</option>
                                        <option value="07">Julio</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                        <!-- Agrega las opciones para los demás meses -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="anioMensual">Año:</label>
                                    <input type="number" name="anioMensual" id="anioMensual" class="form-control" min="1900" max="{{ date('Y') }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Generar Reporte Mensual</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="reporteAnual">
                            <h5>Reporte Anual</h5>
                            {{-- <form action="{{ route('generarInformes') }}" method="POST">
                                @csrf
                                <!-- Agrega los campos del formulario para el reporte anual aquí -->
                                <button type="submit" class="btn btn-primary">Generar Reporte Anual</button>
                            </form> --}}
                            <form action="{{ route('reporte-afiliado-anual') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="anioMensual">Año:</label>
                                    <input type="number" name="anioMensual" id="anioMensual" class="form-control" min="1900" max="{{ date('Y') }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Generar Reporte Anual</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
