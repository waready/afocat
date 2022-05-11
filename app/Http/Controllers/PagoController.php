<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Response;
use PDF;

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
    public function generarDocumentoPdf(Request $request)
    {
      $mes['01'] = "ENERO";
      $mes['02'] = "FEBRERO";
      $mes['03'] = "MARZO";
      $mes['04'] = "ABRIL";
      $mes['05'] = "MAYO";
      $mes['06'] = "JUNIO";
      $mes['07'] = "JULIO";
      $mes['08'] = "AGOSTO";
      $mes['09'] = "SEPTIEMBRE";
      $mes['10'] = "OCTUBRE";
      $mes['11'] = "NOVIEMBRE";
      $mes['12'] = "DICIEMBRE";
      $url = "google";
      //$idTransaccion = $_POST['idTransaccion'];
      $idCert = $request->get('idCert');
      $nombres = "Antony Japura Paredes";
      $codigoCIP = "00001";
      $fechaIncorporacion = "2020-12-12";
      $especialidad = "sistemas";
      $asunto = "certificado Afocat";
      $institucion = "Auto - Color :Negro  - Motor:1400 - Serie:2000";
      $lugar = "puno";
      $vdia = "11";
      $vmes = "12";
      $vyear = "2020";
      $consejo = "Puno";
      $fdia = "12";
      $fmes = "10";
      $fyear = "2022";
  
      $y = 5;
      $yy = 3;
      $x = 2;
  
      $fpdf = new Fpdf();
      $fpdf->AddPage();
      $fpdf->SetFont('Times', '', 10);
      $fpdf->SetY(8 + $y);
      $fpdf->SetX(36);
      $fpdf->Cell(0, 25, $nombres, 0, 1);
  
      $fpdf->SetY(14 + $y);
      $fpdf->SetX(70);
      $fpdf->Cell(0, 25, 'PUNO');
      $fpdf->SetX(165);
      $fpdf->Cell(0, 25, $codigoCIP);
  
      $fpdf->SetY(21 + $y - $x);
      $fpdf->SetX(45);
      $fpdf->Cell(0, 25, $fechaIncorporacion);
      $fpdf->SetX(125);
      $fpdf->Cell(0, 25, utf8_decode($especialidad));
  
      $fpdf->SetY(35 + $y - $yy);
      $fpdf->SetX(31);
      $fpdf->Cell(0, 25, utf8_decode($asunto));
  
      $fpdf->SetY(42 + $y - $yy);
      $fpdf->SetX(31);
      $fpdf->Cell(0, 25, utf8_decode($institucion));
  
      $fpdf->SetY(49 + $y - $yy);
      $fpdf->SetX(31);
      $fpdf->Cell(0, 25, utf8_decode($lugar));
  
      $fpdf->SetY(49 + $y - $x);
      $fpdf->SetX(173 - $x);
      $fpdf->Cell(0, 25, $vdia);
      $fpdf->SetX(184 - $x);
      $fpdf->Cell(0, 25, $vmes);
      $fpdf->SetX(195 - $x);
      $fpdf->Cell(0, 25, $vyear);
  
      $fpdf->SetY(56 + $y - $x);
      $fpdf->SetX(125);
      $fpdf->Cell(0, 25, utf8_decode($consejo));
      $fpdf->SetX(157);
      $fpdf->Cell(0, 25, utf8_decode($fdia));
      $fpdf->SetX(170);
      $fpdf->Cell(0, 25, utf8_decode($fmes));
      $fpdf->SetX(200);
      $fpdf->Cell(0, 25, utf8_decode(substr($fyear, -2)));
  
      $fpdf->SetFont('Times', '', 12);
      $fpdf->SetY(115 + $y);
      $fpdf->SetX(62);
      $fpdf->Cell(0, 25, $nombres, 0, 1);
  
      $fpdf->SetY(123 + $y - $x);
      $fpdf->SetX(100);
      $fpdf->Cell(0, 25, $consejo, 0, 1);
  
      $fpdf->SetY(130 + $y);
      $fpdf->SetX(110);
      $fpdf->Cell(0, 25, $codigoCIP, 0, 1);
      $fpdf->SetY(130 + $y);
      $fpdf->SetX(172);
      $fpdf->Cell(0, 25, $fechaIncorporacion, 0, 1);
  
      $fpdf->SetY(137 + $y);
      $fpdf->SetX(60);
      $fpdf->Cell(0, 25, utf8_decode($especialidad));
  
      $fpdf->SetY(177);
      $fpdf->SetX(60);
      $fpdf->Cell(0, 25, utf8_decode($asunto));
  
      $fpdf->SetY(188);
      $fpdf->SetX(60);
      $fpdf->Cell(0, 25, utf8_decode($institucion));
  
      $fpdf->SetY(199);
      $fpdf->SetX(60);
      $fpdf->Cell(0, 25, utf8_decode($lugar));
  
      $fpdf->SetY(223);
      $fpdf->SetX(105);
      $fpdf->Cell(0, 25, $vdia);
      $fpdf->SetX(121);
      $fpdf->Cell(0, 25, $vmes);
      $fpdf->SetX(138);
      $fpdf->Cell(0, 25, $vyear);
  
      $fpdf->SetY(239 - $yy);
      $fpdf->SetX(88);
      $fpdf->Cell(0, 25, utf8_decode($consejo));
      $fpdf->SetX(124);
      $fpdf->Cell(0, 25, utf8_decode($fdia));
      $fpdf->SetX(141);
      $fpdf->Cell(0, 25, utf8_decode($fmes));
      $fpdf->SetX(173);
      $fpdf->Cell(0, 25, utf8_decode(substr($fyear, -2)));
      //return $fpdf->Output();//$pdf->stream();
      $qrcode = (new QRCode())->render(
        url('/ventas/' . $url)
      );
      //$fpdf->Image($qrcode,100,100,10);
      $fpdf->Image($qrcode, 30, 230, 35, 30, "png");
  
      // $content = $fpdf->Output('', 'S');
      // $url = "hola.pdf";
      // Storage::disk('public')->put($url,$content);
  
      $headers = ['Content-Type' => 'application/pdf'];
      return Response::make($fpdf->Output(), 200, $headers);
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
