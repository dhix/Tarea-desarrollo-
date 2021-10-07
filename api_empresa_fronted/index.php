<!doctype html>
<html lang="en">
  <head>
	<title>Front-end desarrollo web</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
  <body background="imgs/fondo_index.jpg" style="background-size: cover; background-repeat: no-repeat; margin: 0px; height: 100%;">
  	<div class="container" style="padding:20px; background-color: #F0B12B; color:white; margin-top: 2em;">
	  
	  <h1 class="text-center"> Formulario Empleados </h1>

	</div>
	  <div class="container" style="padding:5px; background-color: white; ">

</body>



	<div class="container">
		<form action="" method="POST">			
			<div class="row">
				<div class="col-md-6">
					<label for="lbl_codigo" class="form-label"><b>Codigo</b></label>
					<input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="E001" required>
				</div>
				<div class="col-md-6">
					<label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
					<input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombre1 Nombre2" required>
				</div>
			</div>

			<div class="row" style="margin-top: 1em;">
				<div class="col-md-6">
					<label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
					<input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellido1 Apellido2" required>
				</div>

				<div class="col-md-6">
					<label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
					<input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="numero telefono 12345678" required>
				</div>
			</div>

			<div class="row" style="margin-top: 1em;">
				<div class="col-md-12">
					<label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
					<input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="lugar----casa---" required>
				</div>
			</div>

			<div class="row" style="margin-top: 1em;">
				<div class="col-md-6">
					<label for="lbl_puesto" class="form-label"><b>Puesto</b></label>
					<select class="form-select" name="drop_puesto" id="drop_puesto" required>
						<option value=0>-- PUESTOS--</option>
						<?php
							$arrContextOptions = array(
								"ssl" => array(
								"verify_peer" => false,
								"verify_peer_name" => false,
								),
							);
							$url = "https://localhost:5001/api/empleados";  
							$json = file_get_contents($url, false, stream_context_create($arrContextOptions));
							$datos = json_decode($json, true);

							for ($i = 0; $i < count($datos); $i++) {
								echo "<option value=". $i .">". $datos[$i]['id_puesto'] ."</option>";
							}
						?>
					</select>
				</div>
				<div class="col-md-6">
					<label for="lbl_fn" class="form-label"><b>Fecha de Nacimiento</b></label>
					<input type="date" name="txt_fn" id="txt_fn" class="form-control" placeholder="dd/mm/aaaa" required>
				</div>
			</div>

			<div class="text-center" style="margin-top: 1em;">
				<input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar">
			</div>
		</form>
		<br>

		<table class="table table-striped table-inverse table-responsive" style="margin-top: 2em;">
			<thead class="thead-inverse">
				<tr>
					<th>Codigo</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>Nacimiento</th>
					<th>Puesto</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>

				<?php
				$arrContextOptions = array(
					"ssl" => array(
						"verify_peer" => false,
						"verify_peer_name" => false,
					),
				);
				$url = "https://localhost:5001/api/empleados";  
				$json = file_get_contents($url, false, stream_context_create($arrContextOptions));
				$datos = json_decode($json, true);

				for ($i = 0; $i < count($datos); $i++) {
					echo "<tr>";
						echo "<td>" . $datos[$i]["codigo"] . "</td>";
						echo "<td>" . $datos[$i]["nombres"] . "</td>";
						echo "<td>" . $datos[$i]["apellidos"] . "</td>";
						echo "<td>" . $datos[$i]["direccion"] . "</td>";
						echo "<td>" . $datos[$i]["telefono"] . "</td>";
						echo "<td>" . $datos[$i]["fecha_nacimiento"] . "</td>";
						echo "<td>" . $datos[$i]["id_puesto"] . "</td>";
						echo "<td><a href='editar.php?id=" . $datos[$i]["id_empleado"] . "' class='btn btn-warning'>Editar</a> 
                    	<a href='eliminar.php?id=" . $datos[$i]["id_empleado"] . "' class='btn btn-danger'>Eliminar</a></td>";
					echo "</tr>";
				}

				?>
			</tbody>
		</table>
	</div>

	<?php
	if (isset($_POST["btn_agregar"])) {
		include 'agregar.php';
	}
	?>

	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>0