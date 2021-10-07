<?php
	$arrContextOptions = array(
		"ssl" => array(
			"verify_peer" => false,
			"verify_peer_name" => false,
		),
	);
	$url = "https://localhost:5001/api/empleados/";  
	$json = file_get_contents($url, false, stream_context_create($arrContextOptions));
	$datos = json_decode($json, true);
?>

<!doctype html>
<html lang="en">
  <head>
	<title> EMPLEADOS</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
	  	<br>
	  	<h1 class="text-center"> Editar Empleado </h1>

	  <div class="container">
		  <form class="d-flex" action="" method="POST" autocomplete="off">
			  <div class="col">
				
                <input type="text" name="id" id="id" value="<?php $datos[1]["id_empleado"] ?>" disabled>
			  	<div class="mb-3">
					<label for="lbl_codigo" class="form-label"><b>Codigo</b></label>
					<input type="text" name="txt_codigo" id="txt_codigo" class="form-control" value="<?php $datos[1]["codigo"] ?>">
				</div>

				<div class="mb-3">
					<label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
					<input type="text" name="txt_nombres" id="txt_nombres" class="form-control" value="<?php $datos[1]["nombres"] ?>">
				</div>

				<div class="mb-3">
					<label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
					<input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" value="<?php $datos[1]["apellidos"] ?>">
				</div>

				<div class="mb-3">
					<label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
					<input type="text" name="txt_direccion" id="txt_direccion" class="form-control" value="<?php $datos[1]["direccion"] ?>">
				</div>

				<div class="mb-3">
					<label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
					<input type="number" name="txt_telefono" id="txt_telefono" class="form-control" value="<?php $datos[1]["telefono"] ?>">
				</div>
                
				<div class="mb-3">
				  <label for="lbl_puesto" class="form-label"><b>Puesto</b></label>
				  <select class="form-select" name="drop_puesto" id="drop_puesto" required>
					
				  <option value="<?php $datos[1]["id_puesto"] ?>"><?php $datos[1]["id_puesto"] ?></option>

				  </select>
				</div>

				<div class="mb-3">
					<label for="lbl_fn" class="form-label"><b>Fecha de Nacimiento</b></label>
					<input type="date" name="txt_fn" id="txt_fn" class="form-control" value="<?php $datos[0]["fecha_nacimiento"] ?>">
				</div>

				<div class="mb-3">
                    
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-success" value="Editar">
				</div>
			  </div>
		  </form>
          
	  </div>

      <?php
		if(isset($_POST["btn_editar"])){	
			include 'refrescar.php';
		}

	?>

	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
