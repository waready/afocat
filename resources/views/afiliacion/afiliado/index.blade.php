@extends('layouts.app')

@section('title', 'Presona')
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
                <div class="card-header">Cliente Usuario
                    <button type="button" id="agregar-responsable-carrera" class="btn btn-info btn-sm ml-2" data-toggle="modal" data-target="#modal-agregar-usuario">
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
                            id="afiliado-table"
                        >
                            <thead>
                                <tr>
                                    <th>{{ __("Nombres") }}</th>
                                    <th>{{ __("DNI/RUC") }}</th>
                                    <th>{{ __("direccion") }}</th>
                                    <th>{{ __("telefono") }}</th>
                                    <th>{{ __("email") }}</th>
                                    {{-- <th>{{ __("nacimiento") }}</th> --}}
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
                <h5 class="modal-title">Editar Cliente Usuario</h5>
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
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Tipo</label>
                            <div class="col-md-12 col-sm-12 ">
                                <select style="width: 100%" class="form-control carrera seleccion2" name="editar_id_tipo_afiliacion" id="editar_id_tipo_afiliacion" required>
                                    @foreach($tipoAfiliados as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Representante</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_representante" id="editar_representante" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">DNI</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_dni" id="editar_dni" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">RUC</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_ruc" id="editar_ruc" maxlength="11" required placeholder="">
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
                <h5 class="modal-title">Agregar Nuevo Cliente Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-agregar-usuario" class="form-horizontal form-label-left" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Tipo Afiliado</label>
                            <div class="col-md-12 col-sm-12 ">
                                <select style="width: 100%" class="form-control carrera seleccion2" name="id_tipo_afiliacion" id="id_tipo_afiliacion" required>
                                    <option value="">Seleccionar---</option>
                                    @foreach($tipoAfiliados as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">DNI</label>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="input-group-prepend">
                                    <input type="text" class="form-control" name="dni" id="dni" maxlength="8" required placeholder="">
                                    {{-- <span class="input-group-text"><i class="c-sidebar-nav-icon cil-search "></i></span> --}}
                                    <input type="button" class="btn btn-info" value="buscar" id="buscar_dni" disabled/> 
                               </div>
                                
                                
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">RUC</label>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="input-group-prepend">
                                    <input type="text" class="form-control" name="ruc" id="ruc" maxlength="11" required placeholder="">
                                    <input type="button" class="btn btn-info" value="buscar" id="buscar_ruc" disabled/> 
                                </div>
                            </div>
                            
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Nombres</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Paterno</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="paterno" id="paterno" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Materno</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="materno" id="materno" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Representante</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="representante" id="representante" required placeholder="">
                            </div>
                        </div>
                        
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Direccción</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="direccion" id="direccion"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Provincia</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="provincia" id="provincia"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Email</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="email" class="form-control" name="email" id="email"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Telefono</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Nacimiento</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="date" class="form-control" name="nacimiento" id="nacimiento"  placeholder="">
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
{{-- 
<script src="https://unpkg.com/@coreui/coreui@3.4.0/dist/js/coreui.bundle.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    jQuery(document).ready(function() {
        $('#ruc').prop( "disabled", true );
        $('#representante').prop( "disabled", true );
        $('#dni').prop( "disabled", true );
        $('#paterno').prop( "disabled", true );
        $('#materno').prop( "disabled", true );
        


        dt = jQuery("#afiliado-table").DataTable({
                pageLength: 15,
                lengthMenu: [15, 25, 50, 75, 100 ],
                processing: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                ajax: '{{ route('getafiliaciones') }}',
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    // {data: 'id'},
                    {data: 'nombre'},
                    {data: 'dni'},
                    {data: 'direccion'},
                    {data: 'telefono'},
                    {data: 'email'},
                    // {data: 'nacimiento'},
                    {data: 'Opciones'}
                ],
                rowCallback:function(row, data,index){
                    if(data.id_tipo_afiliacion == 1){
                        $('td:eq(0)',row).html(data.nombre+" "+data.paterno+" "+data.materno)
                        $('td:eq(1)',row).html(data.dni)
                    }
                    if(data.id_tipo_afiliacion == 2){
                        $('td:eq(0)',row).html(data.nombre)
                        $('td:eq(1)',row).html(data.ruc)
                    }    
                    $('td:eq(5)',row).html('<a class="editar-usuario" href="'+data.id+'"> <i class="fas fa-pencil-alt big-icon text-primary" aria-hidden="true"></i></a>  <a class="eliminar-usuario" href="#"> <i class="fas fa-trash big-icon text-danger" aria-hidden="true"></i></a>')
                }
                
            });
           
            $( "#id_tipo_afiliacion" ).change(function() {
                var Afilicion_tipo = $(this).val();
                    $('#ruc').val('');
                    $('#nombre').val('');
                
                    $('#representante').val('');
                    //segundo
                    $('#dni').val('');
        
                    $('#paterno').val('');
                    $('#materno').val('');
                    $('#nacimiento').val('');
                if(Afilicion_tipo == 1){
                    //primero
                    $('#ruc').prop( "disabled", true );
                    $('#buscar_ruc').prop( "disabled", true );
                    $('#representante').prop( "disabled", true );
                    //segundo
                    $('#dni').prop( "disabled", false );
                    $('#buscar_dni').prop( "disabled", false );
                    $('#paterno').prop( "disabled", false );
                    $('#materno').prop( "disabled", false );
                    $('#nacimiento').prop( "disabled", false );
                }else if(Afilicion_tipo == 2){
                    //primero
                    $('#dni').prop( "disabled", true );
                    $('#buscar_dni').prop( "disabled", true );
                    $('#paterno').prop( "disabled", true );
                    $('#materno').prop( "disabled", true );
                    $('#nacimiento').prop( "disabled", true );
                    //segundo
                    $('#ruc').prop( "disabled", false );
                    $('#representante').prop( "disabled", false );
                    $('#buscar_ruc').prop( "disabled", false );
                }
            });
            $( "#editar_id_tipo_afiliacion" ).change(function() {
                var editar_Afilicion_tipo = $(this).val();
                if(editar_Afilicion_tipo == 1){
                    //primero
                    $('#editar_ruc').prop( "disabled", true );
                    $('#editar_representante').prop( "disabled", true );
                    /*valor*/
                    $('#editar_ruc').val("");
                    $('#editar_representante').val("");
                    //segundo
                    $('#editar_dni').prop( "disabled", false );
                    $('#editar_paterno').prop( "disabled", false );
                    $('#editar_materno').prop( "disabled", false );
                    $('#nacimiento').prop( "disabled", false );
                }else if(editar_Afilicion_tipo == 2){
                    //primero
                    $('#editar_dni').prop( "disabled", true );
                    $('#editar_paterno').prop( "disabled", true );
                    $('#editar_materno').prop( "disabled", true );
                    $('#nacimiento').prop( "disabled", true );
                    /*valor*/
                    $('#editar_dni').val("");
                    $('#editar_paterno').val("");
                    $('#editar_materno').val("");
                    //segundo
                    $('#editar_ruc').prop( "disabled", false );
                    $('#editar_representante').prop( "disabled", false );
                }
            });
            $('#buscar_dni').on('click',function(e){
                e.preventDefault();
                var dni = $("#dni").val()
                $.ajax({
                type: "POST",
                dataType: "json",
                url:'buscar-persona',
                data: {valor:dni},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#nombre').val(data.nombres);
                    $('#paterno').val(data.apellidoPaterno);
                    $('#materno').val(data.apellidoMaterno);
                }
                });
            });
            $('#buscar_ruc').on('click',function(e){
                e.preventDefault();
                var dni = $("#ruc").val()
                $.ajax({
                type: "POST",
                dataType: "json",
                url:'buscar-empresa',
                data: {valor:dni},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#nombre').val(data.nombre);
                    $('#direccion').val(data.direccion);
                    
                }   
                });
            });

            $(document).on('click', '.editar-usuario', function(e) {
                $('#editar_ruc').prop( "disabled", false );
                $('#editar_representante').prop( "disabled", false );
                $('#editar_dni').prop( "disabled", false );
                $('#editar_paterno').prop( "disabled", false );
                $('#editar_materno').prop( "disabled", false );
                $('#editar_id_tipo_afiliacion').val(null).trigger('change');
                $('#editar_id_tipo_afiliacion').val('');
                e.preventDefault();
                idUpdate = $(this).attr('href');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url:'allafiliaciones/'+idUpdate+'/edit',
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
                        $('#editar_ruc').val(data.ruc);
                        $('#editar_representante').val(data.representante);
                        console.log(data.id_tipo_afiliacion)
                        $('#editar_id_tipo_afiliacion option[value="'+data.id_tipo_afiliacion+'"]').attr("selected", true);
                        if(data.id_tipo_afiliacion == 1){
                            $('#editar_ruc').prop( "disabled", true );
                            $('#editar_representante').prop( "disabled", true );
                            
                        }else{
                            $('#editar_dni').prop( "disabled", true );
                            $('#editar_paterno').prop( "disabled", true );
                            $('#editar_materno').prop( "disabled", true );
                        }
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
                var formDerivar = document.getElementById("form-editar-usuario");
                let data = new FormData(formDerivar);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url:'allafiliaciones/'+idUpdate,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modal-editar-usuario').modal('hide');
                        //spinner.hide();
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
            $('#form-editar-empresa').submit(function(e){
                e.preventDefault();
                var formDerivar = document.getElementById("form-editar-usuario");
                let data = new FormData(formDerivar);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url:'allafiliaciones/'+idUpdate,
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
                    url:'allafiliaciones',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        //$('#modal-agregar-usuario').modal('hide');
                        $('#modal-agregar-usuario').modal('hide')
                 
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
            // $('#modal-editar-usuario').on('hidden.bs.modal', function () {
            //     $('#editar_id_tipo_afiliacion').val(null).trigger('change');
            //     $('#editar_id_tipo_afiliacion').val('');
            // })
        });
</script>
@endpush