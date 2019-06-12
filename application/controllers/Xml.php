<?php

/**
 * Importa categorias o productos desde un fichero .xml 
 * y los almaceno en la base de datos.
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Xml extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('categorias');
        $this->load->model("productos");
        $config['upload_path']   =  'uploads/';
        $config['allowed_types'] = 'xml';
        $config["overwrite"] = TRUE;
        $this->load->library('upload', $config);
    }


    public function index()
    {
        $misCategorias["categorias"] = $this->categorias->dameTodas();
        $this->load->view("plantillas/header", $misCategorias);
        $this->load->view("plantillas/nav");
        $this->load->view('formularioXml');
        $this->load->view("plantillas/footer");
    }

    /**
     * Extrae del fichero .xml los datos y añade una
     * nueva categoria a la base de datos.
     *
     * @param object $xml objeto SimpleXMLElement con las categorias.
     * @return void
     */
    public function categorias($xml)
    {
        // Recorro el xml
        foreach ($xml as $categoria) {
            // Voy guardando en el array los datos.
            $datos[] = array(
                "idCategoria" => $categoria->idCategoria,
                "nombre" => $categoria->nombre,
                "descripcion" => $categoria->descripcion,
                "anuncio" => $categoria->anuncio,
                "codigo" => $categoria->codigo,
                "visible" => $categoria->visible
            );
        }
        // Inserto las nuevas categorias en la base de datos.
        $this->categorias->insertar($datos);
    }

    /**
     * Extrae del fichero .xml los datos y añade 
     * nuevos productos a la base de datos.
     *
     * @param object $xml objeto SimpleXMLElement con los productos.
     * @return void
     */
    public function productos($xml)
    {
        // Recorro el xml
        foreach ($xml as $producto) {
            // Voy guardando en el array los datos.
            $datos[] = array(
                "nombre" => $producto->nombre,
                "imagen" => trim($producto->imagen),
                "descripcion" => $producto->descripcion,
                "precio" => $producto->precio,
                "descuento" => $producto->descuento,
                "iva" => $producto->iva,
                "stock" => $producto->stock,
                "isbn" => $producto->isbn,
                "anuncio" => $producto->anuncio,
                "destacado" => $producto->destacado,
                "desde" => $producto->desde,
                "hasta" => $producto->hasta,
                "visible" => $producto->visible,
                "idCategoria" => $producto->idCategoria
            );
        }
        // Inserto los nuevos productos en la base de datos.
        $this->productos->insertar($datos);
    }

    /**
     * Sube el fichero xml
     *
     * @return array con los datos.
     */
    public function upload()
    {
        // Compruebo si se ha subido e fichero al servidor.
        if ($this->upload->do_upload("myFile")) {

            // Obtengo los datos del fichero subido.
            $data =  $this->upload->data();
            // Creo un objeto xml 
            $xml = new SimpleXMLElement($data["full_path"], 0, true);

            // compruebo que tipo de datos es
            if ($xml->getName() === "categorias") {
                $this->categorias($xml);
            } else if ($xml->getName() === "productos") {
                $this->productos($xml);
            } else {
                echo "Solo se aceptan xml de productos y categorias";
            }
        } else {
            echo "hay error, lo muestro el error en la vista que se ha subido el fichero: " . $this->upload->display_errors();
        }
    }
} // Final clase
