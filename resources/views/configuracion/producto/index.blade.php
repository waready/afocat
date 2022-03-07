@extends('layouts.app')

@section('title', 'Configuracion')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
@endpush
@section('content')
<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link active" aria-current="true" href="#">Certificados de Afocat</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Roles</a></li>
                <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Permisos</a></li>
                <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Permisos</a></li>
            </ul>
            
        </div>
        
        <div class="card-body">
            <button type="button" id="agregar-responsable-carrera" class="btn btn-info btn-xl" data-toggle="modal" data-target="#modal-agregar-usuario">
                <i class="fa fa-plus"></i> Agregar
            </button>   
            <table width="100%"
                class="table table-responsive"
                cellspacing="0"
                id="afocat-table"
            >
                <thead>
                    <tr>
                        <th>{{ __("Codigo") }}</th>
                        <th>{{ __("Nombre") }}</th>
                        <th>{{ __("Numero Certificado") }}</th>
                        <th>{{ __("Abreviatura") }}</th>
                        <th>{{ __("Precio Unitario") }}</th>
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
                <h5 class="modal-title">Editar Nombre Tipo Examen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-editar-usuario" class="form-horizontal form-label-left" >
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="container-fluid">
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Codigo</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_codigo" id="codigo" required placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Nombres</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_nombre" id="nombre" required placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Numero Certificado</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_numero_certificado" id="numero_certificado"  placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Abreviatura</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_abreviatura" id="abreviatura"  placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Precio Unitario</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="number" class="form-control" name="editar_precio_unitario" id="precio_unitario"  placeholder="">
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
                <h5 class="modal-title">Agregar Nuevo concepto de pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-agregar-usuario" class="form-horizontal form-label-left" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Codigo</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="codigo" id="codigo" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Nombres</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Numero Certificado</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="numero_certificado" id="numero_certificado"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Abreviatura</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="abreviatura" id="abreviatura"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Precio Unitario</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="number" class="form-control" name="precio_unitario" id="precio_unitario"  placeholder="">
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
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    jQuery(document).ready(function() {
        dt = jQuery("#afocat-table").DataTable({
                pageLength: 15,
                lengthMenu: [15, 25, 50, 75, 100 ],
                processing: true,
                
                ajax: '{{ route('getproducto') }}',
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    {data: 'codigo'},
                    {data: 'nombre'},
                    {data: 'numero_certificado'},
                    {data: 'abreviatura'},
                    {data: 'precio_unitario'},
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
                    url:'allempresa/'+idUpdate+'/edit',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data)
                        $('#editar_nombre').val(data.nombre);
                        $('#editar_representante').val(data.representante);
                        $('#editar_ruc').val(data.ruc);
                        $('#editar_telefono').val(data.telefono);
                        $('#editar_direccion').val(data.direccion);
                        $('#editar_provincia').val(data.provincia);
                        $('#editar_departamento').val(data.departamento);
                        $('#editar_email').val(data.email);
                        $('#editar_nacimiento').val(data.nacimiento);
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
                    url:'allempresa/'+idUpdate,
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
                            $('#editar_nombre').val('');
                            $('#editar_paterno').val('');
                            $('#editar_materno').val('');
                            $('#editar_dni').val('');
                            $('#editar_telefono').val('');
                            $('#editar_direccion').val('');
                            $('#editar_provincia').val('');
                            $('#editar_email').val('');
                            $('#editar_nacimiento').val('');
                          
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
                    url:'allempresa',
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