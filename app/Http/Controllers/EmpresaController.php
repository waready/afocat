<?php

namespace App\Http\Controllers;
use App\Empresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {   
        return view('afiliacion.empresa.index');
    }

    public function getEmpresa()
    {
      $categoria = DB::table('empresas as emp')
      ->select('emp.*' ,DB::raw('"" as Opciones'))
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

            $Empresa = new Empresa;

            $Empresa->ruc = $request->ruc;
            $Empresa->nombre = $request->nombre;
            $Empresa->direccion = $request->direccion;
            $Empresa->provincia = $request->provincia;
            $Empresa->departamento = $request->departamento;
            $Empresa->representante = $request->representante;
            $Empresa->telefono = $request->telefono;
            $Empresa->email = $request->email;
            $Empresa->nacimiento = $request->nacimiento;
            $Empresa->save(); 

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
        $Empresa = Empresa::where("id",$id)->first();

         return response()->json($Empresa);
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

            $Empresa = Empresa::find($id);
            $Empresa->ruc = $request->editar_ruc;
            $Empresa->nombre = $request->editar_nombre;
            $Empresa->direccion = $request->editar_direccion;
            $Empresa->provincia = $request->editar_provincia;
            $Empresa->departamento = $request->editar_departamento;
            $Empresa->representante = $request->editar_representante;
            $Empresa->telefono = $request->editar_telefono;
            $Empresa->email = $request->editar_email;
            $Empresa->nacimiento = $request->editar_nacimiento;
            $Empresa->save();

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
