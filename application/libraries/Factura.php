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

            $this->Image(base_url() . "assets/img/pagina/cabeceraFactura.png", 0, 0, 300);
            // Logo de la empresa
            $this->Image(base_url() . "assets/img/pagina/logo.png", 10, 2, 40);
            // Tipo de letra, negrita y tamaño
            $this->SetFont('Times', 'B', 25);
            // Color
            $this->SetTextColor(140, 114, 34);
            $this->SetX(90);
            // Color 
            $this->SetTextColor(140, 114, 34);
            // Numero de pedido.
            $this->Cell(50, 0, "Factura " .  utf8_decode("nº ") . "$idPedido", 0, 0, "C");
            // Tipo de letra, negrita y tamaño
            $this->SetFont('Times', '', 15);
            // Fecha pedido
            $this->Cell(0, 9, "Fecha: $fecha ");
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
            $this->SetX(150);
            $this->SetFillColor(102, 102, 255);
            $this->SetTextColor(14, 11, 34);
            $this->Cell(44, 5, "Datos del cliente " . $idUsuario, 1, 2, "C", 1);
            $this->Cell(44, 5, "$nombre, $apellidos", 0, 2);
            $this->Cell(44, 5, "$dni", 0, 2);
            $this->Cell(44, 5, "$direccion", 0, 2);
            $this->Cell(44, 5, "$correo", 0, 2);
            $this->Cell(44, 5, "Cp: $codigoPostal");

            $this->Ln(20);
        }

        // Colored table
        function generarTabla($header, $data)
        {

            // Simbolo de la moneda
            $divisa = iconv('UTF-8', 'windows-1252', "€");
            // Colors, line width and bold font
            $this->SetFillColor(49, 36, 36);
            $this->SetTextColor(255);
            $this->SetDrawColor(128, 0, 0);
            $this->SetLineWidth(.3);
            $this->SetFont('', 'B');
            // Header
            $w = array(15, 73, 26, 18, 20, 9, 20, 17);
            for ($i = 0; $i < count($header); $i++)
                $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
            $this->Ln();

            // Color and font restoration
            $this->SetFillColor(39, 125, 186);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Relleno
            $fill = false;
            // Aqui guardare el subtotal de cada producto, precio unitacio por cantidad menos descuento.
            $subtotalParcial = 0;
            // Aqui guardare todos los subtotales
            $subtotal = 0;
            // El total iva entre todos los productos.
            $impuestos = 0;

            // Recorro la lenea de pedido.
            foreach ($data as $row) {

                // Obtengo el precio por la cantidad, sin palicar descuento ni iva.
                $cantidadPorPrecioUnitario = $row["cantidad"] * $row["precio"];
                // Descuento sobre la cantidad por precio
                $descuento = ($cantidadPorPrecioUnitario  * $row["descuento"]) / 100;
                // Obtengo el subtotal, aplicando el descuento.
                $subtotalParcial = $cantidadPorPrecioUnitario - $descuento;
                // Obtengo el importe iva
                $importeIva = ($subtotalParcial * $row["iva"]) / 100;
                // Guardo los ivas parciales, para mostrar al final el total a pagar de impuestos entre todos los productos.
                $impuestos += $importeIva;

                $this->Cell($w[0], 6, $row["idItem"], 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, utf8_decode($row["nombre"]), 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row["precio"] . $divisa, 'LR', 0, 'R', $fill);
                $this->Cell($w[3], 6, $row["cantidad"], 'LR', 0, 'R', $fill);
                $this->Cell($w[4], 6, $row["descuento"] . "%", 'LR', 0, 'R', $fill);
                $this->Cell($w[5], 6, $row["iva"] . "%", 'LR', 0, 'R', $fill);
                $this->Cell($w[6], 6, $importeIva . "%", 'LR', 0, 'R', $fill);
                $this->Cell($w[7], 6, ($subtotalParcial + $importeIva) . $divisa, 'LR', 0, 'R', $fill);

                $this->Ln();
                $fill = !$fill;

                // Voy guardando la suma de los subtotales parciales.
                $subtotal += $subtotalParcial;  
            }

            // Cierra el borde de la tabla
            $this->Cell(array_sum($w), 0, '', 'T');
            $this->Ln();
            $this->SetX(173);
            $this->SetFont('', 'B');
            $this->Cell(150, 6, "Subtotales: $subtotal $divisa", 0, 2);
            $this->SetTextColor(255, 0, 0);
            $this->Cell(10, 6, "Impuestos: +$impuestos " . $divisa, 0, 2);
            $this->SetTextColor(128, 0, 128);
            // Calculo el total a pagar.
            // Muestro el total a pagar y con la funcion iconv muestro el icono del la moneda.
            $this->Cell(10, 6, "Total a pagar: " . ( $subtotal + $impuestos ) . $divisa );
        }


        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            $this->Image(base_url() . "assets/img/pagina/pieFactura.png", 0, 140, 300);
            $this->SetTextColor(255, 255, 255);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }
    ?>