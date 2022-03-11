<?php
include('../config/dbConfig.php');

echo $ordeno = $_POST['addorden'];

$qry = $db->query("UPDATE live_records SET estacion = '4', designation = 'SUBLIMACION'  WHERE ordenp = $ordeno ");

if(isset($_POST['contactFrmSubmit']) && !empty($_POST['orden']) && !empty($_POST['diseno']) && !empty($_POST['Tela']) && !empty($_POST['Piezas']) && !empty($_POST['Talla']) && !empty($_POST['Referencia'])) {
     echo $orden = $_POST['orden'];
     echo $diseno = $_POST['diseno'];
     echo $tela = $_POST['Tela'];
     echo $piezas = $_POST['Piezas'];
     echo $talla = $_POST['Talla'];
     echo $referencia = $_POST['Referencia'];

     $repSQL = $db->query("INSERT INTO reposicion (id_orden, diseno, tela, pieza, talla, referencia, estado, modificado) VALUES ('$orden', '$diseno', '$tela', '$piezas', '$talla', '$referencia', '1', NOW()) "); 
}
?>