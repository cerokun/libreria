<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'vendor/phpmailer/phpmailer/class.phpmailer.php';
require_once "vendor/phpmailer/phpmailer/class.smtp.php";
    

class RecuperaPassword extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->load->model('OlvidePassword');
        $this->load->model('usuario');
    }

    public function index()
    {
        $this->load->view('formularioOlvidePassword');
    }


    /**
     * Valida el correo.
     *
     * @return void
     */
    public function validar()
    {
        // Estado de la validacion, supongamos que la validacion no es correcta.
        $estado = false;
        // Quiero validar estos campos, segun diferentes tipos de validaciones.
        $this->form_validation->set_rules('correo', 'correo', 'required|valid_email|callback_exists_email');
        // El usuario no ha escrito el correo.
        $this->form_validation->set_message('required', 'introduce el correo, campo vacio.');
        // El correo introducido, no es valido, no cumple el formato.
        $this->form_validation->set_message('valid_email', 'el correo, no cumple un formato valido.');
        // El correo introducido, no se encuentra en la base de datos.
        $this->form_validation->set_message('exists_email', 'el correo, no existe.');

        // Si ha superado las validaciones
        if ($this->form_validation->run()) {
            $estado = true; // Cabmio el estado.
        }
        return $estado;
    }

    public function exists_email($valor)
    {

        if ($this->OlvidePassword->buscarCorreo($valor)) {
            return true;
        } else {
            return false;
        }
    }

    public function cuenta()
    {

        if ($this->validar()) {
            // Obtengo el correo introducido.
            $correo = $this->input->post("correo");
            $token = $this->generarToken($correo);

            if ($this->usuario->guardarToken($correo, $token)) {
                echo "token actualizado envio el correo al usuario";
                $this->enviarCorreo();
            }
        } else {
            $this->load->view('formularioOlvidePassword');
        }
    }


    public function generarToken($valor)
    {
        $fechaActual = date('Y-m-d H:i:s');
        return md5($fechaActual . $valor);
    }


    public function enviarCorreo()
    {
      
        //Create a new PHPMailer instance
        $mail = new PHPMailer;


        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2; // cuando todo funcione bien, poner en 0 para que no muestre mensajes internos.
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
        $mail->setFrom('daw2@ieslamarisma.net', 'mensaje de test de ieslamarismat');
        //Set an alternative reply-to address
        // $mail->addReplyTo('replyto@example.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress('joseluiscortesrapela.jl@gmail.com', 'Jose luis');
        //Set the subject line
        $mail->Subject = 'PHPMailer SMTP ejemplo';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML("hola");
        //Replace the plain text body with one created manually
        $mail->AltBody = 'Contenido del mensaje';
        //Attach an image file
        // $mail->addAttachment( base_url() . 'documento.pdf'); ver por que no puedo adjuntar ficheros
        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Email enviado correctamente!';
        }
    }
} // Final clase
