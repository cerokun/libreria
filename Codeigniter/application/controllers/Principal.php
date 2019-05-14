<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Principal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$this->load->view("plantillas/header");
		$this->load->view("plantillas/nav");
		$this->load->view('principal');
		$this->load->view("plantillas/footer");
	}


	/**
	 * Muestra el formulario de login.
	 * @return [type] [description]
	 */
	public function mostrarFormularioLogin()
	{
		$this->load->view("login");
	}

	public function mostrarFormularioRegistro()
	{
		//$data["provincias"] = $this->provincias->dameProvincias(1);
		$this->load->view("registro");
	}

	public function cerrarSesion()
	{
		$this->session->sess_destroy("usuario");
		redirect('Principal');
	}

} // Final clase
