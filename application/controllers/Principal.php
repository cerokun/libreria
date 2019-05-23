<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Principal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Productos');
	}


	public function index()
	{
		$this->load->view("plantillas/header");
		$this->load->view("plantillas/nav");
		$productos["libros"] = $this->Productos->dameTodos();
		$this->load->view('principal', $productos);
		$this->load->view("plantillas/footer");
	}

 
	/**
	 * Destruye la sesion.
	 *
	 * @return void
	 */
	public function cerrarSesion()
	{
		$this->session->sess_destroy("usuario");
		// Redireccino al menu principal.
		redirect('Principal');
	}

	



	
} // Final clase
