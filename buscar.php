<!--
/*---------------------------------------------------------------------------------------------
 *  Juan José Rubio Iglesias
 *  Practica de PHP de mantenimiento de tablas con mysqli
 *  buscar.php - ventana para mostrar departamentos buscando por descripcion
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
		<form action="buscar.php" method="post">

			<i class="material-icons">search</i> <!--<input type="text" name="patron" placeholder="Descripcion">-->
			<!-- Campo descripcion -->
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" type="text" name="patron" id="inputPatron">
				<label class="mdl-textfield__label" for="inputPatron">Descripcion</label>
			</div>
			 <input type="submit" name="buscar" value="Buscar" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
			<button formaction="insertar.php" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Nuevo departamento</button>

		</form>

	 <?php

		if(isset($_POST['buscar']))
		{

			print "
				<table class=\"mdl-data-table mdl-js-data-table\">
				<thead>
				<tr>
					<th class='mdl-data-table__cell--non-numeric'>Codigo</th>
					<th class='mdl-data-table__cell--non-numeric'>Descripcion</th>
					<th>Modificar</th>
					<th>Eliminar</th>
				</tr>
				</thead>
				<tbody>
			";


			$db = new mysqli();

			//libreria con las variables con el host usuario password y base de datos
			include_once("conexiondb.php");

			//Conectamos con la base de datos
			$db->connect($hostdb,$usuariodb,$passdb,$nombredb);

			//Comprobamos si hay errores y si se detectan errores mostramos el codigo de error y la descripcion
			if($db->connect_errno)
			{
				echo "error al conectarse a la base de datos, error nº ".$db->connect_errno." ".$db->connect_error;
			} else {

				$str_query="select * from Departamento where instr(descDepartamento,\"".$_POST["patron"]."\")";

				// db->query devuelve false en caso de encontrar un error en caso contraro devuelve un objeto "mysqli_result" http://php.net/manual/es/mysqli.query.php
				if($resultado = $db->query($str_query))
				{
					while($obj = $resultado->fetch_object()){
						echo("<tr><td class='mdl-data-table__cell--non-numeric'>$obj->codDepartamento</td><td class='mdl-data-table__cell--non-numeric'>$obj->descDepartamento</td><td><a href=\"modificar.php?codDepartamento=".$obj->codDepartamento."\">Modificar</a></td><td><a href=\"eliminar.php?codDepartamento=".$obj->codDepartamento."\"><i class=\"material-icons\">delete</i></a></td></tr>");
					}
					echo "Se han encontrado $resultado->num_rows resultados.";
				}else{
					echo "error al ejecutar la consulta $resultado->connect_error";
				}
			}
		}
	?>
	</tbody>
	</table>

</div>
</body>
</html>
