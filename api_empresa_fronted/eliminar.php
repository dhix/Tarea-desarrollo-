<?php
	$id_empleado = utf8_decode($_POST["id_empleado"]);
	
	$arrContextOptions=array(
		"ssl"=>array(
			"verify_peer"=>false,
			"verify_peer_name"=>false,
		),
	);

	$url = "https://localhost:5001/api/empleados/";  /*Este es para verlos todos*/
	$json = file_get_contents($url, false, stream_context_create($arrContextOptions));

	echo "$json";
?>