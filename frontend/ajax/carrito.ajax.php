<?php

require_once "../extensiones/paypal.controlador.php";

require_once "../controladores/carrito.controlador.php";
require_once "../modelos/carrito.modelo.php";

class AjaxCarrito{

	/*=====================================
	=            Método Paypal            =
	=====================================*/
	public $divisa;
	public $total;
	public $totalEncriptado;
	public $impuesto;
	public $envio;
	public $subtotal;
	public $tituloArray;
	public $cantidadArray;
	public $valorItemArray;
	public $idProductoArray;

	public function ajaxEnviarPaypal(){

		if(md5($this->total) == $this->totalEncriptado){

				$datos = array(
						"divisa"=>$this->divisa,
						"total"=>$this->total,
						"impuesto"=>$this->impuesto,
						"envio"=>$this->envio,
						"subtotal"=>$this->subtotal,
						"tituloArray"=>$this->tituloArray,
						"cantidadArray"=>$this->cantidadArray,
						"valorItemArray"=>$this->valorItemArray,
						"idProductoArray"=>$this->idProductoArray,
					);

				$respuesta = Paypal::mdlPagoPaypal($datos);

				echo $respuesta;

		}
	}

	/*===================================
	=            Método Payu            =
	===================================*/
	public function ajaxTraerComercioPayu(){

		$respuesta = ControladorCarrito::ctrMostrarTarifas(); 

		echo json_encode($respuesta);
	}

}

/*=====================================
=            Método Paypal            =
=====================================*/
if(isset($_POST["divisa"])){

	/*=============================================
	VALIDACIÓN DE LADO SERVIDOR CON LOS PRECIOS DE LA BD Y LOS PRECIOS Y CANTIDADES ENVIADOS POR EL CLIENTE
	=============================================*/

	$idProductos = explode(",", $_POST["idProductoArray"]);
    $precioProductos = explode(",", $_POST["valorItemArray"]);
    $cantidadProductos = explode(",", $_POST["cantidadArray"]);
 
    $item = "id";
 
    for($i = 0; $i < sizeof($idProductos); $i++){
 
        $valor = $idProductos[$i];
 
        $verificarProductos = ControladorProductos::ctrVerificarInfoProducto($item, $valor);
 
        foreach ($verificarProductos as $key => $value){
 
            if($value["precioOferta"] == 0){
 
                $precio = $value["precio"];
 
            }else{
 
                $precio = $value["precioOferta"];
 
            }
 
            $verificarSubTotal = $cantidadProductos[$i]*$precio;
            $totalSubTotal = $precio*$cantidadProductos[$i];
         
            if($verificarSubTotal != $precioProductos[$i]){
 
                echo "no coinciden";

                return;
 
            }
 
        }
 
    }

	$paypal = new AjaxCarrito();
	$paypal ->divisa = $_POST["divisa"];
	$paypal ->total = $_POST["total"];
	$paypal ->totalEncriptado = $_POST["totalEncriptado"];
	$paypal ->impuesto = $_POST["impuesto"];
	$paypal ->envio = $_POST["envio"];
	$paypal ->subtotal = $_POST["subtotal"];
	$paypal ->tituloArray = $_POST["tituloArray"];
	$paypal ->cantidadArray = $_POST["cantidadArray"];
	$paypal ->valorItemArray = $_POST["valorItemArray"];
	$paypal ->idProductoArray = $_POST["idProductoArray"];
	$paypal -> ajaxEnviarPaypal();


}

/*===================================
=            Método Payu            =
===================================*/
if(isset($_POST["metodoPago"]) && $_POST["metodoPago"] == "payu"){

	$payu = new AjaxCarrito();
	$payu -> ajaxTraerComercioPayu();


}

/*===================================================================
=            Verficar con no tenga el producto adquirido            =
===================================================================*/
if(isset($_POST["idProducto"])){

	$producto = new AjaxCarrito();
	$producto ->idUsuario = $_POST["idUsuario"];
	$producto ->idProducto = $_POST["idProducto"];
	$producto -> ajaxVerificarProducto();
	
}
