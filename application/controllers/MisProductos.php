<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MisProductos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('productos');
    }

    public function dameTodos()
    {
        $this->productos->dameTodos();
    }

   
} // Final clase
