<?php

namespace App\Http\Controllers;
use App\Afiliado;
use App\Producto;
use App\Pago;
use App\Afocat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AfocatController extends Controller
{
    use WithFaker;

    public function __construct()
    {
        $this->setUpFaker();
    }
    public function index()
    {   
        //return $categoria;
        return view('afiliacion.afocat.index');
    }

    public function create()
    {   
        $Productos = Producto::all();
        //return $categoria;
        return view('afiliacion.afocat.create',compact('Productos'));
    }

    public function getafocat()
    {
      $afocats = DB::table('afocats as af')
      ->select('af.*','pro.nombre as producto','ve.placa as placa','afi.id_tipo_afiliacion','afi.nombre','afi.paterno','afi.materno')
      ->join('vehiculos as ve', 've.id', 'af.id_vehiculo')
      ->join('afiliados as afi','afi.id','ve.id_afiliado')
      ->join('productos as pro','pro.id','af.id_producto')
      ->get();
      
      return \DataTables::of($afocats)->make('true');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function busqueda(Request $request){

       // return $request;
        $message = DB::table('vehiculos as ve')
        ->select('ve.*', 'af.*')
        ->join('afiliados as af','af.id','ve.id_afiliado')
        ->where('ve.placa', $request->valor)->first();
        if($message)
        $status = true;
        else
        $status = false;
        $response = array(
            "message"=>$message,
            "status"=>$status,
        );
        
        return response()->json($response);
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

            $date = Carbon::now();

            $pago = new Pago;
                $pago->monto=$request->monto_total;
                $pago->fecha=$date->format('Y-m-d');
                $pago->serie=$this->faker->numerify('########');
                //$pago->id_tipo_pago
                $pago->hash=$this->faker->unique()->lexify('??????');
                $pago->id_user=Auth::user()->id;
                $pago->id_afiliado = $request->id_afiliado;
                $pago->id_vehiculo = $request->id_vehiculo;
                $pago->id_producto = $request->id_producto;
                $pago->save(); 

            $id_pago=$pago->id;

                $afocat= new Afocat;
                $afocat->inicio_contrato = $date->format('Y-m-d');
                $afocat->fin_contrato = $date->addYears(intval($request->anios));
                $afocat->anios = intval($request->anios);
                $afocat->hora = $date->format('H:i:s');
                $afocat->monto_sbs = $request->monto_sbs;
                $afocat->monto_total = $request->monto_total;
                $afocat->id_producto  = $request->id_producto;
                $afocat->id_pago  = $id_pago;
                $afocat->id_vehiculo  = $request->id_vehiculo;
                $afocat->save();
            
        DB::commit();
            $message = "Se registro Pago de Afocat correctamente.";
            $status = true;
            $afocat = $afocat;
            $hash = $pago->hash;
        } catch (\Exception $e) {
            DB::rollback();
            $message = "Error al registrar Pago de Afocat, intentelo de nuevo si el problema persiste comuniquese con el administrador.";
            $status = false;
            $error =$e;
            $afocat = "";
            $hash = "";
        }
        $response = array(
            "message"=>$message,
            "status"=>$status,
            "afocat"=>$afocat,
            "hash" => $hash,
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
        $Persona = Afiliado::where("id",$id)->first();

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

            $afiliado = Afiliado::find($id);
            $afiliado->dni = $request->editar_dni;
            $afiliado->ruc = $request->editar_ruc;
            $afiliado->nombre = $request->editar_nombre;
            $afiliado->representante = $request->editar_representante;
            $afiliado->paterno = $request->editar_paterno;
            $afiliado->materno = $request->editar_materno;
            $afiliado->direccion = $request->editar_direccion;
            $afiliado->provincia = $request->editar_provincia;
            $afiliado->departamento = $request->editar_departamento;
            $afiliado->telefono = $request->editar_telefono;
            $afiliado->email = $request->editar_email;
            $afiliado->nacimiento = $request->editar_nacimiento;
            $afiliado->id_tipo_afiliacion = $request->editar_id_tipo_afiliacion;
            $afiliado->save();

        DB::commit();
            $message = 'Afiliado actualizado correctamente';
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Error al actualizar Afiliado, intentelo de nuevo si el problema persiste comuniquese con el administrador.';
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
