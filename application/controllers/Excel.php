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
    }


    public function index()
    {
        /*
        $misCategorias["categorias"] = $this->categorias->dameTodas();
        $this->load->view("plantillas/header", $misCategorias);
        $this->load->view("plantillas/nav");
        $this->load->view('formularioExcel');
        $this->load->view("plantillas/footer");
        */




        /*

        foreach ($categorias as $categoria) {
            echo $categoria["nombre"];
        }
*/
        $this->exportar();
    }


    public function exportar()
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
        header('Content-Disposition: attachment;filename="myfile.xls"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');

        $writer->save('php://output');

        // $writer->save('excel/salida.xls');
    }
} // Final clase
