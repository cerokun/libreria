<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('categorias');
        $this->load->library('grocery_CRUD');
    }


    public function productos()
    {
        $crud = new grocery_CRUD();
        $crud->set_theme("datatables");
        $crud->set_table('productos');
        $crud->columns("nombre", "precio", "stock", "isbn", "destacado", "visible");
        $crud->set_language("spanish");

        $output = $crud->render();

        // Obtengo las categorias
        $misCategorias["categorias"] = $this->categorias->dameTodas();
        // Le paaso las categorias a la vista
        $this->load->view("plantillas/header", $misCategorias);
        $this->load->view("plantillas/nav");
        // Paso todos los pedidos a la vista
        $this->load->view("crud", $output);
        $this->load->view("plantillas/footer");
    }

    public function categorias()
    {

        $crud = new grocery_CRUD();
        $crud->set_theme("datatables");
        $crud->set_table('categorias');
        $crud->columns("idCategoria", "nombre", "descripcion", "anuncio", "codigo", "visible");
        $crud->set_language("spanish");

        $output = $crud->render();

        // Obtengo las categorias
        $misCategorias["categorias"] = $this->categorias->dameTodas();
        // Le paaso las categorias a la vista
        $this->load->view("plantillas/header", $misCategorias);
        $this->load->view("plantillas/nav");
        // Paso todos los pedidos a la vista
        $this->load->view("crud", $output);
        $this->load->view("plantillas/footer");
    }
}
