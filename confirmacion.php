<?php

include_once 'lib/nusoap.php';
$servicio = new soap_server();

$ns = "urn:miserviciowsdl";
$servicio->configureWSDL("MiPrimerServicioWeb",$ns);
$servicio->schemaTargetNamespace = $ns;

$servicio->register("MiFuncion", array('tipo' => 'xsd:string', 'cod' => 'xsd:int', 'rif' => 'xsd:int','comprador' => 'xsd:int','fecha' => 'xsd:date'), array('return' => 'xsd:string'), $ns );

function MiFuncion($tipo, $cod, $rif, $comprador, $fecha){
	$nuevafecha = strtotime('+10 day',strtotime($fecha));
	$nuevafecha = date('Y-m-d' , $nuevafecha);
	$respuesta = array(
		'tipo' => $tipo,
		'ID' => '0', //Identificador de la confirmacion
		'cod' => $cod,
		'rif' => $rif,
		'comprador' => $comprador,
		'fecha' => $fecha,
		'fechaE' => $nuevafecha,
		'Estatus' => 'Por despachar',
		'error' => ' '
	);

	return json_encode($respuesta);
 
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$servicio->service(file_get_contents("php://input"));


?>
