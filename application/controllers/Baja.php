<?php
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


    
    public function usuario()
    {
        $id =  $this->session->userdata['usuario']['idUsuario'];
        $this->bajaCuenta->usuario($id);
    }
} // Final clase
