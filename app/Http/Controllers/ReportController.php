<?php

namespace App\Http\Controllers;

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Style\Alignment;
// use PhpOffice\PhpSpreadsheet\Style\Fill;
// use Symfony\Component\HttpFoundation\StreamedResponse;
// use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function exportDiario()
    {

        // Crear un nuevo objeto Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Personalizar el contenido del reporte
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Reporte Afiliados');

        // Establecer estilo y formato para el encabezado
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3366CC'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:B1')->applyFromArray($headerStyle);

        // Obtener los datos de la tabla 'users'
        // $users = DB::table('users')->select('name', 'email')->get();
        $afocats = DB::table('afocats')
        ->select('*')
        ->join('vehiculos', 'afocats.id_vehiculo', '=', 'vehiculos.id')
        ->join('afiliados', 'vehiculos.id_afiliado', '=', 'afiliados.id')
        ->whereDate('inicio_contrato', '=', date('Y-m-d'))
        ->get();
        // Agregar los datos al reporte
        // Agregar los datos al reporte
        $datos = ['NRO ORDEN', 'FECHA DE EMISION', 'FECHA DE INICIO', 'FECHA DE FIN', 'NRO. CAT', 'APELLIDOS Y NOMBRES', 'DNI/RUC', 'PLACA DE RODAJE', 'ZONA GEOGRÁFICA', 'CATEGORIA DEL VEHICULO', 'USO VEH.', 'CLASE DE VEHICULO', 'VALOR DEL CAT', 'APORTE DE RIESGO', 'APORTE PARA GASTO ADM', 'APORTE EXTRAORDINARIO'];

        $columnaInicial = 'A';
        $filaInicial = 3;
        
        foreach ($datos as $index => $valor) {
            $columna = chr(ord($columnaInicial) + $index);
            $celda = $columna . $filaInicial;
            $sheet->setCellValue($celda, $valor);
        }
        // Establecer estilo para las celdas de encabezado
        $headerCellStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3366CC'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $columnaInicial = 'A';
        $columnaFinal = chr(ord($columnaInicial) + count($datos) - 1);
        $rango = $columnaInicial . '3:' . $columnaFinal . '3';

        $sheet->getStyle($rango)->applyFromArray($headerCellStyle);

        $row = 4;
        foreach ($afocats as $afocat) {
            $sheet->setCellValue('A' . $row, $afocat->id);
            $sheet->setCellValue('B' . $row, $afocat->inicio_contrato);
            $sheet->setCellValue('C' . $row, $afocat->inicio_contrato);
            $sheet->setCellValue('D' . $row, $afocat->fin_contrato);
            $sheet->setCellValue('E' . $row, $afocat->numero_certificado);
            $sheet->setCellValue('F' . $row, $afocat->paterno." ".$afocat->materno." ".$afocat->nombre);
            $sheet->setCellValue('G' . $row, $afocat->dni." ".$afocat->ruc);
            $sheet->setCellValue('H' . $row, $afocat->placa);
            $sheet->setCellValue('I' . $row, $afocat->provincia);
            $sheet->setCellValue('J' . $row, $afocat->categoria);
            $sheet->setCellValue('K' . $row, $afocat->id_uso);
            $sheet->setCellValue('L' . $row, $afocat->clase);
            $sheet->setCellValue('M' . $row, $afocat->monto_total);
            $sheet->setCellValue('N' . $row, $afocat->categoria);
            $sheet->setCellValue('O' . $row, $afocat->categoria);
            $sheet->setCellValue('P' . $row, $afocat->id_uso);

            $row++;
        }

        // Ajustar automáticamente el tamaño de las columnas
        foreach (range('A', 'P') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
        // Establecer estilo para las celdas de nombre y correo electrónico
        $contentStyle = [
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A4:B' . ($row - 1))->applyFromArray($contentStyle);

        // Crear una respuesta de transmisión (streamed response)
        $response = new StreamedResponse(function () use ($spreadsheet) {
            // Definir el tipo de contenido y el encabezado para la descarga
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="reporte.xlsx"');
            header('Cache-Control: max-age=0');

            // Crear el escritor para generar el archivo Excel
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });
    
        // Devolver la respuesta de transmisión (streamed response)
        return $response;
    }

    public function exportMensual(Request $request)
    {
       // return $request;
        // Crear un nuevo objeto Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Personalizar el contenido del reporte
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Reporte Afiliados');

        // Establecer estilo y formato para el encabezado
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3366CC'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:B1')->applyFromArray($headerStyle);

        // Obtener los datos de la tabla 'users'
        // $users = DB::table('users')->select('name', 'email')->get();
        $afocats = DB::table('afocats')
        ->select('*')
        ->join('vehiculos', 'afocats.id_vehiculo', '=', 'vehiculos.id')
        ->join('afiliados', 'vehiculos.id_afiliado', '=', 'afiliados.id')
        ->whereYear('inicio_contrato', '=', $request->anioMensual)
        ->whereMonth('inicio_contrato', '=', $request->mesMensual)
        ->get();

        // Agregar los datos al reporte
        // Agregar los datos al reporte
        $datos = ['NRO ORDEN', 'FECHA DE EMISION', 'FECHA DE INICIO', 'FECHA DE FIN', 'NRO. CAT', 'APELLIDOS Y NOMBRES', 'DNI/RUC', 'PLACA DE RODAJE', 'ZONA GEOGRÁFICA', 'CATEGORIA DEL VEHICULO', 'USO VEH.', 'CLASE DE VEHICULO', 'VALOR DEL CAT', 'APORTE DE RIESGO', 'APORTE PARA GASTO ADM', 'APORTE EXTRAORDINARIO'];

        $columnaInicial = 'A';
        $filaInicial = 3;
        
        foreach ($datos as $index => $valor) {
            $columna = chr(ord($columnaInicial) + $index);
            $celda = $columna . $filaInicial;
            $sheet->setCellValue($celda, $valor);
        }
        // Establecer estilo para las celdas de encabezado
        $headerCellStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3366CC'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $columnaInicial = 'A';
        $columnaFinal = chr(ord($columnaInicial) + count($datos) - 1);
        $rango = $columnaInicial . '3:' . $columnaFinal . '3';

        $sheet->getStyle($rango)->applyFromArray($headerCellStyle);

        $row = 4;
        foreach ($afocats as $afocat) {
            $sheet->setCellValue('A' . $row, $afocat->id);
            $sheet->setCellValue('B' . $row, $afocat->inicio_contrato);
            $sheet->setCellValue('C' . $row, $afocat->inicio_contrato);
            $sheet->setCellValue('D' . $row, $afocat->fin_contrato);
            $sheet->setCellValue('E' . $row, $afocat->numero_certificado);
            $sheet->setCellValue('F' . $row, $afocat->paterno." ".$afocat->materno." ".$afocat->nombre);
            $sheet->setCellValue('G' . $row, $afocat->dni." ".$afocat->ruc);
            $sheet->setCellValue('H' . $row, $afocat->placa);
            $sheet->setCellValue('I' . $row, $afocat->provincia);
            $sheet->setCellValue('J' . $row, $afocat->categoria);
            $sheet->setCellValue('K' . $row, $afocat->id_uso);
            $sheet->setCellValue('L' . $row, $afocat->clase);
            $sheet->setCellValue('M' . $row, $afocat->monto_total);
            $sheet->setCellValue('N' . $row, $afocat->categoria);
            $sheet->setCellValue('O' . $row, $afocat->categoria);
            $sheet->setCellValue('P' . $row, $afocat->id_uso);

            $row++;
        }

        // Ajustar automáticamente el tamaño de las columnas
        foreach (range('A', 'P') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Establecer estilo para las celdas de nombre y correo electrónico
        $contentStyle = [
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A4:B' . ($row - 1))->applyFromArray($contentStyle);

        // Crear una respuesta de transmisión (streamed response)
        $response = new StreamedResponse(function () use ($spreadsheet) {
            // Definir el tipo de contenido y el encabezado para la descarga
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="reporte.xlsx"');
            header('Cache-Control: max-age=0');

            // Crear el escritor para generar el archivo Excel
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });
    
        // Devolver la respuesta de transmisión (streamed response)
        return $response;
    }

    public function exportAnual(Request $request)
    {
        //return $request;
        // Crear un nuevo objeto Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Personalizar el contenido del reporte
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Reporte Afiliados');

        // Establecer estilo y formato para el encabezado
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3366CC'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:B1')->applyFromArray($headerStyle);

        // Obtener los datos de la tabla 'users'
        // $users = DB::table('users')->select('name', 'email')->get();
        $afocats = DB::table('afocats')
        ->select('*')
        ->join('vehiculos', 'afocats.id_vehiculo', '=', 'vehiculos.id')
        ->join('afiliados', 'vehiculos.id_afiliado', '=', 'afiliados.id')
        ->whereYear('inicio_contrato', '=', $request->anioMensual)
        ->get();

        // Agregar los datos al reporte
        // Agregar los datos al reporte
        $sheet->setCellValue('A3', 'Nombre');
        $sheet->setCellValue('B3', 'Correo electrónico');

        // Establecer estilo para las celdas de encabezado
        $headerCellStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3366CC'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $datos = ['NRO ORDEN', 'FECHA DE EMISION', 'FECHA DE INICIO', 'FECHA DE FIN', 'NRO. CAT', 'APELLIDOS Y NOMBRES', 'DNI/RUC', 'PLACA DE RODAJE', 'ZONA GEOGRÁFICA', 'CATEGORIA DEL VEHICULO', 'USO VEH.', 'CLASE DE VEHICULO', 'VALOR DEL CAT', 'APORTE DE RIESGO', 'APORTE PARA GASTO ADM', 'APORTE EXTRAORDINARIO'];

        $columnaInicial = 'A';
        $filaInicial = 3;
        
        foreach ($datos as $index => $valor) {
            $columna = chr(ord($columnaInicial) + $index);
            $celda = $columna . $filaInicial;
            $sheet->setCellValue($celda, $valor);
        }
        // Establecer estilo para las celdas de encabezado
        $headerCellStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3366CC'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $columnaInicial = 'A';
        $columnaFinal = chr(ord($columnaInicial) + count($datos) - 1);
        $rango = $columnaInicial . '3:' . $columnaFinal . '3';

        $sheet->getStyle($rango)->applyFromArray($headerCellStyle);

        $row = 4;
        foreach ($afocats as $afocat) {
            $sheet->setCellValue('A' . $row, $afocat->id);
            $sheet->setCellValue('B' . $row, $afocat->inicio_contrato);
            $sheet->setCellValue('C' . $row, $afocat->inicio_contrato);
            $sheet->setCellValue('D' . $row, $afocat->fin_contrato);
            $sheet->setCellValue('E' . $row, $afocat->numero_certificado);
            $sheet->setCellValue('F' . $row, $afocat->paterno." ".$afocat->materno." ".$afocat->nombre);
            $sheet->setCellValue('G' . $row, $afocat->dni." ".$afocat->ruc);
            $sheet->setCellValue('H' . $row, $afocat->placa);
            $sheet->setCellValue('I' . $row, $afocat->provincia);
            $sheet->setCellValue('J' . $row, $afocat->categoria);
            $sheet->setCellValue('K' . $row, $afocat->id_uso);
            $sheet->setCellValue('L' . $row, $afocat->clase);
            $sheet->setCellValue('M' . $row, $afocat->monto_total);
            $sheet->setCellValue('N' . $row, $afocat->categoria);
            $sheet->setCellValue('O' . $row, $afocat->categoria);
            $sheet->setCellValue('P' . $row, $afocat->id_uso);

            $row++;
        }

        // Ajustar automáticamente el tamaño de las columnas
        foreach (range('A', 'P') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Establecer estilo para las celdas de nombre y correo electrónico
        $contentStyle = [
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A4:B' . ($row - 1))->applyFromArray($contentStyle);

        // Crear una respuesta de transmisión (streamed response)
        $response = new StreamedResponse(function () use ($spreadsheet) {
            // Definir el tipo de contenido y el encabezado para la descarga
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="reporte.xlsx"');
            header('Cache-Control: max-age=0');

            // Crear el escritor para generar el archivo Excel
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });
    
        // Devolver la respuesta de transmisión (streamed response)
        return $response;
    }

    public function siniestrosPagados(){
        $accidentesPagados = DB::table('accidentados')
        ->join('gastos', 'accidentados.id_gasto', '=', 'gastos.id')
        ->join('accidentado_gastos', 'accidentados.id', '=', 'accidentado_gastos.id_accidentado')
        ->join('tipo_pagos', 'accidentado_gastos.id_tipo_pago', 'tipo_pagos.id')
        ->join('accidentes','accidentes.id','=','accidentados.id_accidente')
        ->select('accidentados.*','tipo_pagos.nombre as tipoPago', 'accidentes.ubicacion','gastos.nombre as gasto', 'gastos.monto as deuda', 'accidentado_gastos.monto_pagado', DB::raw('(gastos.monto - accidentado_gastos.monto_pagado) as saldo'))
        ->whereRaw('accidentado_gastos.monto_pagado >= gastos.monto')
        ->get();

        return \DataTables::of($accidentesPagados)->make('true');
    }

    public function siniestrosporPagar(){
        $accidentesPorPagar = DB::table('accidentados')
        ->join('gastos', 'accidentados.id_gasto', '=', 'gastos.id')
        ->join('accidentado_gastos', 'accidentados.id', '=', 'accidentado_gastos.id_accidentado')
        ->join('tipo_pagos', 'accidentado_gastos.id_tipo_pago', '=', 'tipo_pagos.id')
        ->join('accidentes', 'accidentes.id', '=', 'accidentados.id_accidente')
        ->select('accidentados.*', 'tipo_pagos.nombre as tipoPago', 'accidentes.ubicacion', 'gastos.nombre as gasto', 'gastos.monto as deuda', 'accidentado_gastos.monto_pagado', DB::raw('(gastos.monto - accidentado_gastos.monto_pagado) as saldo'))
        ->whereRaw('accidentado_gastos.monto_pagado < gastos.monto')
        ->get();

        return \DataTables::of($accidentesPorPagar)->make('true');

    }

    public function exportContableDiario(){
        // Paso 1: Obtener los datos de ingresos y gastos desde las tablas "accidentados_gastos" y "afiliados"
        // $gastos = DB::table('accidentado_gastos')
        // ->join('accidentados', 'accidentado_gastos.id_accidentado', '=', 'accidentados.id')
        // ->join('gastos', 'accidentados.id_gasto', '=', 'gastos.id')
        // ->select('accidentado_gastos.id', 'accidentado_gastos.monto_pagado', 'accidentado_gastos.fecha_pago', 'accidentado_gastos.hora', 'gastos.nombre as gasto')
        // ->get();

        // $ingresos = DB::table('afocats')
        // ->join('productos', 'afocats.id_producto', '=', 'productos.id')
        // ->join('pagos', 'afocats.id_pago', '=', 'pagos.id')
        // ->select('afocats.id','afocats.hora', 'afocats.inicio_contrato', 'afocats.fin_contrato', 'afocats.monto_total', 'productos.nombre as nombre_producto', 'pagos.tipo as tipo_pago')
        // ->get();

        $date = date('Y-m-d');

        $gastos = DB::table('accidentado_gastos')
            ->join('accidentados', 'accidentado_gastos.id_accidentado', '=', 'accidentados.id')
            ->join('gastos', 'accidentados.id_gasto', '=', 'gastos.id')
            ->select('accidentado_gastos.id', 'accidentado_gastos.monto_pagado', 'accidentado_gastos.fecha_pago', 'accidentado_gastos.hora', 'gastos.nombre as gasto')
            ->whereDate('accidentado_gastos.fecha_pago', $date)
            ->get();

        $ingresos = DB::table('afocats')
            ->join('productos', 'afocats.id_producto', '=', 'productos.id')
            ->join('pagos', 'afocats.id_pago', '=', 'pagos.id')
            ->select('afocats.id', 'afocats.hora', 'afocats.inicio_contrato', 'afocats.fin_contrato', 'afocats.monto_total', 'productos.nombre as nombre_producto', 'pagos.tipo as tipo_pago')
            ->whereDate('afocats.inicio_contrato', $date)
            ->get();
                      
       // return $ingresos;
        // Paso 2: Preparar los datos para el reporte contable

        $totalIngresos = $ingresos->sum('monto_total');
        $totalGastos = $gastos->sum('monto_pagado');

        $diferencia = $totalIngresos - $totalGastos;
        // return   $totalIngresos." -  ".$totalGastos." =  ".$saldo;

        $datosReporte = [];

        foreach ($gastos as $gasto) {
            $datosReporte[] = [
                'ID' => $gasto->id,
                'Fecha Pago' => $gasto->fecha_pago,
                'Hora' => $gasto->hora,
                'Concepto' => $gasto->gasto,
                'Ingreso' => '',
                'Gasto' => $gasto->monto_pagado,
            ];
        }

        foreach ($ingresos as $ingreso) {
            $datosReporte[] = [
                'ID' => $ingreso->id,
                'Fecha Pago' => $ingreso->inicio_contrato,
                'Hora' => $ingreso->hora,
                'Concepto' => $ingreso->nombre_producto,
                'Ingreso' => $ingreso->monto_total,
                'Gasto' => '',
            ];
        }

        // Paso 3: Generar el reporte contable en Excel utilizando la librería PhpOffice\PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer encabezados
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Fecha Pago');
        $sheet->setCellValue('C1', 'Hora');
        $sheet->setCellValue('D1', 'Concepto');
        $sheet->setCellValue('E1', 'Ingreso');
        $sheet->setCellValue('F1', 'Gasto');


        $headerCellStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3366CC'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $columnaInicial = 'A';
        $columnaFinal = chr(ord($columnaInicial) + 6 - 1);
        $rango = $columnaInicial . '1:' . $columnaFinal . '1';

        $sheet->getStyle($rango)->applyFromArray($headerCellStyle);

        // Establecer datos
        $row = 2;
        foreach ($datosReporte as $dato) {
            $sheet->setCellValue('A' . $row, $dato['ID']);
            $sheet->setCellValue('B' . $row, $dato['Fecha Pago']);
            $sheet->setCellValue('C' . $row, $dato['Hora']);
            $sheet->setCellValue('D' . $row, $dato['Concepto']);
            $sheet->setCellValue('E' . $row, $dato['Ingreso']);
            $sheet->setCellValue('F' . $row, $dato['Gasto']);
            $row++;
        }
        // Guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $nombreArchivo = 'reporte_contable_sbs.xlsx';
        $writer->save($nombreArchivo);

        $lastRow = $sheet->getHighestRow();

        $sheet->setCellValue('E' . ($lastRow + 2), 'Total Ingresos:');
        $sheet->setCellValue('F' . ($lastRow + 2), $totalIngresos);
        $sheet->setCellValue('E' . ($lastRow + 3), 'Total Gastos:');
        $sheet->setCellValue('F' . ($lastRow + 3), $totalGastos);
        $sheet->setCellValue('E' . ($lastRow + 4), 'Diferencia:');
        $sheet->setCellValue('F' . ($lastRow + 4), $diferencia);

        // Ajustar automáticamente el tamaño de las columnas
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
        // Establecer estilo para las celdas de nombre y correo electrónico
        $contentStyle = [
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A2:F' . ($row - 1))->applyFromArray($contentStyle);
        // Descargar el archivo Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function exportContableMensual(Request $request){
      
        $month = date('m');

        $gastos = DB::table('accidentado_gastos')
            ->join('accidentados', 'accidentado_gastos.id_accidentado', '=', 'accidentados.id')
            ->join('gastos', 'accidentados.id_gasto', '=', 'gastos.id')
            ->select('accidentado_gastos.id', 'accidentado_gastos.monto_pagado', 'accidentado_gastos.fecha_pago', 'accidentado_gastos.hora', 'gastos.nombre as gasto')
            //->whereMonth('accidentado_gastos.fecha_pago', $month)
            ->whereYear('accidentado_gastos.fecha_pago', '=', $request->anioMensual)
            ->whereMonth('accidentado_gastos.fecha_pago', '=', $request->mesMensual)
            ->get();
        
        $ingresos = DB::table('afocats')
            ->join('productos', 'afocats.id_producto', '=', 'productos.id')
            ->join('pagos', 'afocats.id_pago', '=', 'pagos.id')
            ->select('afocats.id', 'afocats.hora', 'afocats.inicio_contrato', 'afocats.fin_contrato', 'afocats.monto_total', 'productos.nombre as nombre_producto', 'pagos.tipo as tipo_pago')
            //->whereMonth('afocats.inicio_contrato', $month)
            ->whereYear('afocats.inicio_contrato', '=', $request->anioMensual)
            ->whereMonth('afocats.inicio_contrato', '=', $request->mesMensual)
            ->get();    
       // return $ingresos;
        // Paso 2: Preparar los datos para el reporte contable

        $totalIngresos = $ingresos->sum('monto_total');
        $totalGastos = $gastos->sum('monto_pagado');

        $diferencia = $totalIngresos - $totalGastos;
        // return   $totalIngresos." -  ".$totalGastos." =  ".$saldo;

        $datosReporte = [];

        foreach ($gastos as $gasto) {
            $datosReporte[] = [
                'ID' => $gasto->id,
                'Fecha Pago' => $gasto->fecha_pago,
                'Hora' => $gasto->hora,
                'Concepto' => $gasto->gasto,
                'Ingreso' => '',
                'Gasto' => $gasto->monto_pagado,
            ];
        }

        foreach ($ingresos as $ingreso) {
            $datosReporte[] = [
                'ID' => $ingreso->id,
                'Fecha Pago' => $ingreso->inicio_contrato,
                'Hora' => $ingreso->hora,
                'Concepto' => $ingreso->nombre_producto,
                'Ingreso' => $ingreso->monto_total,
                'Gasto' => '',
            ];
        }

        // Paso 3: Generar el reporte contable en Excel utilizando la librería PhpOffice\PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer encabezados
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Fecha Pago');
        $sheet->setCellValue('C1', 'Hora');
        $sheet->setCellValue('D1', 'Concepto');
        $sheet->setCellValue('E1', 'Ingreso');
        $sheet->setCellValue('F1', 'Gasto');


        $headerCellStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3366CC'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $columnaInicial = 'A';
        $columnaFinal = chr(ord($columnaInicial) + 6 - 1);
        $rango = $columnaInicial . '1:' . $columnaFinal . '1';

        $sheet->getStyle($rango)->applyFromArray($headerCellStyle);

        // Establecer datos
        $row = 2;
        foreach ($datosReporte as $dato) {
            $sheet->setCellValue('A' . $row, $dato['ID']);
            $sheet->setCellValue('B' . $row, $dato['Fecha Pago']);
            $sheet->setCellValue('C' . $row, $dato['Hora']);
            $sheet->setCellValue('D' . $row, $dato['Concepto']);
            $sheet->setCellValue('E' . $row, $dato['Ingreso']);
            $sheet->setCellValue('F' . $row, $dato['Gasto']);
            $row++;
        }
        // Guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $nombreArchivo = 'reporte_contable_sbs.xlsx';
        $writer->save($nombreArchivo);

        $lastRow = $sheet->getHighestRow();

        $sheet->setCellValue('E' . ($lastRow + 2), 'Total Ingresos:');
        $sheet->setCellValue('F' . ($lastRow + 2), $totalIngresos);
        $sheet->setCellValue('E' . ($lastRow + 3), 'Total Gastos:');
        $sheet->setCellValue('F' . ($lastRow + 3), $totalGastos);
        $sheet->setCellValue('E' . ($lastRow + 4), 'Diferencia:');
        $sheet->setCellValue('F' . ($lastRow + 4), $diferencia);

        // Ajustar automáticamente el tamaño de las columnas
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
        // Establecer estilo para las celdas de nombre y correo electrónico
        $contentStyle = [
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A2:F' . ($row - 1))->applyFromArray($contentStyle);
        // Descargar el archivo Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function exportContableAnual(Request $request){
  
           
        //$year = date('Y');

        $gastos = DB::table('accidentado_gastos')
            ->join('accidentados', 'accidentado_gastos.id_accidentado', '=', 'accidentados.id')
            ->join('gastos', 'accidentados.id_gasto', '=', 'gastos.id')
            ->select('accidentado_gastos.id', 'accidentado_gastos.monto_pagado', 'accidentado_gastos.fecha_pago', 'accidentado_gastos.hora', 'gastos.nombre as gasto')
            ->whereYear('accidentado_gastos.fecha_pago', $request->anioMensual)
            ->get();
        
        $ingresos = DB::table('afocats')
            ->join('productos', 'afocats.id_producto', '=', 'productos.id')
            ->join('pagos', 'afocats.id_pago', '=', 'pagos.id')
            ->select('afocats.id', 'afocats.hora', 'afocats.inicio_contrato', 'afocats.fin_contrato', 'afocats.monto_total', 'productos.nombre as nombre_producto', 'pagos.tipo as tipo_pago')
            ->whereYear('afocats.inicio_contrato', $request->anioMensual)
            ->get();
               
       // return $ingresos;
        // Paso 2: Preparar los datos para el reporte contable

        $totalIngresos = $ingresos->sum('monto_total');
        $totalGastos = $gastos->sum('monto_pagado');

        $diferencia = $totalIngresos - $totalGastos;
        // return   $totalIngresos." -  ".$totalGastos." =  ".$saldo;

        $datosReporte = [];

        foreach ($gastos as $gasto) {
            $datosReporte[] = [
                'ID' => $gasto->id,
                'Fecha Pago' => $gasto->fecha_pago,
                'Hora' => $gasto->hora,
                'Concepto' => $gasto->gasto,
                'Ingreso' => '',
                'Gasto' => $gasto->monto_pagado,
            ];
        }

        foreach ($ingresos as $ingreso) {
            $datosReporte[] = [
                'ID' => $ingreso->id,
                'Fecha Pago' => $ingreso->inicio_contrato,
                'Hora' => $ingreso->hora,
                'Concepto' => $ingreso->nombre_producto,
                'Ingreso' => $ingreso->monto_total,
                'Gasto' => '',
            ];
        }

        // Paso 3: Generar el reporte contable en Excel utilizando la librería PhpOffice\PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer encabezados
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Fecha Pago');
        $sheet->setCellValue('C1', 'Hora');
        $sheet->setCellValue('D1', 'Concepto');
        $sheet->setCellValue('E1', 'Ingreso');
        $sheet->setCellValue('F1', 'Gasto');


        $headerCellStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3366CC'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $columnaInicial = 'A';
        $columnaFinal = chr(ord($columnaInicial) + 6 - 1);
        $rango = $columnaInicial . '1:' . $columnaFinal . '1';

        $sheet->getStyle($rango)->applyFromArray($headerCellStyle);

        // Establecer datos
        $row = 2;
        foreach ($datosReporte as $dato) {
            $sheet->setCellValue('A' . $row, $dato['ID']);
            $sheet->setCellValue('B' . $row, $dato['Fecha Pago']);
            $sheet->setCellValue('C' . $row, $dato['Hora']);
            $sheet->setCellValue('D' . $row, $dato['Concepto']);
            $sheet->setCellValue('E' . $row, $dato['Ingreso']);
            $sheet->setCellValue('F' . $row, $dato['Gasto']);
            $row++;
        }
        // Guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $nombreArchivo = 'reporte_contable_sbs.xlsx';
        $writer->save($nombreArchivo);

        $lastRow = $sheet->getHighestRow();

        $sheet->setCellValue('E' . ($lastRow + 2), 'Total Ingresos:');
        $sheet->setCellValue('F' . ($lastRow + 2), $totalIngresos);
        $sheet->setCellValue('E' . ($lastRow + 3), 'Total Gastos:');
        $sheet->setCellValue('F' . ($lastRow + 3), $totalGastos);
        $sheet->setCellValue('E' . ($lastRow + 4), 'Diferencia:');
        $sheet->setCellValue('F' . ($lastRow + 4), $diferencia);

        // Ajustar automáticamente el tamaño de las columnas
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
        // Establecer estilo para las celdas de nombre y correo electrónico
        $contentStyle = [
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A2:F' . ($row - 1))->applyFromArray($contentStyle);
        // Descargar el archivo Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
