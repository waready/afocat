<?php

namespace App\Http\Controllers;
use App\Persona;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('afiliacion.persona.index');
    }

    public function getPersona()
    {
      $categoria = DB::table('personas as per')
      ->select('per.*' ,DB::raw('"" as Opciones'))
      ->get();
      
      return \DataTables::of($categoria)->make('true');
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

            $Persona = new Persona;

            $Persona->dni = $request->dni;
            $Persona->nombre = $request->nombre;
            $Persona->paterno = $request->paterno;
            $Persona->materno = $request->materno;
            $Persona->direccion = $request->direccion;
            $Persona->provincia = $request->provincia;
            $Persona->departamento = $request->departamento;
            $Persona->telefono = $request->telefono;
            $Persona->email = $request->email;
            $Persona->nacimiento = $request->nacimiento;
            $Persona->save(); 

        DB::commit();
            $message = "Categoria creado correctamente.";
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = "Error al crear nueva Categoria, intentelo de nuevo si el problema persiste comuniquese con el administrador.";
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
        $Persona = Persona::where("id",$id)->first();

         return response()->json($Persona);
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
            $message = 'Tipo Examen actualizado correctamente';
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Error al actualizar Tipo Examen, intentelo de nuevo si el problema persiste comuniquese con el administrador.';
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
