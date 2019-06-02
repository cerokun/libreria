 <?php

    defined('BASEPATH') or exit('No direct script access allowed');

    require "fpdf/fpdf.php";

    class Factura extends FPDF
    {

        //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill )
        // Page header
        function cabecera($datos)
        {
            // Extraigo el contenido del array asociativo en variables.
            extract($datos);

            // Logo de la empresa
            $this->Image(base_url() . "assets/img/pagina/logo.png", 12, 6, 30);

            // Arial bold 15
            $this->SetFont('Times', 'B', 15);
            $this->SetX(90);
            // Numero de pedido.
            $this->Cell(50, 10, "Factura $idPedido");
            // Fecha pedido
            $this->Cell(44, 10, "Fecha: $fecha ");
            $this->Ln(15);
            // Cambio el tipo de letra, el tamaño y el estilo.
            $this->SetFont('Arial', '', 10);
            // Datos empresa
            $this->Cell(0, 5, "Avd Cristobal Colon 3");
            $this->Ln();
            $this->Cell(0, 5, "libreria@ieslamarisma.es");
            $this->ln();
            $this->Cell(0, 5, "Madrid, 25841");
            $this->Ln();
            $this->SetX(160);
            $this->SetFillColor(102, 102, 255);
            $this->Cell(44, 5, "Datos del cliente", 1, 2, "C", 1);
            $this->Cell(44, 5, "$nombre, $apellidos", 0, 2);
            $this->Cell(44, 5, "$dni", 0, 2);
            $this->Cell(44, 5, "$direccion", 0, 2);
            $this->Cell(44, 5, "$correo", 0, 2);
            $this->Cell(44, 5, "Cp: $codigoPostal", 0, 2);

            $this->Ln(20);
        }

        // Load data
        function LoadData($file)
        { }


        // Colored table
        function generarTabla($header, $data)
        {
            // Colors, line width and bold font
            $this->SetFillColor(255, 0, 0);
            $this->SetTextColor(255);
            $this->SetDrawColor(128, 0, 0);
            $this->SetLineWidth(.3);
            $this->SetFont('', 'B');
            // Header
            $w = array(15, 110, 15, 19, 10, 20);
            for ($i = 0; $i < count($header); $i++)
                $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
            $this->Ln();

            // Color and font restoration
            $this->SetFillColor(224, 235, 255);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Relleno
            $fill = false;
            // Aqui guardare el subtotal
            $subtotal = 0;

            // Recorro la lenea de pedido.
            foreach ($data as $row) {

                $this->Cell($w[0], 6, $row["idItem"], 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, utf8_decode($row["nombre"]), 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row["precio"], 'LR', 0, 'R', $fill);
                $this->Cell($w[3], 6, $row["cantidad"], 'LR', 0, 'R', $fill);
                $this->Cell($w[4], 6, $row["iva"], 'LR', 0, 'R', $fill);
                $this->Cell($w[5], 6, number_format($row["precio"] * $row["cantidad"]), 'LR', 0, 'R', $fill);

                $this->Ln();
                $fill = !$fill;
                // Calculo el subtotal
                $subtotal += $row["precio"] * $row["cantidad"];
            }
            // Cierra el borde de la tabla
            $this->Cell(array_sum($w), 0, '', 'T');
            $this->Ln();
            $this->Cell(10, 6, "Subtotal: $subtotal euros");
        }


        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }
    ?>