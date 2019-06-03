<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carrito
{


	private $total_items;
	/**
	 * Reference to CodeIgniter instance
	 *
	 * @var object
	 */
	protected $CI;
	/**
	 * Carrito, array local, datos volatiles.
	 *
	 * @var Array 
	 */
	protected $libros = array();


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
			$this->CI->session->set_userdata("carrito", $this->libros);
		}
	}


	/**
	 * Añade un nuevo producto al array local.
	 * 
	 * @return  void
	 */
	public function añadir($id, $nuevo)
	{
		if (is_array($nuevo) and count($nuevo) > 0) {
			$this->libros[$id] = $nuevo;
			$this->actualizar();
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Comprueba si un producto tiene stock.
	 *
	 * @param int $id clave primaria del producto.
	 * @return void
	 */
	public function siHayStock($id)
	{
	    return isset( $this->libros[$id][0]["stock"] ) ? count( $this->libros[$id][0]["stock"] ) : "nada";
	}

	public function dameElStockDeEsteProducto( $id ) {
		return isset($this->libros[$id][0]["stock"]) ? $this->libros[$id][0]["stock"] : 0;
	}


	/**
	 * Modifica campos sueltos del producto
	 *
	 * @param int $id es su clave primaria.
	 * @param String $campo que quiero modificar.
	 * @param String $valor que quiero guardar.
	 * @return void
	 */
	public function modificar($id, $campo, $valor)
	{
		$this->libros[$id][0][$campo] =  $valor;
		$this->actualizar();
	}

	public function incrementarCantidad($id)
	{
		if (is_numeric($id)) {
			$this->libros[$id][0]["cantidad"]++;
			$this->actualizar();
			return true;
		} else {
			return false;
		}
	}


	public function numeroTotalProductos()
	{

		foreach ($this->libros as $libro) {
			$this->total_items += $libro[0]["cantidad"];
		}
		return $this->total_items;
	}


	/**
	 * Me entrega el producto que le solicitemos
	 *
	 * @param int $id clave primaria del producto.
	 * @return array ascociativo con los datos del producto.
	 */
	public function dameProductoPorSuId($id)
	{
		return  $this->libros[$id];
	}

	/**
	 * Elimino un producto
	 *
	 * @param int $id clave primaria del producto
	 * @return void
	 */
	public function eliminar($id)
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
	public function siExiste($id)
	{
		return (isset($this->libros[$id])) ? true : false;
	}



	/**
	 * Me entrega todos los productos
	 *
	 * @return void
	 */
	public function dameTodosLosProductos()
	{
		return $this->libros;
	}

	/**
	 * Actualizo los datos de la sesion
	 *
	 * @return void
	 */
	public function actualizar()
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
		$this->libros = 0;
	}
}// Final clase
