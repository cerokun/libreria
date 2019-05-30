<?php

echo "Tu ip es: " . get_client_ip_server();


// Url del servicio soap.
$url = "https://ws.cdyne.com/ip2geo/ip2geo.asmx?WSDL";


$datos = array(
    "ipAddress" => "213.143.61.128",
    "licenseKey" => 0
);


try {
    echo "<br><br> Antes de cargar la libreria Soap <br>";
    $client = new SoapClient($url);
    echo "He cargado la libreria <br>";
    $result = $client->ResolveIP($datos);
    echo "Invoco al metodo  client->ResolveIP() <br>";
} catch (SoapFault $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo "Exception general" . $e->getMessage();
}

echo "Solicito la ciudad mediante ResolveIPResult->City <br>";
echo "Tu ciudad es: " . $result->ResolveIPResult->City;

echo "<pre>";
print_r($result);
echo "</pre>";


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
