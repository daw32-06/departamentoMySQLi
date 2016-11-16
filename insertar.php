<!--
/*---------------------------------------------------------------------------------------------
 *  Juan José Rubio Iglesias
 *  Practica de PHP de mantenimiento de tablas con mysqli
 *  insertar.php - ventana para crear un nuevo departamento
 *--------------------------------------------------------------------------------------------*/
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Departamento</title>
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


	<form action="insertar.php" method="post" >
		<div class="mdl-textfield mdl-js-textfield">
			<input class="mdl-textfield__input" type="text" name="codDepartamento" id="inputCod" maxlength="3">
			<label class="mdl-textfield__label" for="inputCod">Codigo del departamento</label>
		</div>
		<br>
		<div class="mdl-textfield mdl-js-textfield">
			<textarea maxlength="255"  class="mdl-textfield__input" type="text" rows= "3" id="inputDesc" name="descDepartamento" ></textarea>
			<label class="mdl-textfield__label" for="inputDesc">Descripcion del departamento</label>
		  </div>


		<br>
		<input type="submit" name="enviar" value="Crear" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
		<button formaction="buscar.php" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Volver</button>
	</form>


	<?php
		// Comprobamos que se ha enviado al menos una vez el formulario
		if(isset($_POST['enviar']))
		{
			//Patron para la comprobacion de solo letras en el campo de descDepartamento
			$patronSoloLetras = "/^[a-zA-Z]+$/";

			// Validamos el codigo de departamento (No vacio, que cumpla con el patron y que el tamaño sea de 3 caracteres)
			if(!empty($_POST['codDepartamento']) && !empty($_POST['descDepartamento']) && preg_match($patronSoloLetras, $_POST['codDepartamento']) && strlen($_POST['codDepartamento'])==3)
			{
				$db = new mysqli();

				//libreria con las variables con el host usuario password y base de datos
				include_once("conexiondb.php");

				$db->connect($hostdb,$usuariodb,$passdb,$nombredb);

				if($db->connect_errno)
				{
					echo "error al conectarse a la base de datos, error nº ".$db->connect_errno.", ".$db->connect_error;
				} else {

					$str_query="insert into Departamento values (\"".$_POST['codDepartamento']."\", \"".$_POST['descDepartamento']."\")";

					if($db->query($str_query))
					{
						echo "<script>alert('Campo modificado correctamente'); window.location.href='buscar.php';</script>";
					}else{
						echo "<script>alert('Error al realizar el cambio');</script>";
					}
				}
			} else {
				print("Datos incorrectros o vacios");
			}
		}



	?>
</div>
</body>
</html>
