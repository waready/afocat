<?php

namespace App\Http\Controllers;
use App\Accidente;
use App\Accidentado;
use App\Vehiculo;
use App\Gasto;
use App\AccidentadoGasto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AccidentadoGastoController extends Controller
{
    public function index()
    {   $TipoGasto = Gasto::all();
        $Accidentado = Accidentado::all();

        return view('siniestros.accidente-gastos.index',compact('Accidentado','TipoGasto'));
    }

    public function getaccidente()
    {
        $acidente = DB::table('accidentado_gastos as ac')
        ->select('ac.*','ve.nombre as Gasto','aci.nombres as accidentado',DB::raw('"" as Opciones'))
        ->join('gastos as ve', 'ac.id_gasto','ve.id')
        ->join('accidentados as aci','aci.id','ac.id_accidentado')
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
        //return $request;
        DB::beginTransaction();
        try {

            $Accidente = new AccidentadoGasto;
            $Accidente->Pagado = $request->Pagado;
            $Accidente->Pendiente = $request->Pendiente;
            $Accidente->archivo_path = $request->archibo_path;
            $Accidente->fecha_limite = $request->fecha_limite;
            $Accidente->id_accidentado = $request->id_accidentado;
            $Accidente->id_gasto = $request->id_gasto;
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
    {
        DB::beginTransaction();
        try {

            $Accidente = AccidentadoGasto::find($id);
            $Accidente->codigo = $request->codigo;
            $Accidente->nombre = $request->nombre;
            $Accidente->numero_certificado = $request->numero_certificado;
            $Accidente->abreviatura = $request->abreviatura;
            $Accidente->precio_unitario = $request->precio_unitario;
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
