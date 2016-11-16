<!--
/*---------------------------------------------------------------------------------------------
 *  Juan José Rubio Iglesias
 *  Practica de PHP de mantenimiento de tablas con mysqli
 *  modificar.php - ventana para modificar un departamento
 *                  recibe como parametro el codigo del departamento mediante GET
 *                  ?codDepartamento=XXX
 *--------------------------------------------------------------------------------------------*/
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- Material design -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
		<script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>
	<!-- Material design -->
	<style>
		body{
			background-image:url(bg.png);
			background-repeat: no-repeat;
			background-position: center;
		}
		#centrado{

			text-align: center;
			margin-right: auto;
			margin-left: auto;
		}


		table{
			margin-left: auto;
			margin-right: auto;
			min-width:650px;
		}
	</style>
</head>

<body>
<div id="centrado">
	<?php
		//libreria con las variables con el host usuario password y base de datos
		include_once("conexiondb.php");

		// Comprobamos si recibimos por parametro el codigo del departamento
		if(isset($_GET['codDepartamento']))
		{

			$db = new mysqli();
			$db->connect($hostdb,$usuariodb,$passdb,$nombredb);
			if($db->connect_errno)
			{
				echo "Error al conectarse a la base de datos, error nº ".$db->connect_errno." ".$db->connect_error;
			} else {

				$str_query="select * from Departamento where codDepartamento='".$_GET['codDepartamento']."'";


				if($resultado = $db->query($str_query))
				{
					$obj = $resultado->fetch_object();

					//Mostramos los campos del input con sus respectivos valores de la base de datos
					print" <form action=\"modificar.php\" method=\"post\" >

							<div class='mdl-textfield mdl-js-textfield'>
								<input readonly class='mdl-textfield__input' type='text' name='codDepartamento' id='inputCod' maxlength='3' value=\"$obj->codDepartamento\" >
							</div>

							<br>
							<div class='mdl-textfield mdl-js-textfield'>
								<textarea maxlength='255'  class='mdl-textfield__input' type='text' rows= '3' id='inputDesc' name='descDepartamento' >$obj->descDepartamento</textarea>
								<label class='mdl-textfield__label' for='inputDesc'></label>

							</div>
							<br>
							<input type='submit' name='enviar' value='Modificar' class='mdl-button mdl-js-button mdl-button--raised mdl-button--colored'>
							<button formaction='buscar.php' class='mdl-button mdl-js-button mdl-button--raised mdl-button--colored'>Volver</button>
							</form>";

				}else{
					echo "Error al ejecutar la consulta es probable que el campo no exista";
					echo "<button onclick='window.location.href=\"buscar.php\"'>Volver</button>";

				}
			}
		}else{
			echo "¿Que intentas hacer?";
		}


	   if(isset($_POST['enviar']))
		{

			$db = new mysqli();
			$db->connect($hostdb,$usuariodb,$passdb,$nombredb);

			if($db->connect_errno)
			{
				echo "error al conectarse a la base de datos, error nº ";
			} else {

				$str_query="UPDATE Departamento SET descDepartamento=\"".$_POST['descDepartamento']."\" WHERE codDepartamento=\"".$_POST['codDepartamento']."\"";
				//echo "<br>".$str_query;

				//Comprobamos si se ha podido ejecutar la consulta
				if($db->query($str_query))
				{
					//Cerramos la conexion con la base de datos, mostramos un mensaje al usuario y volvemos a la ventana de busqueda
					$db->close();
					echo "<script>alert('Campo modificado correctamente'); window.location.href='buscar.php';</script>";


				}else{
					echo "<script>alert('Error al realizar el cambio'); window.location.href=buscar.php;</script>";

				}
			}
		}



	?>
</div>
</body>
</html>
