<?php

namespace App\Http\Controllers;
use App\Afiliado;
use App\TipoAfiliado;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AfiliadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tipoAfiliados = TipoAfiliado::all();
        //return $categoria;
        return view('afiliacion.afiliado.index',compact('tipoAfiliados'));
    }

    public function getafiliaciones()
    {
      $categoria = DB::table('afiliados as afi')
      ->select('afi.*' ,DB::raw('"" as Opciones'))
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
    public function busquedaPersona(Request $request)
    {
        $token = '';
        $number = $request->valor;
        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);

        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $number]
        ];
        $res = $client->request('GET', '/v1/dni', $parameters);
        $response = json_decode($res->getBody()->getContents(), true);
        return($response);
    }
    public function busquedaEmpresa(Request $request)
    {
        $token = '';
        $number = $request->valor;
        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);

        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $number]
        ];
        $res = $client->request('GET', '/v1/ruc', $parameters);
        $response = json_decode($res->getBody()->getContents(), true);
        return($response);
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

            $afiliado = new Afiliado;

            $afiliado->dni = $request->dni;
            $afiliado->ruc = $request->ruc;
            $afiliado->nombre = $request->nombre;
            $afiliado->representante = $request->representante;
            $afiliado->paterno = $request->paterno;
            $afiliado->materno = $request->materno;
            $afiliado->direccion = $request->direccion;
            $afiliado->provincia = $request->provincia;
            $afiliado->departamento = $request->departamento;
            $afiliado->telefono = $request->telefono;
            $afiliado->email = $request->email;
            $afiliado->nacimiento = $request->nacimiento;
            $afiliado->id_tipo_afiliacion = $request->id_tipo_afiliacion;
            $afiliado->save(); 

        DB::commit();
            $message = "Cliente registrado correctamente.";
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = "Error al registrar Cliente, intentelo de nuevo si el problema persiste comuniquese con el administrador.";
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
            $message = 'Cliente actualizado correctamente';
            $status = true;
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Error al actualizar Cliente, intentelo de nuevo si el problema persiste comuniquese con el administrador.';
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
