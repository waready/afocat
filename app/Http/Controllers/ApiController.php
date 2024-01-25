<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function fetchDni(Request $request)
    {
        $token = ''; // Tu token
        $number = $request->input('valor');

        $client = new GuzzleClient(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);

        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $number],
        ];

        try {
            $res = $client->request('GET', '/v1/dni', $parameters);
            $response = json_decode($res->getBody()->getContents(), true);
            return response()->json($response);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Manejar errores de la solicitud, si es necesario
            return response()->json(['error' => 'Error en la solicitud a la API externa'], 500);
        }
    }

    public function fetchRuc(Request $request)
    {
        $token = ''; // Tu token
        $number = $request->input('valor');

        $client = new GuzzleClient(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);

        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $number],
        ];

        try {
            $res = $client->request('GET', '/v1/dni', $parameters);
            $response = json_decode($res->getBody()->getContents(), true);
            return response()->json($response);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Manejar errores de la solicitud, si es necesario
            return response()->json(['error' => 'Error en la solicitud a la API externa'], 500);
        }
    }
}
