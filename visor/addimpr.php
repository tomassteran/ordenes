<?php
include('../config/dbConfig.php');


    $ordeno = $_POST['addorden'];

    $qry = $db->query("UPDATE live_records SET estacion = '3', designation = 'IMPRESION'  WHERE ordenp = $ordeno ");

?>