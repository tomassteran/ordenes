<?php

session_start();

include("../config/dbConfig.php");

if (isset($_POST['addorden'])) {
	$ordeno = $_POST['addorden'];

	$qry = $db->query("UPDATE live_records SET estacion = '8', designation = 'DESPACHADO' WHERE ordenp = $ordeno ");
} elseif (isset($_POST['contactFrmSubmit']) && !empty($_POST['orden']) && !empty($_POST['diseno']) && !empty($_POST['talla'])) {
	$orden = $_POST['orden'];
	$diseno = $_POST['diseno'];
	$talla = $_POST['talla'];

	if ($_POST['nombre'] == '') {
		$nombre = 'N/A';
	} else {
		$nombre = $_POST['nombre'];
	}
	if ($_POST['numero'] == '') {
		$numero = 'N/A';
	} else {
		$numero = $_POST['numero'];
	}

	$insert = $db->query("INSERT INTO incompleta (id_orden, diseno, nombre, numero, talla, estado, modiificado) VALUES ('$orden', '$diseno', '$nombre', '$numero', '$talla', 'INCOMPLETA', NOW()) ");

}

?>