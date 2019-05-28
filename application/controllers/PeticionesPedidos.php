<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PeticionesPedidos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();  
        $this->load->model("Pedidos");

    }

    public function index()
    {
        
    }


}// Final clase
