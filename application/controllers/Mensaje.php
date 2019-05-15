<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mensaje extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	public function saludo()
	{
		//$this->load->view("plantillas/header");
		//$this->load->view("plantillas/nav");
		//$this->load->view('principal');
		$this->load->view("mensaje");
	}
} // Final clase
