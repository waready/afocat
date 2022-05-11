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
        <div class="card-header">Accidentes
            <button type="button" id="agregar-responsable-carrera" class="ml-2 btn btn-info btn-xl" data-toggle="modal" data-target="#modal-agregar-usuario">
                <i class="fa fa-plus"></i> Registrar
            </button>
            <button type="button" id="button" class="ml-2 btn btn-success btn-xl"  >
                <i class="fa fa-file"></i> Exportar
            </button>   
        </div>
        
        <div class="card-body">
       
            <table width="100%"
                class="table table-responsive"
                cellspacing="0"
                id="afocat-table"
            >
                <thead>
                    <tr>
                        <th>{{ __("Ocurrencia") }}</th>
                        <th>{{ __("Notificacion") }}</th>
                        <th>{{ __("Ubicacion") }}</th>
                        <th>{{ __("zona") }}</th>
                        <th>{{ __("Placa") }}</th>
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
                <h5 class="modal-title">Editar Accidente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-editar-usuario" class="form-horizontal form-label-left" >
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="container-fluid">
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Placa Vehiculo</label>
                        <div class="col-md-12 col-sm-12 ">
                            <select style="width: 100%" class="form-control carrera seleccion2" name="editar_id_vehiculo" id="editar_id_vehiculo" required>
                                
                                @foreach($Vehiculos as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->placa}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Ocurrencia</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="date" class="form-control" name="editar_ocurrencia" id="editar_ocurrencia" required placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Notificacion</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="date" class="form-control" name="editar_notificacion" id="editar_notificacion" required placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Hora</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="time" class="form-control" name="editar_hora" id="editar_hora" required placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Ubicación</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_ubicacion" id="editar_ubicacion"  placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Zona</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_zona" id="editar_zona"  placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Observaciones</label>
                        <div class="col-md-12 col-sm-12 ">
                            {{-- <input type="text" class="form-control" name="editar_zona" id="editar_zona"  placeholder=""> --}}
                            <textarea class="form-control" rows="3" name="editar_observacion" id="editar_observacion" cols="50"></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label ">Certificado Denuncia Policial</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="file" class="custom-file-input" name="editar_certificado" id="editar_certificado" lang="es">
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
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Placa Vehiculo</label>
                            <div class="col-md-12 col-sm-12 ">
                                <select style="width: 100%" class="form-control carrera seleccion2" name="id_vehiculo" id="id_vehiculo" required>
                                    <option value="">Seleccionar---</option>
                                    @foreach($Vehiculos as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->placa}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Ocurrencia</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="date" class="form-control" name="ocurrencia" id="ocurrencia" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Notificacion</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="date" class="form-control" name="notificacion" id="notificacion" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Hora</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="time" class="form-control" name="hora" id="hora" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Ubicación</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="ubicacion" id="ubicacion"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Zona</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="zona" id="zona"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Observaciones</label>
                            <div class="col-md-12 col-sm-12 ">
                                {{-- <input type="text" class="form-control" name="editar_zona" id="editar_zona"  placeholder=""> --}}
                                <textarea class="form-control" rows="3" name="observacion" id="observacion" cols="50"></textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label ">Certificado Denuncia Policial</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="file" class="custom-file-input" name="certificado" id="certificado" lang="es">
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
        $('#id_vehiculo').select2({
            placeholder: "Seleccione una opción",
            dropdownParent: $('#modal-agregar-usuario')
        });
        $('#editar_id_vehiculo').select2({
            //placeholder: "Seleccione una opción",
            dropdownParent: $('#modal-editar-usuario')
        });
        $("#button").click(function(){
            $("#afocat-table").table2excel({
            // exclude CSS class
            exclude:".noExl",
            name:"Worksheet Name",
            filename:"Accidentes",//do not include extension
            fileext:".xls", // file extension
           //columns : [0,1,2,3,4,5,6,7,8,9,10,11]
            });
        });
        dt = jQuery("#afocat-table").DataTable({
                pageLength: 15,
                lengthMenu: [15, 25, 50, 75, 100 ],
                processing: true,
                
                ajax: '{{ route('getaccidente') }}',
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    {data: 'ocurrencia'},
                    {data: 'notificacion'},
                    {data: 'ubicacion'},
                    {data: 'zona'},
                    {data: 'placa'},
                    {data: 'Opciones'}
                ],
                rowCallback:function(row, data,index){ 
                 
                    $('td:eq(5)',row).html('<a class="editar-usuario" href="'+data.id+'"> <i class="fas fa-pencil-alt big-icon text-primary" aria-hidden="true"></i></a>  <a class="eliminar-usuario" href="#"> <i class="fas fa-trash big-icon text-danger" aria-hidden="true"></i></a>')    
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
                    url:'allaccidente/'+idUpdate+'/edit',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                       // console.log(data)
                        $('#editar_ocurrencia').val(data.ocurrencia);
                        $('#editar_notificacion').val(data.notificacion);
                        $('#editar_hora').val(data.numero_certificado);
                        $('#editar_ubicacion').val(data.ubicacion);
                        $('#editar_zona').val(data.zona);
                        $('#editar_hora').val(data.hora);
                        $('#editar_observacion').val(data.observaciones)
                        $('#editar_id_vehiculo option[value="'+data.id_vehiculo+'"]').attr("selected", true);
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
                    url:'allaccidente/'+idUpdate,
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
                    url:'allaccidente',
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