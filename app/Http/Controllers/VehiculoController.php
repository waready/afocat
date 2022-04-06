<?php

namespace App\Http\Controllers;

use App\Vehiculo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\VehiculoUso;

class VehiculoController extends Controller
{
    public function index()
    {   
        $usos = VehiculoUso::all();
        return view('afiliacion.vehiculo.index',compact('usos'));
    }

    public function getVehiculo()
    {
      $categoria = DB::table('vehiculos as ve')
      ->select('ve.*','veus.nombre as uso',DB::raw('"" as Opciones'))
      ->join('vehiculo_usos as veus','veus.id','ve.id_uso')
      ->get();
      
      return \DataTables::of($categoria)->make('true');
    }

    public function busqueda (Request $request){

        $message = DB::table('afiliados as af')
            ->select('af.*');
            if ($request->tipo == "ruc")
                $message->where('af.ruc',$request->valor);
            if ($request->tipo == "dni")
                $message->where('af.dni',$request->valor);

         $message= $message->first();

        $response = array(
            "message"=>$message,
        );

        return response()->json($response);
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

            $Vehiculo = new Vehiculo;

            $Vehiculo->placa = $request->placa;
            $Vehiculo->id_afiliado = $request->id_afiliado;
            $Vehiculo->marca = $request->marca;
            $Vehiculo->modelo = $request->modelo;
            $Vehiculo->color = $request->color;
            $Vehiculo->clase = $request->clase;
            $Vehiculo->categoria = $request->categoria;
            $Vehiculo->asientos = $request->asientos;
            $Vehiculo->anio = $request->anio;
            $Vehiculo->id_uso = $request->id_uso;
            $Vehiculo->serie = $request->serie;
            $Vehiculo->motor = $request->motor;
            $Vehiculo->save(); 

        DB::commit();
            $message = "Vehiculo registrado correctamente.";
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = "Error al registrar Vehiculo, intentelo de nuevo si el problema persiste comuniquese con el administrador.";
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
     * @param  \App\pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function show(pregunta $pregunta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Vehiculo = DB::table('vehiculos as ve')
        ->where("ve.id",$id)
        ->join('vehiculo_usos as veus','veus.id','ve.id_uso')
        ->join('afiliados as af','af.id','ve.id_afiliado')
        ->select('ve.*', 'veus.nombre as uso','af.dni', 'af.nombre')
        ->first();

         return response()->json($Vehiculo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request;
        DB::beginTransaction();
        try {

            $Vehiculo = Vehiculo::find($id);
            $Vehiculo->placa = $request->editar_placa;
            $Vehiculo->id_afiliado = $request->editar_id_afiliado;
            $Vehiculo->marca = $request->editar_marca;
            $Vehiculo->modelo = $request->editar_modelo;
            $Vehiculo->color = $request->editar_color;
            $Vehiculo->clase = $request->editar_clase;
            $Vehiculo->categoria = $request->editar_categoria;
            $Vehiculo->asientos = $request->editar_asientos;
            $Vehiculo->anio = $request->editar_anio;
            $Vehiculo->id_uso = $request->editar_id_uso;
            $Vehiculo->serie = $request->editar_serie;
            $Vehiculo->motor = $request->editar_motor;
            $Vehiculo->save();

        DB::commit();
            $message = 'Vehiculo actualizado correctamente';
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Error al actualizar Vehiculo, intentelo de nuevo si el problema persiste comuniquese con el administrador.';
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
     * @param  \App\pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function destroy(pregunta $pregunta)
    {
        //
    }
}
