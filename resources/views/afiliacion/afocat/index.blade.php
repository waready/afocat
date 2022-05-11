@extends('layouts.app')

@section('title', 'Empresa')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header"> LISTA DE AFOCAT 
                   
                </div>

                <div class="card-body">
                    <a  href="{{ route('new-afocat') }}"  class="ml-3 mt-2 btn btn-primary" style=""><i  class="fas fa-plus"></i> Registrar Afocat </a>
                    <button type="button" id="button" class="ml-3 mt-2  btn btn-success"  >
                        <i class="fa fa-file"></i> Exportar
                    </button>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <table width="100%"
                            class="table table-responsive table-bordered nowrap"
                            cellspacing="0"
                            id="afocat-table"
                        >
                            <thead>
                                <tr>
                                    <th>{{ __("ID") }}</th>
                                    <th>{{ __("Inicio Contrato") }}</th>
                                    <th>{{ __("Fin Contrato") }}</th>
                                    <th>{{ __("Años") }}</th>
                                    <th>{{ __("Tipo afocat") }}</th>
                                    <th>{{ __("Placa") }}</th>
                                    <th>{{ __("Afiliado") }}</th>
                                    <th>{{ __("Monto total") }}</th>
                                    <th>{{ __("Monto SBS") }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script>
    jQuery(document).ready(function() {
        $("#button").click(function(){
            $("#afocat-table").table2excel({
            // exclude CSS class
            exclude:".noExl",
            name:"Worksheet Name",
            filename:"Afocats",//do not include extension
            fileext:".xls", // file extension
           //columns : [0,1,2,3,4,5,6,7,8,9,10,11]
            });
        });
        dt = jQuery("#afocat-table").DataTable({
                pageLength: 15,
                lengthMenu: [15, 25, 50, 75, 100 ],
                processing: true,
                
                ajax: '{{ route('getafocat') }}',
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    {data: 'id'},
                    {data: 'inicio_contrato'},
                    {data: 'fin_contrato'},
                    {data: 'anios'},
                    {data: 'producto'},
                    {data: 'placa'},
                    {data: 'nombre'},
                    {data: 'monto_total'},
                    {data: 'monto_sbs'}
                ],
                rowCallback:function(row, data,index){ 
                    if(data.id_tipo_afiliacion == 1){
                        $('td:eq(6)',row).html(data.nombre+" "+data.paterno+" "+data.materno) 
                    }
                    if(data.id_tipo_afiliacion == 2){
                        $('td:eq(6)',row).html(data.nombre)
                    }    
                }
                
            });
        });
</script>
@endpush