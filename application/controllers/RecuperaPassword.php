<?php
defined('BASEPATH') or exit('No direct script access allowed');

require "vendor/phpmailer/phpmailer/class.phpmailer.php";
require "vendor/phpmailer/phpmailer/class.smtp.php";

class RecuperaPassword extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
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

    public function exists_email($correo)
    {

        $condiciones = array(
            "baja" => 0,
            "correo" => $correo
        );

        if ($this->usuario->buscar($condiciones)) {
            return true;
        } else {
            return false;
        }
    }

    public function cambiar($correo, $token)
    {

        // 4ª Si todo ha salido bien, obtengo el correo que acaba de introducir, comparo que sean iguales y no se haya confundido al escribirlos y actualizo la contraseña con cifrado md5
        // Elimino el token.

        // 1º Verificar que se nos envia el correo y el token, sino estan muestro otra vez la ventana de envio de correo para solicitar el passoword.
        if (empty(trim($correo)) or empty(trim($token))) { // Crear una funcion helper para comprobar si un campo esta vacio
            echo "algun parametro, correo o token estan vacios";
            // Envio al usuario a la ventan anterior, donde se le solicita el correo a donde enviar el e-mail para restaurar la contraseña.
            $this->load->view('formularioOlvidePassword');
        } else {

            echo "Recibo correo: $correo y el token: $token <br>";

            $condiciones = array(
                "baja" => 0,
                "correo" => $correo,
                "token" => $token
            );

            // Guardo los datos en una sesion como metodo temporal para la persistencia de datos.
            // Creo la sesion
            $this->session->set_userdata("password", $condiciones);
            // Redirecciono al usuario a la pagina principal.

            // 2º Comprobar que el correo y el token pertenecen al usuario que nos solicita el cambio de contraseña.
            if ($this->usuario->buscar($condiciones)) {
                echo "El correo y el token coinciden, pertenecen al usuario que solicita el cambio de password. <br>";
                // 3º Muestro la vista para cambiar la contraseña, le paso el correo y el token a la vista, los cuales iran en dos input text de tipo hidden.
                $this->load->view('formularioIntroduceNuevoPassword', $condiciones);
            } else {
                echo "El correo y el token, no pertenecen al mismo usuario, lo envio al formulario anterior y mostraria un menaje de error.";
                $this->load->view('formularioOlvidePassword');
            }
        }
    }


    public function actualizar()
    {

        // Obtengo la contraseña introducida.
        $password1 = $this->input->post("password1");
        $password2 = $this->input->post("password2");

        // Obtengo el valor de los campos del formulario restablece password, los campos ocultos token y correo.
        $correo = $this->input->post("correo");
        $token =  $this->input->post("token");

        // Obtengo los datos de la sesion recovery password.
        $sesion = $this->session->userdata("password");

        // Los valores que nos envio el usuarios tras hacer click sobre el en lace que le enviamos por correo, son los datos originales, los correctos.
        $correo2 = $sesion["correo"];
        $token2 = $sesion["token"];

        $condiciones = array(
            "baja" => 0,
            "correo" => $correo2,
            "token" =>  $token2
        );

        // Compruebo que las contraseñas coincidan y no se haya equivocado el usuario
        if ($password1 === $password2) {
            echo "Contraseñas iguales, ok <br>";
            if ($correo === $correo2 and $token === $token2) {
                echo "el correo y el token coinciden, actualizo la contraseña del usuario <br>";
                $columnas = array(
                    "contraseña" => md5($password1),
                    "token" => "0"
                );
                if ($this->usuario->restablecePassword($columnas, $condiciones)) {
                    echo "Acabas de actualizar la contraseña";
                    $this->load->view("formularioLogin");
                } else {
                    $condiciones["mensajeDeError"] = "No se ha podido cambiar la contraseña";
                    $this->load->view('formularioIntroduceNuevoPassword', $condiciones);
                }
            } else {
                $condiciones["mensajeDeError"] = "El correo y el token original no coinciden con los valores del campo, han sido modificados";
                $this->load->view('formularioIntroduceNuevoPassword', $condiciones);
            }
        } else {
            echo "las contraseñas no coinciden";
            $condiciones["mensajeDeError"] = "No coinciden las contraseñas.";
            $this->load->view('formularioIntroduceNuevoPassword', $condiciones);
        }
    }

    public function cuenta()
    {

        if ($this->validar()) {
            // Obtengo el correo introducido.
            $correo = $this->input->post("correo");
            $token = $this->generarToken($correo);

            if ($this->usuario->guardarToken($correo, $token)) {

                // SIMULO EL ENVIO DEL CORREO ELECTRONICO, CUANOD EL USUARIO PULSE EL ENLACE, IRA AL SIGUIENTE METODO $this->enviarCorreo();
                $this->cambiar($correo, $token);
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
        $mail->Subject = 'libreria';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML("<a href='https://ieslamarisma.net/proyectos/2019/joseluiscortes/RecuperaPassword/introduceNuevo'> Si quires cambiar tu contraseña, haz click aqui </a>");
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
