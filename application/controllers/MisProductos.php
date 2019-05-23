<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MisProductos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Productos');
    }

   public function dameTodos() {
       echo "<pre>";
       print_r(   $this->Productos->dameTodos() );
       echo "</pre>";
   }
 


 
} // Final clase
