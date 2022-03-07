<?php

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Venta
    {{-- {{$venta->getTipoVentaDescripcion()}}  --}}
    {{-- {{ sprintf("%'03d", $venta->id_sede) }}-{{ sprintf("%'08d", $venta->serie) }} --}}
  </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    .wrapper {
      border-style: solid;
      border-width: 1px;
      border-color: black;
      width: 80mm;
      font-family: 'monospace';
      padding: 1rem;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="row my-3">
      <div class="col">
        <img class="img-fluid" src="" alt="[imagen-logo-afocat]">
      </div>
    </div>
    <div class="row">
      <div class="col-8">
        {{-- {{ $venta }} --}}
  
        <span>{{$venta->getTipoVentaDescripcion()}} </span>
        <span class="text-nowrap">{{ sprintf("%'08d", $venta->serie) }}</span>
      </div>
      <div class="col text-right">
        {{-- {{$venta->sede_nombre}} --}}
        Puno
      </div>
    </div>
    <div class="row">
      <div class="col">{{$afiliado->paterno}} {{$afiliado->materno}} {{$afiliado->nombre}}</div>
    </div>
      @if($afiliado->dni)
      <div>DNI: {{$afiliado->dni}}</div>
      @else 
      <div>RUC: {{$afiliado->ruc}}</div>
      @endif
    <div>PLACA: {{$vehiculo->placa}}</div>
    <div>MACA: {{$vehiculo->marca}}</div>
    <div>Direccion: {{$afiliado->direccion}}</div>
    <hr>
    <b>CONCEPTOS DE PAGO</b>
    {{-- @foreach($venta->detalles as $detalle) --}}
    <div class="row">
      {{-- <div class="col-8">{{$detalle->concepto ? $detalle->concepto : $detalle->producto->nombre}}</div> --}}
      {{-- <div class="col-4 text-right">{{$detalle->precio_unitario}}</div> --}}
      <div class="col-8">{{$producto->nombre}}</div> 
      <div class="col-4 text-right">{{$producto->precio_unitario}}</div>
    </div>
    <div class="row">
      <div class="col-8">Años</div> 
      <div class="col-4 text-right">{{$afocat->anios}}</div> 
    </div>
    {{-- <div class="row">
      <div class="col-8">Hora</div> 
      <div class="col-4 text-right">{{$afocat->hora}}</div>
    </div> --}}
    {{-- <div class="row">
      <div class="col-8">Monto SBS</div> 
      <div class="col-4">{{$afocat->monto_sbs}}</div>  
    </div> --}}
    {{-- @endforeach --}}
    <hr>
    <div class="row">
      <div class="col-8">Total</div>
      {{-- <div class="col-4 text-right">{{number_format($venta->getSumaDetalles(), 2)}}</div> --}}
      <div class="col-4 text-right">{{number_format($venta->monto, 2)}}</div>
    </div>
    <div>
      <div class="text-center">
        <img src="{{$qrcode}}" alt="qrcode">
      </div>
    </div>
  </div>
</body>

</html>
