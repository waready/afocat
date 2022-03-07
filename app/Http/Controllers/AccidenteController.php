<?php

namespace App\Http\Controllers;
use App\Accidente;
use App\Vehiculo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AccidenteController extends Controller
{
    public function index()
    {   $Vehiculos = Vehiculo::all();

        return view('siniestros.accidentes.index',compact('Vehiculos'));
    }

    public function getaccidente()
    {
        $acidente = DB::table('accidentes as ac')
        ->select('ac.*' ,DB::raw('"" as Opciones'))
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
        DB::beginTransaction();
        try {

            $Accidente = new Accidente;
            $Accidente->codigo = $request->codigo;
            $Accidente->nombre = $request->nombre;
            $Accidente->numero_certificado = $request->numero_certificado;
            $Accidente->abreviatura = $request->abreviatura;
            $Accidente->precio_unitario = $request->precio_unitario;
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
        $Producto = Producto::where("id",$id)->first();

         return response()->json($Producto);
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

            $Accidente = Accidente::find($id);
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
