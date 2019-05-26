<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carrito
{
	/**
	 * Reference to CodeIgniter instance
	 *
	 * @var object
	 */
	protected $CI;
	/**
	 * Carrito, array local, datos volatiles.
	 *
	 * @var [type]
	 */
	private $libros;

	public function __construct()
	{

		// Set the super object to a local variable for use later
		$this->CI = &get_instance();
		// Load the Sessions class
		$this->CI->load->driver('session');

		// Compruebo si existe una sesion carrito de compra.
		if ($this->CI->session->has_userdata('carrito')) {
			$this->libros = $this->CI->session->userdata("carrito");
		} else { // Sino la creo
			$this->CI->session->set_userdata("carrito");
		}
	}


	/**
	 * Añade un nuevo producto al array local.
	 * 
	 * @return  void
	 */
	function añadir($id, $nuevo)
	{
		$this->libros[$id] = $nuevo;
		$this->actualizar();
	}


	/**
	 * Modifica campos sueltos del producto
	 *
	 * @param int $id es su clave primaria.
	 * @param String $campo que quiero modificar.
	 * @param String $valor que quiero guardar.
	 * @return void
	 */
	function modificar($id, $campo, $valor)
	{
		$this->libros[$id][0][$campo] =  $valor;
		$this->actualizar();
	}

	function incrementarCantidad($id, $valor)
	{
		$this->libros[$id][0]["cantidad"] +=  $valor;
		$this->actualizar();
	}

	/**
	 * Me entrega el producto que le solicitemos
	 *
	 * @param int $id clave primaria del producto.
	 * @return array ascociativo con los datos del producto.
	 */
	function dameProductoPorSuId($id)
	{
		return  $this->libros[$id];
	}

	/**
	 * Elimino un producto
	 *
	 * @param int $id clave primaria del producto
	 * @return void
	 */
	function eliminar($id)
	{
		unset($this->libros[$id]);
		$this->actualizar();
	}

	/**
	 * Me dice si existe un producto.
	 *
	 * @param int $id clave primaria del producto.
	 * @return boolean true si lo ha encontrado y false sino lo encontro.
	 */
	function siExiste($id)
	{
		return (isset($this->libros[$id])) ? true : false;
	}

	/**
	 * Me entrega todos los productos
	 *
	 * @return void
	 */
	function dameTodosLosProductos()
	{
		return $this->libros;
	}

	/**
	 * Actualizo los datos de la sesion
	 *
	 * @return void
	 */
	function actualizar()
	{
		$this->CI->session->set_userdata("carrito",  $this->libros);
	}

	/**
	 * Destruye la sesion, eliminando asi, todos los productos.
	 * 
	 * @return	void
	 */
	public function destroy()
	{
		$this->CI->session->unset_userdata('carrito');
	}
}// Final clase
