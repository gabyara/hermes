<?php

include_once 'lib/nusoap.php';
$servicio = new soap_server();

$ns = "urn:miserviciowsdl";
$servicio->configureWSDL("MiPrimerServicioWeb",$ns);
$servicio->schemaTargetNamespace = $ns;

$servicio->register("MiFuncion", array('tipo' => 'xsd:string','rif' => 'xsd:int','comprador' => 'xsd:int','fecha' => 'xsd:date','productos' => 'xsd:string','direc' => 'xsd:string'), array('return' => 'xsd:string'), $ns );

function MiFuncion($tipo,$rif,$comprador,$fecha,$productos,$direc){
	$error = " ";
	$costo = 0;
	$nuevafecha = strtotime('+30 day',strtotime($fecha));
	$nuevafecha = date('Y-m-d' , $nuevafecha);
	switch(strtolower($direc)){
		case "amazonas":
			$costo = 50;
		break;
		case "anzoátegui":
			$costo = 40;
		break;
		case "apure":
			$costo = 30;
		break;
		case "aragua":
			$costo = 25;
		break;
		case "barinas":
			$costo = 30;
		break;
		case "bolívar":
			$costo = 30;
		break;
		case "carabobo":
			$costo = 15;
		break;
		case "cojedes":
			$costo = 30;
		break;
		case "delta amacuro":
			$costo = 30;
		break;
		case "distrito capital":
			$costo = 10;
		break;
		case "falcón":
			$costo = 40;
		break;
		case "guárico":
			$costo = 30;
		break;
		case "lara":
			$costo = 30;
		break;
		case "mérida":
			$costo = 40;
		break;
		case "miranda":
			$costo = 10;
		break;
		case "monagas":
			$costo = 25;
		break;
		case "nueva esparta":
			$costo = 55;
		break;
		case "portuguesa":
			$costo = 30;
		break;
		case "sucre":
			$costo = 35;
		break;
		case "táchira":
			$costo = 25;
		break;
		case "trujillo":
			$costo = 35;
		break;
		case "vargas":
			$costo = 15;
		break;
		case "yaracuy":
			$costo = 20;
		break;
		case "zulia":
			$costo = 45;
		break;
		default:
			$error = "La direccion no sigue el formato";
	}
	if($error == " "){
		$respuesta = array(
			'tipo' => $tipo,
			'ID' => '0',  //Identificador de la solicitud
			'rif' => $rif,
			'comprador' => $comprador,
			'fecha' => $fecha,
			'fechaF' => $nuevafecha,
			'costo' => $costo,
			'productos'=> $productos,
			'direc' => $direc,
			'Estatus' => "Entrante",
			'error' => $error,
		);
	}else{
		$respuesta = array('error' => $error);
	}
	return json_encode($respuesta);
 
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$servicio->service(file_get_contents("php://input"));


?>
