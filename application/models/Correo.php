<?php

defined('BASEPATH') or exit('No direct script access allowed');

require "vendor/phpmailer/phpmailer/class.phpmailer.php";
require "vendor/phpmailer/phpmailer/class.smtp.php";

class Correo extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    public function enviar($correo, $asunto, $cuerpo)
    {

        //Create a new PHPMailer instance
        $mail = new PHPMailer;


        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0; // cuando todo funcione bien, poner en 0 para que no muestre mensajes internos.
        //Set the hostname of the mail server
        $mail->Host = 'ieslamarisma.net';
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 25;
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        $mail->Username = 'daw2@ieslamarisma.net';
        //Password to use for SMTP authentication
        $mail->Password = 'NM4599WEN76-uyt56';
        //Set who the message is to be sent from
        $mail->setFrom('daw2@ieslamarisma.net', 'mensaje desde ieslamarismat');
        //Set an alternative reply-to address
        // $mail->addReplyTo('replyto@example.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress($correo, "cliente libreria-online");
        //Set the subject line
        $mail->Subject = $asunto;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML($cuerpo);
        $mail->msgHTML($cuerpo);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'Contenido del mensaje';
        //Attach an image file
        // $mail->addAttachment( base_url() . 'documento.pdf'); ver por que no puedo adjuntar ficheros
        //send the message, check for errors
        if ($mail->send()) {
            return true;
        } else {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        }
    }



    public function enviarFactura($correo, $asunto, $cuerpo, $fichero)
    {

        //Create a new PHPMailer instance
        $mail = new PHPMailer;


        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0; // cuando todo funcione bien, poner en 0 para que no muestre mensajes internos.
        //Set the hostname of the mail server
        $mail->Host = 'ieslamarisma.net';
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 25;
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        $mail->Username = 'daw2@ieslamarisma.net';
        //Password to use for SMTP authentication
        $mail->Password = 'NM4599WEN76-uyt56';
        //Set who the message is to be sent from
        $mail->setFrom('daw2@ieslamarisma.net', 'Pedido realizado, Libreria la marisma');
        //Set an alternative reply-to address
        // $mail->addReplyTo('replyto@example.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress($correo, "cliente libreria-online");
        //Set the subject line
        $mail->Subject = $asunto;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML($cuerpo);
        $mail->isHTML(true);
         
        $mail->msgHTML($cuerpo);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'Pedido realizado';
        //Attach an image file
        $mail->addStringAttachment($fichero, "factura.pdf");
        // Comprueba que se haya enviado
        if ($mail->send()) {
            return true;
        } else {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        }
    }
}
