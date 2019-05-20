<?php



/**
 * Comprueba si un DNI es correcto
 * 
 * @param  string $dni numero nacional de identidad.
 * @return boolean  si es true, es un dni valido, si es false, sera incorrecto.
 */
function valid_dni($dni)
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
