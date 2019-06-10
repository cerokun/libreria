<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ImportarDatosEnXML extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('categorias');
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
        $this->load->view('formularioImportarDatosEnXML');
        $this->load->view("plantillas/footer");
    }


    public function categorias($xml)
    {


        foreach ($xml as $categoria) {
            $datos[] = array(
                "nombre" => $categoria->nombre,
                "descripcion" => $categoria->descripcion,
                "anuncio" => $categoria->anuncio,
                "codigo" => $categoria->codigo,
                "visible" => $categoria->visible
            );
        }
  
        $this->categorias->insertar($datos);

    }

    public function productos($xml)
    {
        echo "quiere importar productos";
        echo $xml->book[0]->attributes()->id;
        echo $xml->book[2]->author;
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
