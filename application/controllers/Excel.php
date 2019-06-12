<?php
defined('BASEPATH') or exit('No direct script access allowed');

require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Excel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('categorias');
        $this->load->model("productos");
        $this->load->model("pedidos");
    }


    public function index()
    {

        //$this->exportarCategorias();
        //$this->exportarProductos();
        $this->exportarPedidos();
    }


    public function exportarPedidos()
    {

        // Obtengo todos los pedidos
        $pedidos = $this->pedidos->dameTodos();

        // Creo el objeto
        $spreadsheet = new Spreadsheet();

        // Añado las columnas
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IdPedido')
            ->setCellValue('B1', 'Fecha')
            ->setCellValue('C1', 'Nombre')
            ->setCellValue('D1', 'Apellidos')
            ->setCellValue('E1', 'Correo')
            ->setCellValue('F1', 'Dni')
            ->setCellValue('G1', 'Direccion')
            ->setCellValue('H1', 'Codigo postal')
            ->setCellValue('I1', 'Provincia')
            ->setCellValue('J1', 'Estado');

        // Ancho que tendran las columnas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);


        $fila = 2;

        for ($index = 0; $index < count($pedidos); $index++) {

            // Obtengo el identificador del pedido.
            $idPedido = $pedidos[$index]["idPedido"];

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $fila,  $idPedido)
                ->setCellValue('B' . $fila,  $pedidos[$index]["fecha"])
                ->setCellValue('C' . $fila,  $pedidos[$index]["nombre"])
                ->setCellValue('D' . $fila,  $pedidos[$index]["apellidos"])
                ->setCellValue('E' . $fila,  $pedidos[$index]["correo"])
                ->setCellValue('F' . $fila,  $pedidos[$index]["dni"])
                ->setCellValue('G' . $fila,  $pedidos[$index]["direccion"])
                ->setCellValue('H' . $fila,  $pedidos[$index]["codigoPostal"])
                ->setCellValue('I' . $fila,  $pedidos[$index]["provincia"])
                ->setCellValue('J' . $fila,  $pedidos[$index]["estado"]);


            // Obtengo su linea de pedido.
            $lineaPedido = $this->pedidos->dameLineaPedido($idPedido);

            foreach ($lineaPedido as $item) {
              
                $fila++;
                
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B' . $fila,  $item["nombre"])
                    ->setCellValue('C' . $fila,  $item["lpPrecio"] . "€")
                    ->setCellValue('D' . $fila,  $item["cantidad"])
                    ->setCellValue('E' . $fila, ($item["lpPrecio"] * $item["cantidad"]) . "€");

                 
               
            }
            $fila++;
        }


        // redirect output to client browser
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="pedidos.xls"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');

        $writer->save('php://output');
    }






    /**
     * Exporta las categorias a excel.
     *
     * @return void
     */
    public function exportarCategorias()
    {
        // Creo el objeto
        $spreadsheet = new Spreadsheet();

        // Informacion del documento
        $spreadsheet->getProperties()
            ->setCreator('Jose Luis')
            ->setLastModifiedBy('Jose')
            ->setTitle('Libreria')
            ->setSubject('PhpSpreadsheet Test Document')
            ->setDescription('Test document for PhpSpreadsheet, generated using PHP classes.')
            ->setKeywords('office PhpSpreadsheet php')
            ->setCategory('Test result file');

        // Añado las columnas
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IdCategoria')
            ->setCellValue('B1', 'Nombre')
            ->setCellValue('C1', 'Descripcion')
            ->setCellValue('D1', 'Anuncio')
            ->setCellValue('E1', 'Codigo')
            ->setCellValue('F1', 'Visible');

        // Ancho que tendran las columnas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(60);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

        // Inserto los datos dinamicamente
        $categorias = $this->categorias->dameTodasIncluidasLasInvisibles();

        for ($index = 0, $fila = 2; $index < count($categorias); $index++, $fila++) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $fila,  $categorias[$index]["idCategoria"])
                ->setCellValue('B' . $fila,  $categorias[$index]["nombre"])
                ->setCellValue('C' . $fila,  $categorias[$index]["descripcion"])
                ->setCellValue('D' . $fila,  $categorias[$index]["anuncio"])
                ->setCellValue('E' . $fila,  $categorias[$index]["codigo"])
                ->setCellValue('F' . $fila,  $categorias[$index]["visible"]);
        }




        // redirect output to client browser
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="categorias.xls"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');

        $writer->save('php://output');

        // $writer->save('excel/salida.xls');
    }



    /**
     * Exporta los productos a excel
     *
     * @return void
     */
    public function exportarProductos()
    {
        // Creo el objeto
        $spreadsheet = new Spreadsheet();

        // Informacion del documento
        $spreadsheet->getProperties()
            ->setCreator('Jose Luis')
            ->setLastModifiedBy('Jose')
            ->setTitle('Libreria')
            ->setSubject('PhpSpreadsheet Test Document')
            ->setDescription('Test document for PhpSpreadsheet, generated using PHP classes.')
            ->setKeywords('office PhpSpreadsheet php')
            ->setCategory('Test result file');

        // Añado las columnas
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'IdProducto')
            ->setCellValue('B1', 'Nombre')
            ->setCellValue('C1', 'imagen')
            ->setCellValue('D1', 'descripcion')
            ->setCellValue('E1', 'precio')
            ->setCellValue('F1', 'descuento')
            ->setCellValue('G1', 'iva')
            ->setCellValue('H1', 'stock')
            ->setCellValue('I1', 'isbn')
            ->setCellValue('J1', 'anuncio')
            ->setCellValue('K1', 'destacado')
            ->setCellValue('L1', 'desde')
            ->setCellValue('M1', 'hasta')
            ->setCellValue('N1', 'visible')
            ->setCellValue('O1', 'idCategoria');

        // Ancho que tendran las columnas
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(16);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(60);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(7);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(9);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->getWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);

        // Inserto los datos dinamicamente
        $productos = $this->productos->dameTodasIncluidasLasInvisibles();

        for ($index = 0, $fila = 2; $index < count($productos); $index++, $fila++) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $fila,  $productos[$index]["idProducto"])
                ->setCellValue('B' . $fila,  $productos[$index]["nombre"])
                ->setCellValue('C' . $fila,  $productos[$index]["imagen"])
                ->setCellValue('D' . $fila,  $productos[$index]["descripcion"])
                ->setCellValue('E' . $fila,  $productos[$index]["precio"] . "€")
                ->setCellValue('F' . $fila,  $productos[$index]["descuento"] . "%")
                ->setCellValue('G' . $fila,  $productos[$index]["iva"] . "%")
                ->setCellValue('H' . $fila,  $productos[$index]["stock"])
                ->setCellValue('I' . $fila,  $productos[$index]["isbn"])
                ->setCellValue('J' . $fila,  $productos[$index]["anuncio"])
                ->setCellValue('K' . $fila,  $productos[$index]["destacado"])
                ->setCellValue('L' . $fila,  $productos[$index]["desde"])
                ->setCellValue('M' . $fila,  $productos[$index]["hasta"])
                ->setCellValue('N' . $fila,  $productos[$index]["visible"])
                ->setCellValue('O' . $fila,  $productos[$index]["idCategoria"]);
        }


        // redirect output to client browser
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="productos.xls"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');

        $writer->save('php://output');

        // $writer->save('excel/salida.xls');
    }
} // Final clase
