<?php

class Registrar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        //$this->load->model( 'provincias' );
        $this->load->model( 'registrarNuevoUsuario' );
    }

  

    /**
     * Registra a un nuevo usuario.
     */
    public function comprobarRegistro() {


        // Establezco las reglas de validacion, el primer parametro, es el nombre del campo, no de la variable donde almaceno el valor recogido del formulario.
        $this->form_validation->set_rules( 'usuario', 'usuario', 'required|trim|max_length[14]' );
        $this->form_validation->set_rules( 'contraseña', 'contraseña', 'required|trim' );
        $this->form_validation->set_rules( 'correo', 'correo', 'required|valid_email|max_length[35]|trim' );
        $this->form_validation->set_rules( 'nombre', 'nombre', 'required|max_length[14]|trim' );
        $this->form_validation->set_rules( 'apellidos', 'apellidos', 'required|max_length[20]|trim' );
        $this->form_validation->set_rules( 'dni', 'dni', 'callback_comprobarDni' );
        $this->form_validation->set_rules( 'direccion', 'lugar der residencia', 'required|max_length[35]|trim' );
        $this->form_validation->set_rules( 'codigoPostal', 'codigo postal', 'required|exact_length[5]|numeric' );
        $this->form_validation->set_rules( "provincia", "provincia", "required|max_length[35]" );

        // Establezco los mensajes, para cada regla, estos se mostraran, siempre que las validaciones sean igual a false.
        $this->form_validation->set_message( 'required', 'El campo %s es requerido.' );
        $this->form_validation->set_message( 'min_length', 'El campo %s debe ser de un minimo de %s carácteres' );
        $this->form_validation->set_message( 'max_length', 'El campo %s debe ser de un maximo de %s carácteres' );
        $this->form_validation->set_message( 'valid_email', 'El campo %s debe de ser valido' );
        $this->form_validation->set_message( 'max_length', 'El campo %s debe ser de un maximo de %s carácteres' );
        $this->form_validation->set_message( "comprobarDni", "El campo %s no es valido" );
        $this->form_validation->set_message( "is_natural", "El campo %s debe de ser un numero natural ej. 1,2,3,4,5..." );
        $this->form_validation->set_message( "numeric", "El campo %s debe de ser un valor numerico" );
        $this->form_validation->set_message( "exact_length", "El campo %s deben de ser exatamente %s valores." );


        // Si los datos del formulario son correctos
        if ( $this->form_validation->run() ) {

            // Almaceno los campos del formulario en un array asociativo.
            $columnas = array(
                "usuario" => $this->input->post( "usuario" ),
                "contraseña" => md5( $this->input->post( "contraseña" ) ), // Encripto la contraseña
                "correo" => $this->input->post( "correo" ),
                "nombre" => $this->input->post( "nombre" ),
                "apellidos" => $this->input->post( "apellidos" ),
                "dni" => $this->input->post( "dni" ),
                "direccion" => $this->input->post( "direccion" ),
                "provincia" => $this->input->post( "provincia" ),
                "codigoPostal" => $this->input->post( "codigoPostal" )
            );

             if ( $this->registrarNuevoUsuario->insertar( $columnas ) ) {
                 echo "registrado";
             }
        }
        else { // El formulario, no ha pasado las validaciones de sus campos.
            // Los mensajes de error, vienen por defecto entre etiquetas p, cambio las etiquetas por uns lista.
            $this->form_validation->set_error_delimiters( '<li>', '</li>' );
            // Envio al punto de la peticion ajax, los errores de validacion encontrados.
            echo validation_errors();
        }
    }

    /**
     * Valida el dni
     * @param  string $dni numero nacional de identidad.
     * @return boolean  si es true, es un dni valido, sino es incorrecto.
     */
    function comprobarDni( $dni ) {

        // Variable de control, que utilizare para comprobar si el dni es correcto.
        $estado = true;
        // Todas las letras posibles de un dni
        $letras = array( 'T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T' );
        // Extraigo los numeros
        $numero = substr( $dni, 0, -1 );
        // Extraigo el caracter de control
        $letra = substr( $dni, -1 );

        // Compruebo si la variable numeros son numeros y la variable letra es un caracter.
        if ( is_numeric( $numero ) && is_string( $letra ) ) {

            // Convierto a minusculas.
            $letra = strtoupper( $letra );

            // Para que sea un dni valido, el numero debe de estar comprendido, entre los siguientes valores.
            if ( $numero >= 0 && $numero <= 99999999 ) {

                // Obtengo la letra que le corresponderia a ese numero.
                $letraCorrecta = $letras[ $numero % 23 ];
                // Si la letra correcta no es igual, que la letra introducida por el usuario.
                if ( $letraCorrecta != $letra ) {
                    $estado = false;
                }
            }
            else { // El numero introducido, no se encuentra entre el rango de valores permitidos.
                $estado = false;
            }
        } // Si el dni introducido no esta formado por 8 numeros seguidos de una letra.
        else {
            $estado = false;
        }


        return $estado;
    }

// Final metodo
}

?>