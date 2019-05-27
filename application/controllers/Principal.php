<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Principal extends CI_Controller
{



	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
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

		$num_row = $this->Productos->num_rows();
		$quieroMostrarPorPagina = 18;
		$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		// Configuracion base
		$config['base_url'] = base_url() . "index.php/Principal/index/"; // Controlador que manejara la paginacion.
		$config['total_rows'] = $num_row; // Numero de productos.
		$config['per_page'] = $quieroMostrarPorPagina; // indica la cantidad de resultados que se quieren ver por página.
		$config["uri_segment"] = 2;
		$config["num_links"] = 5;


		// Estilos boostrap
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="http://localhost/libreria/index.php/Principal/index/0">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$misCategorias["categorias"] = $this->Categorias->dameTodas();
		$this->load->view("plantillas/header", $misCategorias);
		$this->load->view("plantillas/nav");
		$misLibros["libros"] = $this->Productos->destacados($quieroMostrarPorPagina, $desde);
		$this->load->view('principal', $misLibros);
		$this->load->view("plantillas/footer");
	}





	public function productosPorCategoria()
	{
		$id = $this->input->post("idCategoria");

		$num_row = $this->Productos->num_rows_per_category($id);
		$quieroMostrarPorPagina = 5;

		$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		// Configuracion base
		$config['base_url'] = site_url() . "/productosPorCategoria/"; // Controlador que manejara la paginacion.
		$config['total_rows'] = $num_row; // Numero de productos.
		$config['per_page'] = $quieroMostrarPorPagina; // indica la cantidad de resultados que se quieren ver por página.
		$config["uri_segment"] = 2;
		$config["num_links"] = 3;

		// Estilos boostrap
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="http://localhost/libreria/index.php/Principal/productosPorCategoria/0">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);


		$misLibros["libros"] =  $this->Productos->dameProductosPorIdCategoria($id, $quieroMostrarPorPagina, $desde);

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
		$this->session->unset_userdata('carrito');
		// Redireccino al menu principal.
		redirect('Principal');
	}
} // Final clase
