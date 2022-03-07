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
            <div class="card ">
                <div class="card-header">Certificado de Afocat
                    {{-- <button type="button" id="agregar-responsable-carrera" class="btn btn-info btn-sm ml-2" data-toggle="modal" data-target="#modal-agregar-usuario">
                        <i class="fa fa-plus"></i> Agregar
                    </button> --}}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form id="busqueda-afiliado">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <select  id="tipo" name="tipo" class="form-control" disabled>
                                      <option value="1" selected>PLACA</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <input class="form-control" type="text" name="valor" id="valor">                                
                                </div>
                                <div class="col-md-3">

                                    <button  type="submit" id="submit" class="btn btn-primary">Buscar Afiliado</button>
                                </div>
                            </div>                          
                        </form>
                        <hr>
                            <h4>Datos Vehiculos</h4>
                        <form id="form-crear-pago" class="form-horizontal form-label-left" >
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" id="id_vehiculo" name="id_vehiculo" >
                            <div class="form-row">
                              <div class="form-group col-md-3">
                                <label for="inputEmail4">Marca</label>
                                <input type="text" class="form-control" id="marca"   disabled>
                              </div>
                              <div class="form-group col-md-3">
                                <label for="inputPassword4">Modelo</label>
                                <input type="text" class="form-control" id="modelo"   disabled>
                              </div>
                              <div class="form-group col-md-3">
                                <label for="inputtext4">Color</label>
                                <input type="text" class="form-control" id="color"   disabled>
                              </div>
                              <div class="form-group col-md-3">
                                <label for="inputtext4">Uso</label>
                                <input type="text" class="form-control" id="uso"   disabled>
                              </div>
                            </div>
                            <hr>
                            <h4>Datos Afiliado</h4>
                            <input type="hidden" id="id_afiliado" name="id_afiliado" >
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" disabled >
                                  </div>
                                <div class="form-group col-md-3">
                                    <label for="inputAddress2">DNI</label>
                                    <input type="text" class="form-control" id="dni" disabled>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputAddress2">RUC</label>
                                    <input type="text" class="form-control" id="ruc" disabled>
                                </div>
                            </div>
                            <hr>
                            <h4>CONCEPTOS DE PAGO</h4>
                            <div class="form-row">
                                <div class="item form-group col-md-6">
                                    <label class="col-form-label  label-align">Tipo Certificado</label>
                                    <div class="">
                                        <select style="width: 100%" class="form-control carrera seleccion2" name="id_producto" id="id_producto" required>
                                            <option value="">Seleccionar---</option>
                                            @foreach($Productos as $tipo)
                                                <option value="{{$tipo->id}}" name="{{ $tipo->precio_unitario }}">{{$tipo->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group col-md-6">
                                    <label class="col-form-label  label-align">Numero Certificado</label>
                                    <div class=" ">
                                        <input type="text" class="form-control" name="numero_certificado" id="numero_certificado" required placeholder="">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="item form-group col-md-3">
                                    <label class="col-form-label  label-align">Monto SBS</label>
                                    <div class=" ">
                                        <input type="text" class="form-control" name="monto_sbs" id="monto_sbs" required placeholder="">
                                    </div>
                                </div>
                                <div class="item form-group col-md-3">
                                    <label class="col-form-label  label-align">Inicio Contrato</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="inicio_contrato" id="inicio_contrato" required placeholder="">
                                    </div>
                                </div>
                                <div class="item form-group col-md-3">
                                    <label class="col-form-label  label-align">Años</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="anios" id="anios" required placeholder="">
                                    </div>
                                </div>
                                <div class="item form-group col-md-3">
                                    <label class="col-form-label  label-align">Fin contrato</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="fin_contrato" id="fin_contrato" required disabled>
                                    </div>
                                </div>
                                <input  type="button" id="add-row" class="btn btn-primary " value="Agregar Certificado"/>
                            </div>
                            <div>
                                <table  class="table mt-2">
                                    <thead>
                                        <tr>
                                            <th>CONCEPTO</th>
                                            <th class="text-right">PRECIO U.</th>
                                            <th class="text-right">CANTIDAD</th>
                                            <th class="text-right">SUB. TOTAL</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="agregar"></tr>
                                        <tr>
                                            <th colspan="3" class="text-right">TOTAL</th>
                                            <th class="text-right">S/ <span id="sptotal"></span>.00</th>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" id="monto_total" name="monto_total" >
                            <button type="submit"  class="btn btn-primary">Registrar Pago</button>
                        </form>
                        <a  href="" id="imprimir" class="btn btn-light" style=""><i  class="fas fa-print"></i> Imprimir Ticket </a>
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
                <h5 class="modal-title">Editar Afiliado</h5>
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
                                    {{-- @foreach($tipoAfiliados as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach --}}
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
                <h5 class="modal-title">Agregar Nuevo Afiliado</h5>
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
                                    {{-- @foreach($tipoAfiliados as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach --}}
                                </select>
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
                            <label class="col-form-label col-md-4 col-sm-3 label-align">DNI</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="dni" id="dni" maxlength="8" required placeholder="">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">RUC</label>
                            <div class="col-md-12 col-sm-12 ">
                                <input type="text" class="form-control" name="ruc" id="ruc" maxlength="11" required placeholder="">
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
        var monto,numero,index=0;
        $('#add-row').prop( "disabled", true );
        $('#imprimir').hide();
        var conceptName="";
     
                
            $('#busqueda-afiliado').submit(function(e){
                e.preventDefault();
                var id = $("#valor").val()
                //var id = 1;
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url:'buscar-afiliado',
                    data: {valor:id},
                    //processData: false,  // tell jQuery not to process the data
                    //contentType: false  
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if(data.status){
                        toastr.success("Se encontro al Afiliado", '¡Operación Exitosa!', {timeOut: 5000})
                        $('#marca').val(data.message.marca);
                        $('#modelo').val(data.message.modelo);
                        $('#color').val(data.message.color);
                        $('#uso').val(data.message.uso);
                        $('#id_afiliado').val(data.message.id_afiliado)
                        $('#id_vehiculo').val(data.message.id)
                            if(data.message.dni){
                                $('#dni').val(data.message.dni);
                            }
                            else{
                                $('#ruc').val(data.message.ruc);
                            }
                            if (data.message.id_tipo_afiliacion == 1){
                                $('#nombre').val(data.message.nombre+" "+data.message.paterno+" "+data.message.materno)
                            }else if(data.message.id_tipo_afiliacion == 2){
                                $('#nombre').val(data.message.nombre);
                            } 
                        }
                        else{
                            toastr.error("No se encontro al Afiliado", '¡Error!', {timeOut: 5000})
                            $('#marca').val('');
                            $('#modelo').val('');
                            $('#color').val('');
                            $('#uso').val('');
                            $('#id_afiliado').val('')
                            $('#id_vehiculo').val('')
                            $('#nombre').val('');
                            $('#dni').val('');
                            $('#ruc').val('');
                        }
                    },
                    error: function(error) {
                        $('#modal-agregar-usuario').modal('hide');
                       // spinner.hide();
                        toastr.error(error, '¡Error!', {timeOut: 5000})
                    }
                });
            });
            $("#id_producto").change(function() {
                var disable = $(this).val();
                console.log(disable);
                if(disable === ""){
                    $('#add-row').prop( "disabled", true );
                }else{
                    $('#add-row').prop( "disabled", false );
                    monto = parseFloat($(this).children(":selected").attr("name"));
                    numero = monto;
                    conceptName = $('#id_producto').find(":selected").text();
                }
            
            });
          
            $("#add-row").click(function () {  
                
                index=1;  
                $("#sptotal").html(monto);
                numero=monto;
                $("table tbody tr#agregar").html("<td>"+conceptName+"</td><td>"+monto+"</td><td><a class='agregar btn btn-primary' href='#'> <i class='fas fa-plus' aria-hidden='true'></i></a><span id='index'></span><a class='quitar ml-1 btn btn-primary' href='#'> <i class='fas fa-minus' aria-hidden='true'></i></a></td><td>"+monto+"</td><td><a class='eliminar-usuario' href='#'> <i class='fas fa-trash big-icon text-danger' aria-hidden='true'></i></a></td>");
                $("#index").html(index);
            });
            $(document).on('click', '.agregar', function(e) {
                e.preventDefault();
                numero= numero + monto;
                index++;
               $("#index").html(index);
               $("#sptotal").html(numero);
            });
            $(document).on('click', '.quitar', function(e) {
                e.preventDefault();
                numero = numero - monto;
                index--;
                if(Math.sign(numero) == -1){
                    index=0;
                    numero=0;
                }
                $("#index").html(index);
                $("#sptotal").html(numero);
            });
            $(document).on('click', '.eliminar-usuario', function(e) {
                e.preventDefault();
                index=0;
                numero=0;
                $("table tbody tr#agregar").html('');
                $("#index").html(index);
                $("#sptotal").html(numero);  
            });
            $('#form-crear-pago').submit(function(e){
                e.preventDefault();
                $("#monto_total").val(numero); 
                console.log(numero);
                if(numero == 0){
                    toastr.error("el monto total es: 0", '¡Error!', {timeOut: 5000})
                    return;
                }
                
                // let data = $(this).serialize();
                var formDerivar = document.getElementById("form-crear-pago");
                let data = new FormData(formDerivar);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url:'allafocat',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        //$('#modal-agregar-usuario').modal('hide');
                        $('#modal-agregar-usuario').modal('hide')
                        //console.log(data);
                        if(data.status)
                        {
                            // dt.ajax.reload();
                            toastr.success(data.message, '¡Operación Exitosa!', {timeOut: 5000})
                            $('#valor').val('');
                            $('#marca').val('');
                            $('#modelo').val('');
                            $('#color').val('');
                            $('#uso').val('');
                            $('#id_afiliado').val('')
                            $('#id_vehiculo').val('')
                            $('#nombre').val('');
                            $('#dni').val('');
                            $('#ruc').val('');

                            $('#id_producto').val(null).trigger('change');
                            $('#id_producto').val('');
                            $('#numero_certificado').val('')
                            $('#monto_sbs').val('')
                            $('#inicio_contrato').val('');
                            $('#anios').val('');
                            $('#fin_contrato').val('');

                            index=0;
                            numero=0;
                            $("table tbody tr#agregar").html('');
                            $("#index").html(index);
                            $("#sptotal").html(numero); 
                             
                            $('#imprimir').attr('href', "http://localhost:8000/ventas/"+data.hash);
                            $('#imprimir').show();
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
           
           
        });
</script>
@endpush