<?php 
   header('Access-Control-Allow-Origin: *');
   include_once 'lib/nusoap.php';
   
   $tipo = $_POST['tipo'];
   $cod = $_POST['cod'];
   $rif = $_POST['rif'];
   $comprador = $_POST['comprador'];
   $fecha = $_POST['fecha'];
   $direc = $_POST['direc'];
   $productos = $_POST['productos'];
   
   $ruta = 'https://cemon--dis1.herokuapp.com';

   $cliente = new nusoap_client($ruta."/".$tipo.".php?wsdl",true);
   $cliente -> setEndpoint($ruta."/".$tipo.".php"); 
   if($cod == '' && $tipo == "solicitud"){
      $parametros = array('tipo'=>$tipo,'rif'=>$rif,"comprador"=>$comprador,"fecha"=>$fecha,"direc"=>$direc, "productos"=>$productos);
      $data = $cliente->call("MiFuncion", $parametros);
      if ($data == null) {
         $error = "No respondio";
         $data = json_encode(array('tipo'=>$tipo, 'error'=> "Error: Servicio no disponible"));
      }
   }else{
      if($tipo == "confirmacion" && $cod !=''){
         $parametros = array('tipo'=>$tipo,'cod'=>$cod,'rif'=>$rif,"comprador"=>$comprador,"fecha"=>$fecha);
         $data = $cliente->call("MiFuncion", $parametros);
         if ($data == null) {
            $error = "No respondio";
            $data = json_encode(array('tipo'=>$tipo, 'error'=> "Error: Servicio no disponible"));
         }
      }else{
         $data = json_encode(array('tipo'=>$tipo, 'error'=> "Error: se equivoco en el tipo de servicio"));
      }
   }
   
   echo $data;
?>
