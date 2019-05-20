<?php

/**
 * Obtengo el nombre de la provincia.
 *
 * @param int  $codigo numerico vinculado a la provincia.
 * @return String nombre de la provincia
 */
function dameUnaProvincia($codigo)
{

    // Las provincias
    $provincias = array(

        1  => "Alava",
        2  => "Albacete",
        3  => "Alicante",
        4  => "Almeria",
        5  => "Avila",
        6  => "Badajoz",
        7  => "Islas Baleares",
        8  => "Barcelona",
        9  => "Burgos",
        10 => "Caceres",
        11 => "Cadiz",
        12 => "Castellon",
        13 => "Ciudad Real",
        14 => "Cordoba",
        15 => "A Coruña",
        16 => "Cuenca",
        17 => "Girona",
        18 => "Granada",
        19 => "Guadalajara",
        20 => "Gipuzkoa",
        21 => "Huelva",
        22 => "Huesca",
        23 => "Jaen",
        24 => "Leon",
        25 => "Lleida",
        26 => "La Rioja",
        27 => "Lugo",
        28 => "Madrid",
        29 => "Malaga",
        30 => "Murcia",
        31 => "Navarra",
        32 => "Ourense",
        33 => "Asturias",
        34 => "Palencia",
        35 => "Las Palmas",
        36 => "Pontevedra",
        37 => "La Rioja",
        38 => "Santa Cruz de Tenerife",
        39 => "Cantabria",
        40 => "Segovia",
        41 => "Sevilla",
        42 => "Soria",
        43 => "Tarragona",
        44 => "Teruel",
        45 => "Toledo",
        46 => "Valencia",
        47 => "Valladolid",
        48 => "Bizkaia",
        49 => "Zamora",
        50 => "Zaragoza",
        51 => "Ceuta",
        52 => "Melilla"

    );

    return $provincias[$codigo];
}

/**
 * Me da todas las provincas
 *
 * @return Array con las provincias.
 */
function dameTodasLasProvincias()
{

    // Las provincias
    $provincias = array(

        1  => "Alava",
        2  => "Albacete",
        3  => "Alicante",
        4  => "Almeria",
        5  => "Avila",
        6  => "Badajoz",
        7  => "Islas Baleares",
        8  => "Barcelona",
        9  => "Burgos",
        10 => "Caceres",
        11 => "Cadiz",
        12 => "Castellon",
        13 => "Ciudad Real",
        14 => "Cordoba",
        15 => "A Coruña",
        16 => "Cuenca",
        17 => "Girona",
        18 => "Granada",
        19 => "Guadalajara",
        20 => "Gipuzkoa",
        21 => "Huelva",
        22 => "Huesca",
        23 => "Jaen",
        24 => "Leon",
        25 => "Lleida",
        26 => "La Rioja",
        27 => "Lugo",
        28 => "Madrid",
        29 => "Malaga",
        30 => "Murcia",
        31 => "Navarra",
        32 => "Ourense",
        33 => "Asturias",
        34 => "Palencia",
        35 => "Las Palmas",
        36 => "Pontevedra",
        37 => "La Rioja",
        38 => "Santa Cruz de Tenerife",
        39 => "Cantabria",
        40 => "Segovia",
        41 => "Sevilla",
        42 => "Soria",
        43 => "Tarragona",
        44 => "Teruel",
        45 => "Toledo",
        46 => "Valencia",
        47 => "Valladolid",
        48 => "Bizkaia",
        49 => "Zamora",
        50 => "Zaragoza",
        51 => "Ceuta",
        52 => "Melilla"

    );

    return $provincias;
}

/**
 * Crea un select.
 *
 * @param String $name nombre del select.
 * @param Array $options con los values y los texto a mostrar, un array asociativo clave-valor.
 * @param String $selected busca cada value de cada option, en busca del que le especifico, si lo encuentra,  lo marca como selected.
 * @return String con el select ya construido.
 */
function crearSelect($name, $options, $selectedThis = "")
{

    $html = '<select name="' . $name . '">';

    foreach ($options as $value => $text) {

        if ($value == $selectedThis) {
            $html .= '<option value="' . $value . '"  selected>' . $text . '</option>';
        } else {
            $html .= '<option value="' . $value . '" >' . $text . '</option>';
        }
    }

    $html .= '</select>';
    return $html;
}
