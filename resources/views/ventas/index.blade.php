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
                <div class="card-header"> REGISTROS DE PAGOS
                   
                </div>

                <div class="card-body">
                    <a  href="{{ route('new-afocat') }}"  class="ml-3 mt-2 btn btn-primary" style=""><i  class="fas fa-plus"></i> Registrar Pago </a>
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
                                    <th>{{ __("Serie") }}</th>
                                    <th>{{ __("Fecha") }}</th>
                                    <th>{{ __("Cliente") }}</th>
                                    <th>{{ __("Concepto") }}</th>
                                    <th>{{ __("Monto") }}</th>
                                    <th>{{ __("Ticket") }}</th>
                                   
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
<script>
    jQuery(document).ready(function() {
        dt = jQuery("#afocat-table").DataTable({
                pageLength: 15,
                lengthMenu: [15, 25, 50, 75, 100 ],
                processing: true,
                
                ajax: '{{ route('getpagos') }}',
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    // {data: 'id'},
                    {data: 'serie'},
                    {data: 'fecha'},
                    {data: 'nombre'},
                    {data: 'producto'},
                    {data: 'monto'},
                    {data: 'Opciones'},
                   
                ],
                rowCallback:function(row, data,index){ 
                    if(data.id_tipo_afiliacion == 1){
                        $('td:eq(2)',row).html(data.nombre+" "+data.paterno+" "+data.materno) 
                    }
                    if(data.id_tipo_afiliacion == 2){
                        $('td:eq(2)',row).html(data.nombre)
                    }
                    $('td:eq(5)',row).html('<a  href="http://localhost:8000/ventas/'+data.hash+'" class="btn btn-light" style=""><i  class="fas fa-print"></i></a>')    
                }
                
            });
        });
</script>
@endpush