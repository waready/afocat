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
        <div class="card-header">Accidentados
            <button type="button" id="agregar-responsable-carrera" class="ml-2 btn btn-info btn-xl" data-toggle="modal" data-target="#modal-agregar-usuario">
                <i class="fa fa-plus"></i> Registrar
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
                        <th>{{ __("DNI") }}</th>
                        <th>{{ __("Nombre") }}</th>
                        <th>{{ __("Forma de Pago") }}</th>
                        <th>{{ __("A_82") }}</th>
                        <th>{{ __("Cuenta A_82") }}</th>
                        <th>{{ __("Ubicacion") }}</th>
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
                        <label class="col-form-label col-md-4 col-sm-3 label-align">DNI</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_dni" id="editar_dni" required placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Nombres</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_nombres" id="editar_nombres" required placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">forma de pago</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_forma_pago" id="editar_forma_pago"  placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">A_82</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_a_82" id="editar_a_82"  placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Cuenta A_82</label>
                        <div class="col-md-12 col-sm-12 ">
                            <input type="text" class="form-control" name="editar_cuenta_a_82" id="editar_cuenta_a_82"  placeholder="">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 col-sm-3 label-align">Accidente</label>
                        <div class="col-md-12 col-sm-12 ">
                            <select style="width: 100%" class="form-control carrera seleccion2" name="editar_id_accidente" id="editar_id_accidente" required>
                                <option value="">Seleccionar---</option>
                                @foreach($Accidente as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->ubicacion}}</option>
                                @endforeach
                            </select>
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
                            <label class="col-form-label col-md-4 col-sm-3 label-align">DNI</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="dni" id="dni" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Nombres</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="nombres" id="nombres" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">forma de pago</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="forma_pago" id="forma_pago"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">A_82</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="a_82" id="a_82"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Cuenta A_82</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="cuenta_a_82" id="cuenta_a_82"  placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Accidente</label>
                            <div class="col-md-12 col-sm-12 ">
                                <select style="width: 100%" class="form-control carrera seleccion2" name="id_accidente" id="id_accidente" required>
                                    <option value="">Seleccionar---</option>
                                    @foreach($Accidente as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->ubicacion}}</option>
                                    @endforeach
                                </select>
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
<script>
    jQuery(document).ready(function() {
        $('.seleccion2').select2({
        placeholder: "Seleccione una opción",
    });

        dt = jQuery("#afocat-table").DataTable({
                pageLength: 15,
                lengthMenu: [15, 25, 50, 75, 100 ],
                processing: true,
                
                ajax: '{{ route('getaccidentado') }}',
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    {data: 'dni'},
                    {data: 'nombres'},
                    {data: 'forma_pago'},
                    {data: 'a_82'},
                    {data: 'cuenta_a_82'},
                    {data: 'ubicacion'},
                    {data: 'placa'},
                    {data: 'Opciones'}
                ],
                rowCallback:function(row, data,index){ 
                 
                    $('td:eq(7)',row).html('<a class="editar-usuario" href="'+data.id+'"> <i class="fas fa-pencil-alt big-icon text-primary" aria-hidden="true"></i></a>  <a class="eliminar-usuario" href="#"> <i class="fas fa-trash big-icon text-danger" aria-hidden="true"></i></a>')    
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
                    url:'allaccidentado/'+idUpdate+'/edit',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data)
                        $('#editar_nombres').val(data.nombres);
                        $('#editar_dni').val(data.dni);
                        $('#editar_forma_pago').val(data.forma_pago);
                        $('#editar_a_82').val(data.a_82);
                        $('#editar_cuenta_a_82').val(data.cuenta_a_82);
                        $('#editar_id_accidente option[value="'+data.id_accidente+'"]').attr("selected", true);
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
                    url:'allaccidentado/'+idUpdate,
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
                    url:'allaccidentado',
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