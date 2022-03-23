<?php

use Illuminate\Database\Seeder;
use App\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'nombre'    => 'Certificado Afocat Interprovincial > 30',
            'codigo'    => '00001',
            'numero_certificado' => '01' ,
            'abreviatura' => 'CATI',
            'precio_unitario' => 500.00
        ]);
        Producto::create([
            'nombre'    => 'Certificado Afocat Autos',
            'codigo'    => '00002',
            'numero_certificado' => '02' ,
            'abreviatura' => 'CATA',
            'precio_unitario' => 30.00
        ]);
        Producto::create([
            'nombre'    => 'Certificado Afocat Mototaxi',
            'codigo'    => '00003',
            'numero_certificado' => '03' ,
            'abreviatura' => 'CATM',
            'precio_unitario' => 15.00
        ]);
        Producto::create([
            'nombre'    => 'Certificado Afocat Urbano',
            'codigo'    => '00004',
            'numero_certificado' => '04' ,
            'abreviatura' => 'CATU',
            'precio_unitario' => 240.00
        ]);
        Producto::create([
            'nombre'    => 'Certificado Afocat Interprovincial = 30',
            'codigo'    => '00005',
            'numero_certificado' => '05' ,
            'abreviatura' => 'CAT30',
            'precio_unitario' => 797.00
        ]);
        Producto::create([
            'nombre'    => 'Certificado Afocat Interprovincial < 30',
            'codigo'    => '00006',
            'numero_certificado' => '06' ,
            'abreviatura' => 'CAT>30',
            'precio_unitario' => 854.00
        ]);
        Producto::create([
            'nombre'    => 'Certificado otros',
            'codigo'    => '00007',
            'numero_certificado' => '07' ,
            'abreviatura' => 'otros',
            'precio_unitario' => 10.00
        ]);
    }
}
