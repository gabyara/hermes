
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
	<title>Conecciones</title>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
	<script type="text/javascript" src="./jquery/jquery.3.4.js"></script>
    <script type="text/javascript">
        function Solicitar() {
			var tipo = $("#tipo").val();
			var cod = $("#codigo").val();
			var rif = $("#rif").val();
			var comprador = $("#comprador").val();
			var fecha = $("#fecha").val();
			var direc = $("#direc").val();
			var productos = document.getElementById("productos").value;
			
          	$.ajax({
                type: 'post',
                url:  './cliente.php',
                data: {"tipo":tipo,"cod":cod,"rif":rif,"comprador":comprador,"fecha":fecha,"productos":productos,"direc":direc},
                success: function(data) {
					json_data = JSON.parse(data);
					console.log(json_data);
					$("#fechafin").html(json_data.fechaF)
					$("#costo").html(json_data.costo)
					$("#error").html(json_data.error)
                },
				error: function(data){
					console.log("Error: ", data);
				}
            });
            return "prueba";
		}
	</script>	
	<script type="text/javascript">
        function Factura() {
			var emitter = $("#emisor").val();
			var receiver = $("#receptor").val();
			var bill_ref_cod = $("#factura").val();
			var amount = $("#monto").val();
			var expdate = $("#fechaEx").val();
			var password = $("#contra").val();
			var description = $("#des").val();
			<?php 
				$authorizationToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1NzExNjY4MjIsImV4cCI6MTYwMjI3MDgyMiwiZGF0YSI6eyJpZCI6NiwianVzcl9yaWYiOiJKMTIzNDU2Nzg5IiwianVzcl91c2VyIjo5LCJqdXNyX2VtYWlsIjoicmlvc3JpY2FyZG8xMjM0QGhvdG1haWwuY29tIiwianVzcl9jb21wYW55IjoiSGVybWVzIiwianVzcl9hZGRyZXNzIjoiQ2FyYWNhcyIsImp1c3JfcGhvbmUiOiIxMjM0NTY3ODkwIiwicGFzc3dvcmQiOiIkMnkkMTAkVVlJUmVQNFltNEg2dnpHejhQczRjTzdSU2tyMGUuV2xKMjhoLnByXC9SdDRHT0hHYnRSdVBtIiwicV9yZWNvdmVyeSI6IkhvbGE_IiwiYV9yZWNvdmVyeSI6IkJpZW4iLCJhY3RpdmUiOjEsImp1c3JfY3JlYXRlZF9hdCI6IjIwMTktMTAtMTUgMTg6NDc6NDQiLCJqdXNyX3VwZGF0ZWRfYXQiOiIyMDE5LTEwLTE1IDE4OjUwOjU2IiwianVzcl9kZWxldGVkX2F0IjpudWxsfX0.YDd6Yet4TxHOB65RElvDjd5hju9nMoWRf5WbagOYcP4";
			?>
			var miToken = '<?php echo $authorizationToken; ?>';
          	$.ajax({
				type: 'post',
				beforeSend: function(request) { 
    				request.setRequestHeader("Authorization", miToken); 
    			},
				headers: {
        			'Authorization': miToken,
    			},
                url:  'http://bankoneapi.16mb.com/api/bill',
                data: {"emitter":emitter,"receiver":receiver,"bill_ref_cod":bill_ref_cod,"amount":amount,"expdate":expdate,"description":description},
                success: function(data) {
					//json_data = JSON.parse(data);
					console.log(data);
				},
				error: function(data){
					console.log("Error: ", data);
				}
            });
            return "prueba";
		}
	</script>	
</head>
<body>
	<header>
		<div class="navbar navbar-default navbar-static-top ">
			<div class="navbar navbar-default navbar-static-top">
				<div class="container">
					<div class="navbar-header" style=" margin-bottom: 10px;">
						<a class="navbar-brand"><p>Conecciones</p></a>
					</div>
				</div>
			</div>
		</div>	
	</header>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="marco marco2">
					<div class="Contenido">
						<center><?php echo  date("d") ." del " . date("m") . " de " . date("Y");?></center>
						<br>
						<p style="text-align: justify;">Solicitudes<br></p>
						<form action="index.php" method="post">
							<center>
								<h3>Elija el tipo de servicio:</h3>
								<select id="tipo" name="tipo"> <!--Tipo de servicio-->
									<?php
										   echo '<option value="solicitud">Solicitud</option>';
										   echo '<option value="confirmacion">Confirmacion</option>';
		        					?>
								</select>
								<h3>Identificador de la confirmacion (solo si el servicio es de confirmacion, sino dejelo en blanco)</h3>
								<input type="number" id="codigo" name="codigo" value=" "> <!--identificador de la solicitud para la confirmacion-->
								<h3>RIF de la tienda</h3>
								<input type="number" id="rif" name="rif" value="0"> <!--identificador de la tienda-->
								<h3>Identificador del comprador de la tienda</h3>
								<input type="number" id="comprador" name="comprador" value="0"> <!--identificador del comprador de la tienda-->
								<h3>Fecha en que se realiza el servicio</h3>
								<input type="date" id="fecha" name="fecha" value="<?php echo date("Y")."-".date("m")."-".date("d");?>"> <!--fecha de la solicitud-->
								<h3>Direccion del comprador (solo si el servicio es de solicitud, sino dejelo en blanco)</h3>
								<input  id="direc" name="direc" value="distrito capital"> <!--Direccion del comprador-->
								<h3>Array de los identificadores de los productos (solo si el servicio es de solicitud, sino dejelo en blanco)</h3>
								<textarea id="productos" name="productos">1</textarea> <!--Array de los productos solicitados-->
								
							</center>
							<br>
							<center><button type="button" onclick="Solicitar()">Solicitar</button></center><br>
						</form>
						<p>Fecha en que se vence la solicitud</p>
						<div id="fechafin"></div>
						<p>Costo del envio</p>
						<div id="costo"></div>
						<div id="error"></div>
						<form action="index.php" method="post">
							<center>
								<h3>Crear factura</h3>
								<h3>RIF del emisor de la factura.</h3>
								<input type="text" id="emisor" value="J123456789"> 
								<h3>RIF de la tienda</h3>
								<input type="text" id="receptor" value="J123456788"> 
								<h3>Codigo de la factura (8 digitos)</h3>
								<input type="number" id="factura" value="12345678">
								<h3>Monto</h3>
								<input type="number" id="monto" step="0.01" value="12.12">
								<h3>Fecha de expiración (yyyy-mm-dd)</h3>
								<input type="text" id="fechaEx"  value="2019-12-15">
								<h3>Password</h3>
								<input type="text" id="contra" value="Ra123456$"> 
								<h3>Descripcion (opcional)</h3>
								<input type="text" id="des" value=" "> 
								
							</center>
							<br>
							<center><button type="button" onclick="Factura()">Emitir</button></center><br>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
