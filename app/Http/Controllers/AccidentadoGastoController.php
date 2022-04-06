<?php

namespace App\Http\Controllers;
use App\Accidente;
use App\Accidentado;
use App\Vehiculo;
use App\TipoPago;
use App\AccidentadoGasto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccidentadoGastoController extends Controller
{
    private $dateTime;
    private $dateTimePartial;
    public function __construct()
    {
        $this->middleware('auth');

        date_default_timezone_set("America/Lima");//Zona horaria de Peru
        $this->dateTime = date("Y-m-d H:i:s");
        $this->dateTimePartial = date("m-Y");

    }
    public function index()
    {   $TipoGasto = TipoPago::all();
        $Accidentado = Accidentado::all();

        return view('siniestros.accidente-gastos.index',compact('Accidentado','TipoGasto'));
    }

    public function getaccidente()
    {
        $acidente = DB::table('accidentado_gastos as ac')
        ->select('ac.*','aci.nombres as accidentado','ga.nombre as gasto','tp.nombre as tipo_pago',DB::raw('"" as Opciones'))
        ->join('tipo_pagos as tp','tp.id','ac.id_tipo_pago')
        ->join('accidentados as aci','aci.id','ac.id_accidentado')
        ->join('gastos as ga','ga.id','aci.id_gasto')
        ->get();

        return \DataTables::of($acidente)->make('true');
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
       // return $request;
        $date = Carbon::now();
        DB::beginTransaction();
        try {

            $Accidente = new AccidentadoGasto;
            $Accidente->monto_pagado = $request->monto_pagado;
          //  $Accidente->Pendiente = $request->Pendiente;
            //$Accidente->archivo_path = $request->archibo_path;
            $Accidente->hora = $date->format('H:i:s');
            $file = $request->file('doc_conformidad');
            if($file){
                $name = 'A-'.$file->getClientOriginalName();
                $titulo = explode(".",$file->getClientOriginalName())[0];
                $Accidente->archivo_path = $this->dateTimePartial.'/'.$name;
                Storage::disk('adjuntos')->putFileAs($this->dateTimePartial, $file, $name);
            }
            $Accidente->fecha_pago = $request->fecha_pago;
            $Accidente->id_accidentado = $request->id_accidentado;
            $Accidente->id_tipo_pago = $request->id_tipo_pago;
            $Accidente->save(); 

        DB::commit();
            $message = "Accidente creado correctamente.";
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = "Error al crear nuevo Accidente, intentelo de nuevo si el problema persiste comuniquese con el administrador.";
            $status = false;
            $error =$e;
        }
        $response = array(
            "message"=>$message,
            "status"=>$status,
            "error"=>isset($error) ? $error:''
        );

        return response()->json($response);
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
        $Accidente = AccidentadoGasto::where("id",$id)->first();

         return response()->json($Accidente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $date = Carbon::now();
     //   return $request;
        DB::beginTransaction();
        try {
        
            $Accidente = AccidentadoGasto::find($id);
            
            $Accidente->monto_pagado = $request->editar_monto_pagado;
            $Accidente->hora = $date->format('H:i:s');
            $file = $request->file('editar_doc_conformidad');
            if($file){
                $name = 'A-'.$file->getClientOriginalName();
                $titulo = explode(".",$file->getClientOriginalName())[0];
                $Accidente->archivo_path = $this->dateTimePartial.'/'.$name;
                Storage::disk('adjuntos')->putFileAs($this->dateTimePartial, $file, $name);
            }
            $Accidente->fecha_pago = $request->editar_fecha_pago;
            $Accidente->id_accidentado = $request->editar_id_accidentado;
            $Accidente->id_tipo_pago = $request->editar_id_tipo_pago;
            $Accidente->save(); 

        DB::commit();
            $message = 'Accidente actualizado correctamente';
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Error al actualizar Accidente, intentelo de nuevo si el problema persiste comuniquese con el administrador.';
            $status = false;
            $error = $e;
        }
        $response = array(
            "message"=>$message,
            "status"=>$status,
            "error"=>isset($error) ? $error:''
        );
        return response()->json($response);
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
