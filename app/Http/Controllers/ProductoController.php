<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Afocat;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('configuracion.producto.index');
    }

    public function getProducto()
    {
        $producto = DB::table('productos as pro')
        ->select('pro.*' ,DB::raw('"" as Opciones'))
        ->get();

        return \DataTables::of($producto)->make('true');
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

            $Producto = new Producto;
            $Producto->codigo = $request->codigo;
            $Producto->nombre = $request->nombre;
            $Producto->numero_certificado = $request->numero_certificado;
            $Producto->abreviatura = $request->abreviatura;
            $Producto->precio_unitario = $request->precio_unitario;
            $Producto->save(); 

        DB::commit();
            $message = "Producto creado correctamente.";
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = "Error al crear nuevo Producto, intentelo de nuevo si el problema persiste comuniquese con el administrador.";
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

            $Producto = Producto::find($id);
            $Producto->codigo = $request->editar_codigo;
            $Producto->nombre = $request->editar_nombre;
            $Producto->numero_certificado = $request->editar_numero_certificado;
            $Producto->abreviatura = $request->editar_abreviatura;
            $Producto->precio_unitario = $request->editar_precio_unitario;
            $Producto->save();

        DB::commit();
            $message = 'Producto actualizado correctamente';
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Error al actualizar Producto, intentelo de nuevo si el problema persiste comuniquese con el administrador.';
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
