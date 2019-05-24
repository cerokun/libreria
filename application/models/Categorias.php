<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

   

    public function dameTodas()
    {
        return $this->db->get("categorias")->result_array();
    }
}
