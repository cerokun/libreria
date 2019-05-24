<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MisProductos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Productos');
    }

    public function dameTodos()
    {
        $this->Productos->dameTodos();
    }

    public function mostraPorCategoria()
    {
        $id = $this->input->post("idCategoria");
        $datos =  $this->Productos->dameProductosPorIdCategoria($id);
      

       
    }
} // Final clase
