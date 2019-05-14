<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('registrarNuevoUsuario');
    }

    public function validar()
    {
        // Supongamos que los datos introducidos en el formulario, no superan las validaciones.
        $estado = false;

        // 1º Establezco las reglas de validacion.
        $this->form_validation->set_rules('usuario', 'usuario', 'required|trim');
        $this->form_validation->set_rules('contraseña', 'contraseña', 'required|trim');
        $this->form_validation->set_rules('correo', 'correo', 'required|valid_email');
        $this->form_validation->set_rules('nombre', 'nombre', 'required|trim');
        $this->form_validation->set_rules('apellidos', 'apellidos', 'required|trim');
        $this->form_validation->set_rules('dni', 'dni', 'callback_comprobarDni');
        $this->form_validation->set_rules('direccion', 'lugar der residencia', 'required|trim');
        $this->form_validation->set_rules('codigoPostal', 'codigo postal', 'required|exact_length[5]|numeric');
        $this->form_validation->set_rules("provincia", "provincia", "required");

        // 2º Establezco los mensajes que apareceran por cada regla de validacion.
        $this->form_validation->set_message('required', 'El campo %s es requerido.');
        $this->form_validation->set_message('valid_email', 'El campo %s debe de ser valido');
        $this->form_validation->set_message("comprobarDni", "El campo %s no es valido");
        $this->form_validation->set_message("numeric", "El campo %s debe de ser un valor numerico");
        $this->form_validation->set_message("exact_length", "El campo %s deben de ser exatamente %s valores.");

        // 3º Compruebo si los datos son correctos.
        if ($this->form_validation->run()) {
            // Cambio su estado, todo ok.
            $estado = true;
        }

        return $estado;
    } // End method validar()

    /**
     * Registra a un nuevo usuario.
     */
    public function comprobar()
    {

        if ($this->validar()) {

            // Almaceno los campos del formulario en un array asociativo.
            $columnas = array(
                "usuario" => $this->input->post("usuario"),
                "contraseña" => md5($this->input->post("contraseña")), // Encripto la contraseña
                "correo" => $this->input->post("correo"),
                "nombre" => $this->input->post("nombre"),
                "apellidos" => $this->input->post("apellidos"),
                "dni" => $this->input->post("dni"),
                "direccion" => $this->input->post("direccion"),
                "provincia" => $this->input->post("provincia"),
                "codigoPostal" => $this->input->post("codigoPostal"),
                "tipo" => "cliente"
            );

            if ($this->registrarNuevoUsuario->insertar($columnas)) {
                echo "acabas de registrate, ahora crearia la sesion para el usuario y lo redireccionaria al controlador principal, para que el cargue los datos del usuario";
            }
        } else { // El formulario, no ha pasado las validaciones de sus campos.
            $this->load->view("formularioRegistro");
        }
    } // End method comprobar()


    /**
     * Valida el dni
     * @param  string $dni numero nacional de identidad.
     * @return boolean  si es true, es un dni valido, sino es incorrecto.
     */
    function comprobarDni($dni)
    {

        // Variable de control, que utilizare para comprobar si el dni es correcto.
        $estado = true;
        // Todas las letras posibles de un dni
        $letras = array('T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T');
        // Extraigo los numeros
        $numero = substr($dni, 0, -1);
        // Extraigo el caracter de control
        $letra = substr($dni, -1);

        // Compruebo si la variable numeros son numeros y la variable letra es un caracter.
        if (is_numeric($numero) && is_string($letra)) {

            // Convierto a minusculas.
            $letra = strtoupper($letra);

            // Para que sea un dni valido, el numero debe de estar comprendido, entre los siguientes valores.
            if ($numero >= 0 && $numero <= 99999999) {

                // Obtengo la letra que le corresponderia a ese numero.
                $letraCorrecta = $letras[$numero % 23];
                // Si la letra correcta no es igual, que la letra introducida por el usuario.
                if ($letraCorrecta != $letra) {
                    $estado = false;
                }
            } else { // El numero introducido, no se encuentra entre el rango de valores permitidos.
                $estado = false;
            }
        } // Si el dni introducido no esta formado por 8 numeros seguidos de una letra.
        else {
            $estado = false;
        }


        return $estado;
    }
} // End method comprobarDni()
