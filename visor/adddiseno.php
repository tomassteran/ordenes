<?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include('../config/dbConfig.php');

if (isset($_REQUEST['action']) && !empty($_REQUEST['id'])) {

 $usuario = $_REQUEST['action'];
 $idorden = $_REQUEST['id'];

$modPROF = $db->query("UPDATE live_records SET id_user = '".$usuario."' , modificado = NOW() WHERE ordenp = '".$idorden."' ") ;
$modUSER = $db->query("UPDATE design SET id_design = '".$usuario."', modificacion = NOW() WHERE id_orden = '".$idorden."' ");


}



if (isset($_POST['contactFrmSubmit']) && !empty($_POST['orden']) && !empty($_POST['diseno']) && !empty($_POST['perfilE']) && !empty($_POST['impresoraE']) ) {
	
	$orden = $_POST['orden'];
	$diseno = $_POST['diseno'];
	$perfil = $_POST['perfilE'];
	$impresora = $_POST['impresoraE'];
	$nota = $_POST['notaE'];

	$dataSQL = "SELECT * FROM live_records WHERE ordenp = '".$orden."' ";
	$dataCON = mysqli_query($db, $dataSQL);
	$dataROW = mysqli_fetch_array($dataCON);

	$userSQL = "SELECT * FROM diseno WHERE id = '".$dataROW['id_user']."' ";
	$userCON = mysqli_query($db, $userSQL);
	$userROW = mysqli_fetch_assoc($userCON);

	$id_user = $userROW['id'];

	$machSQL = "SELECT * FROM machote WHERE id_orden = '".$orden."' ";
	$machCON = mysqli_query($db, $machSQL);
	$machROW = mysqli_num_rows($machCON);

	if ($machROW == 0 ) {

		$cantidad = '1';

		$inser = $db->query("INSERT INTO machote (id_orden, id_design, diseno, perfil, impresora, comentario, cantidad, estado, tiempo_enviado) VALUES ('$orden', '$id_user', '$diseno', '$perfil', '$impresora', '$nota', '$cantidad', 'IMPRESION', NOW()) ") or die(mysql_error());
	} elseif ($machROW > 0) {
		$cantSQL = "SELECT * FROM machote WHERE id_orden = '".$orden."'";
		$cantCON = mysqli_query($db, $cantSQL);
		$cantROW = mysqli_fetch_array($cantCON);

		$cantidad = $machROW + '1'; 
		$inser = $db->query("INSERT INTO machote (id_orden, id_design, diseno, perfil, impresora, comentario, cantidad, estado, tiempo_enviado) VALUES ('$orden', '$id_user', '$diseno', '$perfil', '$impresora', '$nota', '$cantidad', 'IMPRESION', NOW()) ") or die(mysql_error());
		echo $cantidad;
	}
} else if(isset($_POST['addorden'])) {
	$inser = $db->query("UPDATE machote SET estado = 'ENTREGADO', tiempo_recibido = NOW() WHERE id_orden = '".$_POST['addorden']."' ");
}

?>