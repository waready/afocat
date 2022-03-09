<?php

namespace App\Http\Controllers;
use App\Accidente;
use App\Accidentado;
// use App\Vehiculo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AccidentadoController extends Controller
{
    public function index()
    {   $Accidente = Accidente::all();

        return view('siniestros.accidentados.index',compact('Accidente'));
    }

    public function getAccidentado()
    {
        $acidente = DB::table('accidentados as ados')
        ->select('ados.*','ac.*','ve.placa',DB::raw('"" as Opciones'))
        ->join('accidentes as ac', 'ac.id','ados.id_accidente')
        ->join('vehiculos as ve','ac.id_vehiculo','ve.id')
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
            $Accidentado = new Accidentado;
            $Accidentado->a_82 = $request->a_82;
            $Accidentado->cuenta_a_82 = $request->cuenta_a_82;
            $Accidentado->forma_pago = $request->forma_pago;
            $Accidentado->id_accidente = $request->id_accidente;
            $Accidentado->nombres = $request->nombres;
            $Accidentado->dni = $request->dni;
            $Accidentado->save(); 

        DB::commit();
            $message = "Accidentado registrado correctamente.";
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = "Error al crear nuevo Accidentado, intentelo de nuevo si el problema persiste comuniquese con el administrador.";
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
        $Accidentado = Accidentado::where("id",$id)->first();

         return response()->json($Accidentado);
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

            $Accidentado = Accidentado::find($id);
            $Accidentado->a_82 = $request->editar_a_82;
            $Accidentado->cuenta_a_82 = $request->editar_cuenta_a_82;
            $Accidentado->forma_pago = $request->editar_forma_pago;
            $Accidentado->id_accidente = $request->editar_id_accidente;
            $Accidentado->nombres = $request->editar_nombres;
            $Accidentado->dni = $request->editar_dni;
            $Accidentado->save(); 

        DB::commit();
            $message = 'Accidentado actualizado correctamente';
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Error al actualizar Accidentado, intentelo de nuevo si el problema persiste comuniquese con el administrador.';
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
