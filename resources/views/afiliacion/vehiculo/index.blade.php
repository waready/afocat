@extends('layouts.app')

@section('title', 'Vehiculos')
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
                <div class="card-header">Vehiculos
                    <button type="button" id="agregar-responsable-carrera" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-agregar-usuario">
                        <i class="fa fa-plus"></i> Agregar
                    </button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <table width="100%"
                            class="table table-responsive table-bordered nowrap"
                            cellspacing="0"
                            id="students-table"
                        >
                            <thead>
                                <tr>
                                    {{-- <th>{{ __("ID") }}</th> --}}
                                    <th >{{ __("Placa") }}</th>
                                    {{-- <th  style="width: 155px;">{{ __("Enunciado") }}</th> --}}
                                    <th>{{ __("Clase") }}</th>
                                    <th>{{ __("Marca") }}</th>
                                    <th>{{ __("Modelo") }}</th>
                                    <th>{{ __("Categoria") }}</th>
                                    <th>{{ __("Asientos") }}</th>
                                    <th>{{ __("Año") }}</th>
                                    <th>{{ __("Uso del Vehiculo") }}</th>
                                    <th>{{ __("Nro Motor") }}</th>
                                    <th>{{ __("Opciones") }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    
                </div>
            </div>
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
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Nombres</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_nombre" id="editar_nombre" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Paterno</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_paterno" id="editar_paterno" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Materno</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_materno" id="editar_materno" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">DNI</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_dni" id="editar_dni" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Direccción</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_direccion" id="editar_direccion"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Provincia</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_provincia" id="editar_provincia"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Email</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="email" class="form-control" name="editar_email" id="editar_email"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Telefono</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_telefono" id="editar_telefono"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Nacimiento</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="date" class="form-control" name="editar_nacimiento" id="editar_nacimiento"  placeholder="">
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
<div class="modal fade" id="modal-agregar-usuario" tabindex="-1" role="dialog" aria-labelledby="agregarNuevo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title">Agregar Nueva Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-agregar-usuario" class="form-horizontal form-label-left" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">DNI/RUC</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="id" id="id" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Nombre</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="nombre" id="nombre" disabled placeholder="">
                            </div>
                        </div>
                        <div id="dato_id">

                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Placa</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="placa" id="placa" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Marca</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="marca" id="marca" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Modelo</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="modelo" id="modelo" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Color</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="color" id="color" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Clase</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="clase" id="clase"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Categoria</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="categoria" id="categoria"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Asientos</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="number" class="form-control" name="asientos" id="asientos"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Anio</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="number" class="form-control" name="anio" id="anio"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Uso</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="uso" id="uso"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Serie</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="serie" id="serie"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Motor</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="motor" id="motor"  placeholder="">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    jQuery(document).ready(function() {
       // $("#id").mask('00000000000');
        $("#id").blur(function(){
            if ($(this).val() == "") {
                $("#nombre").val("BUSCANDO CLIENTE...");
            } else{
                if ($(this).val().length == 11) {
                    var tipe = "ruc";
                }
                else{
                    var tipe = "dni";
                }
            }
            var id = $("#id").val()
            $("#nombre").val("BUSCANDO CLIENTE...");
            $.ajax({
                type: "POST",
                dataType: "json",
                url:'buscar-dni',
                data: {valor:id,tipo:tipe},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if(data.message == null){
                        $("#nombre").val("NO SE ENCONTRO CLIENTE");
                    }else{
                        $("#nombre").val(data.message.nombre);
                        if(data.status == 2){
                            var fieldHTML  = '<div><input type="hidden" name="id_persona" value="'+data.message.id+'"/> </div>';
                            $('#dato_id').append(fieldHTML);
                        }
                        else if(data.status == 1){
                            var fieldHTML  = '<div><input type="hidden" name="id_empresa" value="'+data.message.id+'"/> </div>';
                            $('#dato_id').append(fieldHTML);
                        }
                        
                    }
                }
            });
        });
       
      


        dt = jQuery("#students-table").DataTable({
                pageLength: 15,
                lengthMenu: [15, 25, 50, 75, 100 ],
                processing: true,
                
                ajax: '{{ route('getvehiculo') }}',
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    // {data: 'id'},
                    {data: 'placa'},
                    {data: 'clase'},
                    {data: 'marca'},
                    {data: 'modelo'},
                    {data: 'categoria'},
                    {data: 'asientos'},
                    {data: 'anio'},
                    {data: 'uso'},
                    {data: 'motor'},
                    {data: 'Opciones'}
                ],
                rowCallback:function(row, data,index){ 
                    
                    $('td:eq(9)',row).html('<a class="editar-usuario" href="'+data.id+'"> <i class="fas fa-pencil-alt big-icon text-primary" aria-hidden="true"></i></a>  <a class="eliminar-usuario" href="#"> <i class="fas fa-trash big-icon text-danger" aria-hidden="true"></i></a>')
                }
                
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
                    url:'allvehiculo/'+idUpdate+'/edit',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#editar_nombre').val(data.nombre);
                        $('#editar_paterno').val(data.paterno);
                        $('#editar_materno').val(data.materno);
                        $('#editar_dni').val(data.dni);
                        $('#editar_telefono').val(data.telefono);
                        $('#editar_direccion').val(data.direccion);
                        $('#editar_provincia').val(data.provincia);
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
                    url:'allvehiculo/'+idUpdate,
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
                    url:'allvehiculo',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modal-agregar-usuario').modal('hide');
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
        });
</script>
@endpush