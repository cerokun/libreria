<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Principal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Categorias');
		$this->load->model('Productos');
	}

	/**
	 * Muestra los productos destacadas en la pagina principal
	 *
	 * @return void
	 */
	public function index()
	{
		$misCategorias["categorias"] = $this->Categorias->dameTodas();
		$this->load->view("plantillas/header", $misCategorias);
		$this->load->view("plantillas/nav");
		$misLibros["libros"] = $this->Productos->destacados();
		$this->load->view('principal', $misLibros);
		$this->load->view("plantillas/footer");
	}

	public function productosPorCategoria()
	{

		$id = $this->input->post("idCategoria");

		$misLibros["libros"] =  $this->Productos->dameProductosPorIdCategoria($id);
		$this->load->view('principal', $misLibros);
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
