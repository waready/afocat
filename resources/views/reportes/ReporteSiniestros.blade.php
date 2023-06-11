<!-- Vista Blade con menú de navegación y formularios de reporte -->

@extends('layouts.app')
@section('title', 'Configuracion')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Generar Informes de Siniestros</div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="reporteDiarioTab" data-toggle="tab" href="#reporteDiario">Reporte Siniestros Pagados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reporteMensualTab" data-toggle="tab" href="#reporteMensual">Reporte Siniestros por Pagar</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4">
                        <div class="tab-pane fade show active" id="reporteDiario">
                            <h5>Siniestros Pagados</h5>
                            <div class="card-header">
                                <button type="button" id="button" class="ml-2 btn btn-success btn-xl">
                                    <i class="fa fa-file"></i> Generar Reporte
                                </button>      
                            </div>
                            
                            <div class="card-body">
                                {{-- {{ $Accidentado }}  --}}
                                {{-- {{  $TipoGasto}} --}}
                                <table width="100%"
                                    class="table table-responsive"
                                    cellspacing="0"
                                    id="afocat-table"
                                >
                                    <thead>
                                        <tr>
                                            <th>{{ __("DNI") }}</th>
                                            {{-- <th>{{ __("Pendiente") }}</th> --}}
                                            <th>{{ __("Nombres") }}</th>
                                            <th>{{ __("Ubicacion") }}</th>
                                            <th>{{ __("Cuenta") }}</th>
                                            <th>{{ __("Gasto") }}</th>
                                            <th>{{ __("Tipo Pago") }}</th>
                                            <th>{{ __("Deuda") }}</th>
                                            <th>{{ __("Monto Pagado") }}</th>
                                            <th>{{ __("Saldo") }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reporteMensual">
                            <h5>Siniestros por Pagar</h5>
                            
                            <div class="card-header">
                                <button type="button" id="button1" class="ml-2 btn btn-success btn-xl">
                                    <i class="fa fa-file"></i> Generar Reporte
                                </button>      
                            </div>
                            
                            <div class="card-body">
                                {{-- {{ $Accidentado }}  --}}
                                {{-- {{  $TipoGasto}} --}}
                                <table width="100%"
                                    class="table table-responsive"
                                    cellspacing="0"
                                    id="afocat-siniestros"
                                >
                                    <thead>
                                        <tr>
                                            <th>{{ __("DNI") }}</th>
                                            {{-- <th>{{ __("Pendiente") }}</th> --}}
                                            <th>{{ __("Nombres") }}</th>
                                            <th>{{ __("Ubicacion") }}</th>
                                            <th>{{ __("Cuenta") }}</th>
                                            <th>{{ __("Gasto") }}</th>
                                            <th>{{ __("Tipo Pago") }}</th>
                                            <th>{{ __("Deuda") }}</th>
                                            <th>{{ __("Monto Pagado") }}</th>
                                            <th>{{ __("Saldo") }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script>
    jQuery(document).ready(function() {
        $('.seleccion2').select2({
        placeholder: "Seleccione una opción",
    });
        $("#button").click(function(){
            $("#afocat-table").table2excel({
            // exclude CSS class
            exclude:".noExl",
            name:"Worksheet Name",
            filename:"Siniestros-Pagados",//do not include extension
            fileext:".xls", // file extension
        //columns : [0,1,2,3,4,5,6,7,8,9,10,11]
            });
        });
        dt = jQuery("#afocat-table").DataTable({
                pageLength: 15,
                lengthMenu: [15, 25, 50, 75, 100 ],
                processing: true,
                
                ajax: '{{ route('getSiniestrosPagados') }}',
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    {data: 'dni'},
                    {data: 'nombres'},
                    {data: 'ubicacion'},
                    {data: 'cuenta_a_82'},
                    {data: 'gasto'},
                    {data: 'tipoPago'},
                    {data: 'deuda'},
                    {data: 'monto_pagado'},
                    {data: 'saldo'}
                ],
             
            });
           

            dti = jQuery("#afocat-siniestros").DataTable({
                pageLength: 15,
                lengthMenu: [15, 25, 50, 75, 100 ],
                processing: true,
                
                ajax: '{{ route('getSiniestrosporPagar') }}',
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    {data: 'dni'},
                    {data: 'nombres'},
                    {data: 'ubicacion'},
                    {data: 'cuenta_a_82'},
                    {data: 'gasto'},
                    {data: 'tipoPago'},
                    {data: 'deuda'},
                    {data: 'monto_pagado'},
                    {data: 'saldo'}
                ],
        });
        $("#button1").click(function(){
            $("#afocat-siniestros").table2excel({
            // exclude CSS class
            exclude:".noExl",
            name:"Worksheet Name",
            filename:"Siniestros-por-pagar",//do not include extension
            fileext:".xls", // file extension
        //columns : [0,1,2,3,4,5,6,7,8,9,10,11]
            });
        });
    });
       
</script>
@endpush