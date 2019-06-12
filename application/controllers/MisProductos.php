<?php

/**
 * Obtengo todos los productos
 */

defined('BASEPATH') or exit('No direct script access allowed');

class MisProductos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('productos');
    }

    /**
     * Me da los productos
     */
    public function dameTodos()
    {
        $this->productos->dameTodos();
    }

   
} // Final clase
