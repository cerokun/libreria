 <?php

    defined('BASEPATH') or exit('No direct script access allowed');

    require "fpdf/fpdf.php";

    class PDF extends FPDF
    {

        // Page header
        function cabecera($imagen, $titulo)
        {
            // Logo
            $this->Image($imagen, 10, 6, 30);
            // Arial bold 15
            $this->SetFont('Arial', 'B', 15);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30, 10, $titulo, 1, 0, 'C');
            // Line break
            $this->Ln(20);
        }


        // Load data
        function LoadData($file)
        {
            // Read file lines
            $lines = file($file);
            $data = array();
            foreach ($lines as $line)
                $data[] = explode(';', trim($line));
            return $data;
        }


        // Colored table
        function FancyTable($header, $data)
        {
            // Colors, line width and bold font
            $this->SetFillColor(255, 0, 0);
            $this->SetTextColor(255);
            $this->SetDrawColor(128, 0, 0);
            $this->SetLineWidth(.3);
            $this->SetFont('', 'B');
            // Header
            $w = array(40, 35, 40, 45);
            for ($i = 0; $i < count($header); $i++)
                $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
            $this->Ln();
            // Color and font restoration
            $this->SetFillColor(224, 235, 255);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Data
            $fill = false;
            foreach ($data as $row) {
                $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
                $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
                $this->Ln();
                $fill = !$fill;
            }
            // Closing line
            $this->Cell(array_sum($w), 0, '', 'T');
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