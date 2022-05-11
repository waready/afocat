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
                    <button type="button" id="button" class="btn btn-success btn-sm ml-2"  >
                        <i class="fa fa-file"></i> Exportar
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
                            <label class="col-form-label col-md-4 col-sm-3 label-align">DNI/RUC</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_id" id="editar_id" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Nombre</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_nombre" id="editar_nombre" disabled placeholder="">
                            </div>
                        </div>
                        <div id="editar_dato_id">

                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Placa</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_placa" id="editar_placa" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Marca</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_marca" id="editar_marca" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Modelo</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_modelo" id="editar_modelo" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Color</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_color" id="editar_color" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Clase</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_clase" id="editar_clase"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Categoria</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_categoria" id="editar_categoria"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Asientos</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="number" class="form-control" min="1"  name="editar_asientos" id="editar_asientos"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Año</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="number" class="form-control" name="editar_anio" id="editar_anio"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Uso</label>
                            <div class="col-md-12 col-sm-12 ">
                                <select style="width: 100%" class="form-control carrera seleccion2" name="editar_id_uso" id="editar_id_uso" required>
                                    <option value="">Seleccionar---</option>
                                    @foreach($usos as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Serie</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_serie" id="editar_serie"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Motor</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="editar_motor" id="editar_motor"  placeholder="">
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
                                <input type="number" class="form-control" min="1" name="asientos" id="asientos"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Año</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="number" class="form-control" name="anio" id="anio"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Uso</label>
                            <div class="col-md-12 col-sm-12 ">
                                <select style="width: 100%" class="form-control carrera seleccion2" name="id_uso" id="id_uso" required>
                                    <option value="">Seleccionar---</option>
                                    @foreach($usos as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
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
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
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
                        var fieldHTML  = '<div><input type="hidden" name="id_afiliado" value="'+data.message.id+'"/> </div>';
                        $('#dato_id').append(fieldHTML);
                    }
                }
            });
        });
        $("#editar_id").blur(function(){
            if ($(this).val() == "") {
                $("#editar_nombre").val("BUSCANDO CLIENTE...");
            } else{
                if ($(this).val().length == 11) {
                    var tipe = "ruc";
                }
                else{
                    var tipe = "dni";
                }
            }
            var id = $("#editar_id").val()
            $("#editar_nombre").val("BUSCANDO CLIENTE...");
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
                        $("#editar_nombre").val("NO SE ENCONTRO CLIENTE");
                    }else{
                        $("#editar_nombre").val(data.message.nombre);
                        var fieldHTML  = '<div><input type="hidden" name="editar_id_afiliado" value="'+data.message.id+'"/> </div>';
                        $('#editar_dato_id').append(fieldHTML);
                    }
                }
            });
        });
      
        $("#button").click(function(){
            $("#students-table").table2excel({
            // exclude CSS class
            exclude:".noExl",
            name:"Worksheet Name",
            filename:"Vehículos",//do not include extension
            fileext:".xls", // file extension
           //columns : [0,1,2,3,4,5,6,7,8,9,10,11]
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
                        var fieldHTML  = '<div><input type="hidden" name="editar_id_afiliado" value="'+data.id_afiliado+'"/> </div>';
                        $('#editar_dato_id').append(fieldHTML);
                        $('#editar_id').val(data.dni);
                        $('#editar_nombre').val(data.nombre);
                        $('#editar_placa').val(data.placa);
                        $('#editar_marca').val(data.marca);
                        $('#editar_modelo').val(data.modelo);
                        $('#editar_color').val(data.color);
                        $('#editar_clase').val(data.clase);
                        $('#editar_categoria').val(data.categoria);
                        $('#editar_asientos').val(data.asientos);
                        $('#editar_anio').val(data.anio);
                        $('#editar_serie').val(data.serie);
                        $('#editar_motor').val(data.motor);
                        $('#editar_id_uso option[value="'+data.id_uso+'"]').attr("selected", true);
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