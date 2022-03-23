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
      ->select('ve.*' ,DB::raw('"" as Opciones'))
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
            $Vehiculo->uso = $request->uso;
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
        $Vehiculo = Vehiculo::where("id",$id)
        
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
        DB::beginTransaction();
        try {

            $Persona = Persona::find($id);
            $Persona->dni = $request->editar_dni;
            $Persona->nombre = $request->editar_nombre;
            $Persona->paterno = $request->editar_paterno;
            $Persona->materno = $request->editar_materno;
            $Persona->direccion = $request->editar_direccion;
            $Persona->provincia = $request->editar_provincia;
            $Persona->departamento = $request->editar_departamento;
            $Persona->telefono = $request->editar_telefono;
            $Persona->email = $request->editar_email;
            $Persona->nacimiento = $request->editar_nacimiento;
            $Persona->save();

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
