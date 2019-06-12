<?php


/***
 * Consumo un web service y obtengo la ciudad desde donde se conecta.
 */
function dameCiudadDesdeLaQueMeConecto()
{

    // Obtengo la ip del servidor
    //$ip = get_client_ip_server(); 
    $ip = "146.158.199.3";

    //$ip = "146.158.199.3"; // Desde local funciona, poner la ip aqui.
    // Url del servicio soap.
    $url = "https://ws.cdyne.com/ip2geo/ip2geo.asmx?WSDL";

    // Parametros
    $datos = array(
        "ipAddress" => $ip,
        "licenseKey" => 0
    );


    // Instancio el servicio
    $client = new SoapClient($url);

    // Le paso los datos
    $result = $client->ResolveIP($datos);
    // Datos que enviare a la vista.
    $datos["ciudad"] =  $result->ResolveIPResult->City;

    // Devuelvo los datos a la vista.
    return $datos;
}



// Function to get the client ip address
function get_client_ip_server()
{

    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if ($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if ($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}
