<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pago;
use App\Vehiculo;
use App\Afiliado;
use App\Producto;
use App\Afocat;
use Illuminate\Support\Facades\DB;
use chillerlan\QRCode\QRCode;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('ventas.index');
    }


    public function getpago()
    {
      $pagos = DB::table('pagos as pa')
      ->select('pa.*','pro.nombre as producto','afi.id_tipo_afiliacion','afi.nombre','afi.paterno','afi.materno',DB::raw('"" as Opciones'))
      //->join('vehiculos as ve', 've.id', 'af.id_vehiculo')
      ->join('afiliados as afi','afi.id','pa.id_afiliado')
      ->join('productos as pro','pro.id','pa.id_producto')
      ->get();
      
      return \DataTables::of($pagos)->make('true');
    }

    public function imprimirVenta($hash)
    {
        $venta = Pago::where('hash', $hash)->first();
        $vehiculo = Vehiculo::where('id', $venta->id_vehiculo)->first();
        $afiliado = Afiliado::where('id', $venta->id_afiliado)->first();
        $producto = Producto::where('id', $venta->id_producto)->first();
        $afocat = Afocat::where('id_pago',$venta->id)->first();
        if (!isset($venta)) {
          abort(404, 'No se ha encontrado la venta');
        }
        $qrcode = (new QRCode())->render(
          url('/ventas/' . $venta->hash)
        );
        return view('ventas.ticket', [
          'venta' => $venta,
          'afiliado' => $afiliado,
          'vehiculo' => $vehiculo,
          'producto' => $producto,
          'qrcode' => $qrcode,
          'afocat' =>  $afocat
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}