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
    <div class="card">
        <div class="card-header">Accidentados - Gastos
            <button type="button" id="agregar-responsable-carrera" class="ml-2 btn btn-info btn-xl" data-toggle="modal" data-target="#modal-agregar-usuario">
                <i class="fa fa-plus"></i> Registrar
            </button>
            <button type="button" id="button" class="ml-2 btn btn-success btn-xl">
                <i class="fa fa-file"></i> Exportar
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
                        <th>{{ __("Monto Pagado") }}</th>
                        {{-- <th>{{ __("Pendiente") }}</th> --}}
                        <th>{{ __("Fecha Pago") }}</th>
                        <th>{{ __("Tipo de Pago") }}</th>
                        <th>{{ __("Gasto") }}</th>
                        <th>{{ __("Accidentado") }}</th>
                        <th>{{ __("Archibo") }}</th>
                        <th>{{ __("Opciones") }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-editar-usuario" tabindex="-1" role="dialog" aria-labelledby="editarNuevo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title">Editar Accidentado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-editar-usuario" class="form-horizontal form-label-left" >
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="container-fluid">
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Accidentado</label>
                        <div class="col-md-12 col-sm-12 ">
                            <select style="width: 100%" class="form-control carrera " name="editar_id_accidentado" id="editar_id_accidentado" required>
                                <option value="">Seleccionar---</option>
                                @foreach($Accidentado as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->nombres}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Monto Pagado</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input  type='number' step='1.00'  placeholder='0.00'  class="form-control" name="editar_monto_pagado" id="editar_monto_pagado" required>
                        </div>
                    </div>
                    {{-- <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Pendiente</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_Pendiente" id="editar_Pendiente" required placeholder="">
                        </div>
                    </div> --}}
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Fecha de Pago</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="date" class="form-control" name="editar_fecha_pago" id="editar_fecha_pago"  placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Tipo Pago</label>
                        <div class="col-md-12 col-sm-12 ">
                            <select style="width: 100%" class="form-control carrera " name="editar_id_tipo_pago" id="editar_id_tipo_pago" required>
                                <option value="">Seleccionar---</option>
                                @foreach($TipoGasto as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
                    <div class="item form-group">
                        <label class="col-form-label col-md-12 col-sm-3 label-align">Documento de Conformidad</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="file" class="custom-file-input" name="editar_doc_conformidad" id="editar_doc_conformidad" lang="es">
                            <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-agregar-usuario" tabindex="-1" role="dialog" aria-labelledby="agregarNuevo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Registrar accidentes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-agregar-usuario" class="form-horizontal form-label-left" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Accidentado</label>
                            <div class="col-md-12 col-sm-12 ">
                                <select style="width: 100%" class="form-control carrera seleccion2" name="id_accidentado" id="id_accidentado" required>
                                    <option value="">Seleccionar---</option>
                                    @foreach($Accidentado as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombres}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Monto Pagado</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input  type='number' step='1.00'  placeholder='0.00'  class="form-control" name="monto_pagado" id="monto_pagado" required>
                            </div>
                        </div>
                        {{-- <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Pendiente</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="Pendiente" id="Pendiente" required placeholder="">
                            </div>
                        </div> --}}
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Fecha de Pago</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="date" class="form-control" name="fecha_pago" id="fecha_pago"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Tipo Pago</label>
                            <div class="col-md-12 col-sm-12 ">
                                <select style="width: 100%" class="form-control carrera seleccion2" name="id_tipo_pago" id="id_tipo_pago" required>
                                    <option value="">Seleccionar---</option>
                                    @foreach($TipoGasto as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      
                        <div class="item form-group">
                            <label class="col-form-label col-md-12 col-sm-3 label-align">Documento de Conformidad</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="file" class="custom-file-input" name="doc_conformidad" id="doc_conformidad" lang="es">
                                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
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
            filename:"Accidentes-Gastos",//do not include extension
            fileext:".xls", // file extension
        //columns : [0,1,2,3,4,5,6,7,8,9,10,11]
            });
        });
        dt = jQuery("#afocat-table").DataTable({
                pageLength: 15,
                lengthMenu: [15, 25, 50, 75, 100 ],
                processing: true,
                
                ajax: '{{ route('getaccidentegastos') }}',
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    {data: 'monto_pagado'},
                    {data: 'fecha_pago'},
                    {data: 'tipo_pago'},
                    {data: 'gasto'},
                    {data: 'accidentado'},
                    {data: 'archivo_path'},
                    {data: 'Opciones'}
                ],
                rowCallback:function(row, data,index){ 
                 
                    $('td:eq(6)',row).html('<a class="editar-usuario" href="'+data.id+'"> <i class="fas fa-pencil-alt big-icon text-primary" aria-hidden="true"></i></a>  <a class="eliminar-usuario" href="#"> <i class="fas fa-trash big-icon text-danger" aria-hidden="true"></i></a>')    
                }
            });
        });
        $(document).on('click', '.editar-usuario', function(e) {
                // $('.file-firma').val(null);
                // $('.file1').html('Seleccione su archivo...');
                e.preventDefault();
                
                idUpdate = $(this).attr('href');
               // alert(idUpdate);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url:'allaccidente-gastos/'+idUpdate+'/edit',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data)
                        $('#editar_id_accidentado option[value="'+data.id_accidentado+'"]').attr("selected", true);
                        $('#editar_monto_pagado').val(data.monto_pagado);
                        $('#editar_fecha_pago').val(data.fecha_pago);
                        $('#editar_id_tipo_pago option[value="'+data.id_tipo_pago+'"]').attr("selected", true);
                       // $('#editar_doc_conformidad').val(data.cuenta_a_82);
                       // $('#editar_id_accidente option[value="'+data.id_accidente+'"]').attr("selected", true);
                        $('#modal-editar-usuario').modal('show');
                    },
                    error: function(error) {
                        console.log(error);
                        toastr.error(error, '¡Error!', {timeOut: 5000})
                    }
                });
            });
            $('#form-editar-usuario').submit(function(e){
                e.preventDefault();
               // spinner.show();
                // let data = $(this).serialize();
                var formDerivar = document.getElementById("form-editar-usuario");
                let data = new FormData(formDerivar);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url:'allaccidente-gastos/'+idUpdate,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modal-editar-usuario').modal('hide');
                        //spinner.hide();
                        console.log(data);
                        if(data.status)
                        {
                            dt.ajax.reload();
                            toastr.success(data.message, '¡Operación Exitosa!', {timeOut: 5000})
                            $('#editar_nombre').val('')
                            $('#editar_codigo').val('')
                            $('#editar_numero_certificado').val('');
                            $('#editar_abreviatura').val('');
                            $('#editar_precio_unitario').val('');
                          
                        }
                        else
                        {
                            toastr.error(data.message, '¡Error!', {timeOut: 5000})
                        }
                    },
                    error: function(error) {
                        $('#modal-editar-usuario').modal('hide');
                        //spinner.hide();
                        toastr.error(error, '¡Error!', {timeOut: 5000})
                    }
                });
            });
            $('#form-agregar-usuario').submit(function(e){
                e.preventDefault();
                //spinner.show();
                // let data = $(this).serialize();
                var formDerivar = document.getElementById("form-agregar-usuario");
                let data = new FormData(formDerivar);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url:'allaccidente-gastos',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                       // $('#modal-agregar-usuario').modal('hide');
                        $('#modal-agregar-usuario').modal('hide')
                       // spinner.hide();
                        if(data.status)
                        {
                            dt.ajax.reload();
                            toastr.success(data.message, '¡Operación Exitosa!', {timeOut: 5000})
                            $('#nombre').val('');
                            $('#paterno').val('');
                            $('#materno').val('');
                            $('#dni').val('');
                            $('#telefono').val('');
                            $('#direccion').val('');
                            $('#provincia').val('');
                            $('#email').val('');
                            $('#nacimiento').val('');
                            
                        }
                        else
                        {
                            toastr.error(data.message, '¡Error!', {timeOut: 5000})
                        }
                    },
                    error: function(error) {
                        $('#modal-agregar-usuario').modal('hide');
                       // spinner.hide();
                        toastr.error(error, '¡Error!', {timeOut: 5000})
                    }
                });
            });
            $('#modal-agregar-usuario').on('hidden.bs.modal', function () {
                $('#nombre').val('');
                $('#paterno').val('');
                $('#materno').val('');
                $('#dni').val('');
                $('#telefono').val('');
                $('#direccion').val('');
                $('#provincia').val('');
                $('#email').val('');
                $('#nacimiento').val('');
            })
</script>
@endpush