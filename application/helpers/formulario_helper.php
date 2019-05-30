<?php



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

    $html = '<select class="estados" id="' . $name . '">';

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
