<?php
/**
 * Se encarga de procesar las peticiones de baja de de los clientes, cuando un cliente quiere dar de baja su cuenta,
 * lo que hago es desactivar la cuenta, pero no la elimino.
 * 
 * @author Jose Luis  
 * 
 */


defined('BASEPATH') or exit('No direct script access allowed');

class Baja extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('categorias');
        $this->load->model("bajaCuenta");
    }


    public function index()
    {
        $misCategorias["categorias"] = $this->categorias->dameTodas();
        $this->load->view("plantillas/header", $misCategorias);
        $this->load->view("plantillas/nav");
        $this->load->view('baja');
        $this->load->view("plantillas/footer");
    }


    /**
     * Da de baja al usuario
     *
     * @return void
     */
    public function usuario()
    {   // Obtengo el identificador del usuario
        $id =  $this->session->userdata['usuario']['idUsuario'];
        // Solicito al modelo, que elimine el usuario.
        $this->bajaCuenta->usuario($id);
    }
} // Final clase
