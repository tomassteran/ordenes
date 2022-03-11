<?php

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require("config/dbConfig.php");


$sql2 = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
if ($resulta = mysqli_query($db, $sql2)) {
    while ($row2 = mysqli_fetch_assoc($resulta)) {
        $user = $row2['username'];
        $iduser = $row2['id'];
        $tipo_usuario = $row2['tipo_usuario'];
    }
}

if ($tipo_usuario != '0') {
    if ($tipo_usuario == '1') { 
        header("location: zone\diseno.php");
        exit;
    } elseif ($tipo_usuario == '2') {
        header("location: zone\impresion.php");
        exit;
    } elseif ($tipo_usuario == '3') {
        header("location: zone\sublimacion.php");
        exit;
    } elseif ($tipo_usuario == '4') {
        header("location: zone\confeccion.php");
        exit;
    } elseif ($tipo_usuario == '5') {
        header("location: zone\despacho.php");
        exit;
    } elseif ($tipo_usuario == '6') {
        header("location: zone\despachado.php");
        exit;
    }
} 
if ($tipo_usuario == '0') { 

$query = "SELECT count(*) as total from live_records WHERE estado_op = 1";

if ($result = mysqli_query($db, $query)) {

    $data=mysqli_fetch_assoc($result);

    //echo $data['total'];

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JORGE PRO 0.1</title>


    <link type="text/css" href="assets/css/vendor-bootstrap-datepicker.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-morris.css" rel="stylesheet">

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- App CSS -->
    <link type="text/css" href="assets/css/app.css" rel="stylesheet">
    <link type="text/css" href="assets/css/app.rtl.css" rel="stylesheet">

    <!-- Simplebar -->
    <link type="text/css" href="assets/vendor/simplebar.css" rel="stylesheet">
    <style type="text/css" media="screen">
        .loginbar {
            width: 250px;
            height: 25px;
            display: flex;
            justify-content: center;
            color: orange;
        } 
    </style>
</head>

<body>
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-fullbleed data-push data-responsive-width="992px" data-has-scrolling-region>

        <div class="mdk-drawer-layout__content">
            <!-- header-layout -->
            <div class="mdk-header-layout js-mdk-header-layout  mdk-header--fixed  mdk-header-layout__content--scrollable">
                <!-- header -->
                <div class="mdk-header js-mdk-header bg-primary" data-fixed>
                    <div class="mdk-header__content">

                        <nav class="navbar navbar-expand-md bg-primary navbar-dark d-flex-none">
                            <button class="btn btn-link text-white pl-0" type="button" data-toggle="sidebar">
    <i class="material-icons align-middle md-36">short_text</i>
  </button>
                            <div class="page-title m-0">Departamento de impresion</div>

                            <div class="collapse navbar-collapse" id="mainNavbar">
                                <ul class="navbar-nav ml-auto align-items-center">
                                    <li class="">
                                        <div class="form-group m-0" style="padding-top:30px;">
                                            
                                        </div>
                                    </li>
                                    
                                    <li class="nav-item dropdown notifications d-flex align-self-center align-items-center" id="navbarNotifications">
                                        <a href="#" class="nav-link dropdown-toggle " data-toggle="dropdown" aria-expanded="false">
          <i class="material-icons align-middle">notifications</i>
        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsDropdown" id="notificationsDropdown">
                                            <ul class="nav nav-tabs-notifications d-flex px-0" id="notifications-ul" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications" aria-selected="true">Notifications</a>
                                                </li>                                                
                                            </ul>
                                            <div class="tab-content" id="notifications-tabs">
                                                <div class="tab-pane fade show active" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                                                    <ul class="list-group list-group-flush">

                                                        <?php 
                                                        $notiSQL = "SELECT id, ordenp, name, modificado, now() as horaActual, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, modificado, now())) as secondsDiff FROM live_records ORDER by secondsDiff ASC LIMIT 4 ";
                                                $notiCons = mysqli_query($db, $notiSQL);
                                                while ($notiRow = mysqli_fetch_array($notiCons)) {
                                                ?>

                                                        <li class="list-group-item">
                                                            <div class="w-100">
                                                                <a href="#"><?php echo $notiRow['ordenp']; ?></a> <?php echo $notiRow['name']; ?></div>
                                                            <div class="w-100 text-muted"><?php echo $notiRow['secondsDiff']; ?></div>
                                                        </li>
                                                    <?php } ?>                                                        
                                                        
                                                    </ul>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item nav-divider">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link dropdown-toggle dropdown-clear-caret" data-toggle="sidebar" data-target="#user-drawer">
          MENU
          
        </a>
                                        </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>

                <!-- content -->
                <div class="mdk-header-layout__content top-navbar mdk-header-layout__content--scrollable h-100">
                    <!-- main content -->
                    <div class="container-fluid">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-6">
                                <h1 class="h2 mb-0">Departamento de impresion</h1>
                                <ol class="breadcrumb p-0">
                                    <li>
                                        <a href="index.php">Dashboards</a>
                                    </li>
                                    <li class="text-muted">
                                        impresion
                                    </li>
                                </ol>
                            </div>                            
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-md-6">
                                <form name="contact" action="">
                                    <div class="loginbar">                                                
                                        <input type="text" name='addorden' id='addorden' placeholder='#Orden' class="form-control" value="" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">  
                                        <input type="submit" name="submit" class="button" id="submit_btn" value="CLICK" />
                                    </div>
                                </form>
                            </div>                            
                        </div>


                                              
                        
                        <h1>Ordenes</h1>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr class="bg-fade">                                           
                                            <th>#ORDEN</th>
                                            <th>DISEÑO</th>
                                            <th>CANTIDAD</th>
                                            <th>FECHA PROCESADA</th>
                                            <th>FECHA DESPACHO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $disenoSQL = "SELECT * FROM `live_records` WHERE designation LIKE 'IMPRESION%' AND estado_op = 1 AND categoria NOT LIKE 'evento%' ";
                                        $disenoCON = mysqli_query($db, $disenoSQL);
                                        $disenoCNT = mysqli_num_rows($disenoCON);
                                        if ($disenoCNT == 0) {
                                            echo "<tr><td>SIN REGISTRO</td></tr>";
                                        } else {


                                        while ($disenoROW = mysqli_fetch_assoc($disenoCON)) { 

                                                    $desigSQL = "SELECT * FROM `design` WHERE id_orden = '".$disenoROW['ordenp']."' ";
                                                    $desigCON = mysqli_query($db, $desigSQL);
                                                    
                                                    if ($desigROW = mysqli_fetch_array($desigCON)) {
                                                        
                                                        $usernSQL = "SELECT * FROM `diseno` WHERE id = '".$desigROW['id_design']."' ";
                                                        $usernCON = mysqli_query($db, $usernSQL);
                                                        if ($usernROW = mysqli_fetch_array($usernCON)) {
                                                                                                            
                                            ?>
                                        <tr>                                            
                                            <td class="align-middle"><strong><?php echo $disenoROW['ordenp']; ?></strong></td>
                                            <td class="align-middle"><i><?php echo $disenoROW['name'] . '   -   ' ; ?></i><span><b> (<?php echo $usernROW['first_name'] . ' ' . $usernROW['last_name'] ; ?>)</b></span></td>
                                            <td class="align-middle"><strong><?php echo $disenoROW['age']; ?></strong></td>
                                            <td class="align-middle"><strong><?php echo $disenoROW['skills']; ?></strong></td>
                                            <td class="align-middle"><strong><?php echo $disenoROW['address']; ?></strong></td>
                                            
                                        </tr>
                                    <?php } } } }?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                        <h1>EVENTO</h1>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr class="bg-fade">                                           
                                            <th>#ORDEN</th>
                                            <th>DISEÑO</th>
                                            <th>CANTIDAD</th>
                                            <th>FECHA PROCESADA</th>
                                            <th>FECHA DESPACHO</th>
                                            <th>TIEMPO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $disenoSQL = "SELECT * FROM live_records WHERE designation LIKE 'IMPRESION%' AND estado_op = 1 AND categoria LIKE 'evento%'";
                                        $disenoCON = mysqli_query($db, $disenoSQL);
                                        $disenoCNT = mysqli_num_rows($disenoCON);
                                        if ($disenoCNT == 0) {
                                            echo "<tr><td>SIN REGISTRO</td></tr>";
                                        } else {

                                        while ($disenoROW = mysqli_fetch_assoc($disenoCON)) { 
                                            
                                            
                                            $userSQL = "SELECT * FROM design WHERE id_orden = '".$disenoROW['ordenp']."' ";
                                            $userCON = mysqli_query($db, $userSQL);
                                            if ($userROW = mysqli_fetch_assoc($userCON)) {
                                                

                                                $designSQL = "SELECT * FROM diseno WHERE id = '".$userROW['id_design']."' " ;
                                                $designCON = mysqli_query($db, $designSQL);
                                                if ($desingROW = mysqli_fetch_assoc($designCON)) {

                                                    $tiempoSQL = "SELECT id, ordenp, name, designation, modificado, now() as horaActual, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, modificado, now())) as secondsDiff FROM live_records WHERE designation LIKE 'IMPRESION%' ";
                                                $tiempoCons = mysqli_query($db, $tiempoSQL);
                                                if ($tiempoRow = mysqli_fetch_array($tiempoCons)) {
                                            ?>
                                        <tr>                                            
                                            <td class="align-middle" style="background-color: red; color: white;"><strong><?php echo $disenoROW['ordenp']; ?></strong></td>
                                            <td class="align-middle" style="background-color: red; color: white;"><i><?php echo $disenoROW['name']; ?></i><span> - (<strong> <?php echo $desingROW['first_name'] . ' ' . $desingROW['last_name']; ?></strong> )</span></td>
                                            <td class="align-middle" style="background-color: red; color: white;"><strong><?php echo $disenoROW['age']; ?></strong></td>
                                            <td class="align-middle" style="background-color: red; color: white;"><strong><?php echo $disenoROW['skills']; ?></strong></td>
                                            <td class="align-middle" style="background-color: red; color: white;"><strong><?php echo $disenoROW['address']; ?></strong></td>
                                            <td class="align-middle" style="background-color: red; color: white;">
                                                    <?php echo $tiempoRow['secondsDiff']; ?>                                                
                                            </td>
                                        </tr>
                                    <?php } } } } }?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                        <h1>Reposiciones</h1>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr class="bg-fade">                                           
                                            <th>#ORDEN</th>
                                            <th>DISEÑO</th>
                                            <th>PIEZA</th>
                                            <th>TALLA</th>
                                            <th>REFERENCIA</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $impSQL = "SELECT * FROM `reposicion` WHERE estado = 1";
                                        $impCON = mysqli_query($db, $impSQL);

                                        $impCNT = mysqli_num_rows($impCON);
                                        if ($impCNT == 0) {
                                            echo "<tr><td>SIN REGISTRO</td></tr>";
                                        } else {
                                        while ($impROW = mysqli_fetch_array($impCON)) {

                                                                     
                                        ?>
                                        <tr>                                            
                                            <td class="align-middle"><strong><?php echo $impROW['id_orden']; ?></strong></td>
                                            <td class="align-middle"><i><?php echo $impROW['diseno']; ?></i><span><b></b></span></td>
                                            <td class="align-middle"><strong><?php echo $impROW['pieza']; ?></strong></td>
                                            <td class="align-middle"><strong><?php echo $impROW['talla']; ?></strong></td>
                                            <td class="align-middle"><strong><?php echo $impROW['referencia']; ?></strong></td>
                                            <td class="align-middle"><strong><?php echo $impROW['modificado']; ?></strong></td>
                                        </tr>
                                    <?php } }?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>

                        <h1>Machotes</h1>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr class="bg-fade">                                           
                                            <th>#ORDEN</th>
                                            <th>DISEÑO</th>
                                            <th>ESTATUS</th>
                                            <th>TIEMPO EN PROCESO</th>
                                            <!--<th>TIEMPO EN RIP</th>  Version 0.2 colocar tiempo que se tomo en rippear el archivo -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $machSQL = "SELECT * FROM machote WHERE estado != 'ENTREGADO'";
                                            $machCON = mysqli_query($db, $machSQL);

                                            $machCNT = mysqli_num_rows($machCON);
                                            if ($machCNT == 0) {
                                                echo "<tr><td>SIN REGISTRO</td></tr>";
                                                } else {
                                            while ($machROW = mysqli_fetch_array($machCON)) {

                                            $ordSQL = "SELECT * FROM live_records WHERE ordenp = '".$machROW['id_orden']."' ";
                                            $ordCON = mysqli_query($db, $ordSQL);
                                            if ($ordROW = mysqli_fetch_assoc($ordCON)) {

                                                $desSQL = "SELECT * FROM design WHERE id_orden = '".$machROW['id_orden']."' ";
                                                $desCON = mysqli_query($db, $desSQL);
                                                if ($desROW = mysqli_fetch_assoc($desCON)) {
                                                    
                                                    $usuarioSQL = "SELECT * FROM diseno WHERE id = '".$desROW['id_design']."' ";
                                                    $usuarioCON = mysqli_query($db, $usuarioSQL);
                                                    if ($usuarioROW = mysqli_fetch_assoc($usuarioCON)) {

                                                        $tiempoSQL = "SELECT tiempo_enviado, now() as horaActual, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, tiempo_enviado, now())) as secondsDif FROM machote ";
                                                        $tiempoCons = mysqli_query($db, $tiempoSQL);
                                                        if ($tiempoRow = mysqli_fetch_array($tiempoCons)) {
                                        ?>
                                        <tr>                                            
                                            <td class="align-middle"><strong><?php echo $machROW['id_orden']; ?>  </strong></td>
                                            <td class="align-middle"><i><?php echo $machROW['diseno']; ?></i><span> - (<strong><?php echo $usuarioROW['first_name'] . ' ' . $usuarioROW['last_name']; ?></strong> )</span></td>
                                            <td class="align-middle"><?php echo $machROW['estado'] ?><strong></strong></td>
                                            <td class="align-middle">
                                                    <?php echo $tiempoRow['secondsDif']; ?>                                                
                                            </td>
                                           <!-- <td>
                                                <form name="tiempo" action="">
                                                    <div class="loginbar">                                                
                                                        <input type="text" name='tiempoMACH' id='tiempoMACH' placeholder='TIEMPO DE RIPPEAR' class="form-control" value="" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">  
                                                        <input type="submit" name="envio" class="button" id="envio" value="ENVIAR" />
                                                    </div>
                                                </form>
                                            </td>               version 0.2 colocar tiempo que se tarda en rippear       -->
                                        </tr>
                                    <?php } } } } } }?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                        <h1>Unidades incompletas</h1>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr class="bg-fade">                                           
                                            <th>#ORDEN</th>
                                            <th>DISEÑO</th>
                                            <th>TALLA</th>
                                            <th>NOMBRE</th>
                                            <th>NUMERO</th>
                                            <th>ESTATUS</th>
                                            <th>TIEMPO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $incSQL = "SELECT * FROM incompleta WHERE estado != 'COMPLETA'";
                                        $incCON = mysqli_query($db, $incSQL);
                                        $incCNT = mysqli_num_rows($incCON);

                                        if ($incCNT == 0) {
                                            echo "<tr><td>SIN REGISTRO</td></tr>";
                                        } else {
                                        while ($incROW = mysqli_fetch_array($incCON)) {

                                            $timeSQL = "SELECT modificado, now() as horaActual, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, modificado, now())) as secondsDif FROM incompleta ";
                                                        $timeCons = mysqli_query($db, $timeSQL);
                                                        if ($timeRow = mysqli_fetch_array($timeCons)) {
                                                                     
                                        ?>
                                        <tr>                                            
                                            <td class="align-middle"><?php echo $incROW['id_orden'] ; ?></td>
                                            <td class="align-middle"><?php echo $incROW['diseno'] ; ?></td>
                                            <td class="align-middle"><?php echo $incROW['talla'] ; ?></td>
                                            <td class="align-middle"><?php echo $incROW['nombre'] ; ?></td>
                                            <td class="align-middle"><?php echo $incROW['numero'] ; ?></td>
                                            <td class="align-middle"><?php echo $incROW['estado']; ?></td>
                                            <td class="align-middle"><?php echo $timeRow['secondsDif'] ; ?></td>
                                        </tr>
                                    <?php } } }?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- // END drawer-layout__content -->

        <!-- drawer -->
        <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content">
                <div class="mdk-drawer__inner" data-simplebar data-simplebar-force-enabled="true">

                    <nav class="drawer  drawer--dark">
                        <div class="drawer-spacer">
                            <div class="media align-items-center">
                                <a href="index.php" class="drawer-brand-circle mr-2">P</a>
                                <div class="media-body">
                                    <a href="index.php" class="h5 m-0 text-link">JORGE 0.1</a>
                                </div>
                            </div>
                        </div>
                        <!-- HEADING -->
                        <div class="py-2 drawer-heading">
                            Dashboards
                        </div>
                        <!-- MENU -->
                        <ul class="drawer-menu" id="dasboardMenu" data-children=".drawer-submenu">
                            <li class="drawer-menu-item">
                                <a href="index.php">
        <i class="material-icons">poll</i>
        <span class="drawer-menu-text"> INICIO</span>
      </a>
                            </li>
                            <li class="drawer-menu-item">
                                <a href="projects.php">
        <i class="material-icons">dns</i>
        <span class="drawer-menu-text"> PROYECTO</span>
        <span class="badge badge-pill badge-success ml-1"><?php echo $data['total']; ?></span>
      </a>
                            </li>
                            <li class="drawer-menu-item ">
                                <a href="diseno.php">
        <i class="material-icons">format_paint</i>
        <span class="drawer-menu-text"> DISEÑO</span>
      </a>
                            </li>
                            <li class="drawer-menu-item active ">
                                <a href="impresion.php">
        <i class="material-icons">print</i>
        <span class="drawer-menu-text"> IMPRESION</span>
      </a>
                            </li>
                            <li class="drawer-menu-item ">
                                <a href="sublimacion.php">
        <i class="material-icons">burst_mode</i>
        <span class="drawer-menu-text"> SUBLIMACION</span>
      </a>
                            <li class="drawer-menu-item ">
                                <a href="confeccion.php">
        <i class="material-icons">recent_actors</i>
        <span class="drawer-menu-text"> CONFECCION</span>
      </a>
                            </li>
                            <li class="drawer-menu-item ">
                                <a href="terminacion.php">
        <i class="material-icons">assignment_turned_in</i>
        <span class="drawer-menu-text"> TERMINACION</span>
      </a>
                            </li>
                            <li class="drawer-menu-item ">
                                <a href="despacho.php">
        <i class="material-icons">track_changes</i>
        <span class="drawer-menu-text"> DESPACHO</span>
      </a>
                            </li>
                            <li class="drawer-menu-item ">
                                <a href="despachado.php">
        <i class="material-icons">flight_takeoff</i>
        <span class="drawer-menu-text"> DESPACHADO</span>
      </a>
                            </li>
                            <li class="drawer-menu-item ">
                                <a href="inventario.php">
        <i class="material-icons"> airplanemode_active </i>
        <span class="drawer-menu-text"> INVENTARIO</span>
      </a>
                            </li>
                            <!--<li class="drawer-menu-item  ">
                                <a href="events-calendar.php">
        <i class="material-icons">event_available</i>
        <span class="drawer-menu-text"> CALENDARIO</span>
      </a>
                            </li>
                            <li class="drawer-menu-item  ">
                                <a href="charts.php">
        <i class="material-icons">equalizer</i>
        <span class="drawer-menu-text"> ESTADISTICAS</span>
      </a>
                            </li>
                            <li class="drawer-menu-item  ">
                                <a href="ui-tables.php">
        <i class="material-icons">tab</i>
        <span class="drawer-menu-text"> TABLAS</span>
      </a>
                            </li>-->
                        </ul>

                        <!-- HEADING -->
                        

                        <!-- MENU -->
                        <ul class="drawer-menu" id="mainMenu" data-children=".drawer-submenu">
                            <!--<li class="drawer-menu-item">
                                <a href="account.php">
        <i class="material-icons">edit</i>
        <span class="drawer-menu-text">EDITAR PERFIL</span>
      </a>
                            </li>
                            <li class="drawer-menu-item">
                                <a href="forgot-password.php">
        <i class="material-icons">help</i>
        <span class="drawer-menu-text">CAMBIAR CONTRASEÑA</span>
      </a>
                            </li>-->
                        </ul>

                    </nav>
                </div>
            </div>
        </div>
        <!-- // END drawer -->

        <!-- drawer -->
        <div class="mdk-drawer js-mdk-drawer" id="user-drawer" data-position="right" data-align="end">
            <div class="mdk-drawer__content">
                <div class="mdk-drawer__inner" data-simplebar data-simplebar-force-enabled="true">
                    <nav class="drawer drawer--light">
                        <div class="drawer-spacer drawer-spacer-border">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <a href="#" class="h5 m-0">MENU</a>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <!-- MENU -->
                        <ul class="drawer-menu" id="userMenu" data-children=".drawer-submenu">
                            <!--<li class="drawer-menu-item">
                                <a href="account.php">
        <i class="material-icons">lock</i>
        <span class="drawer-menu-text"> EDITAR PERFIL</span>
      </a>
                            </li>-->
                            
                            <li class="drawer-menu-item">
                                <a href="logout.php">
        <i class="material-icons">exit_to_app</i>
        <span class="drawer-menu-text"> SALIR</span>
      </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- // END drawer -->

    </div>
    <!-- // END drawer-layout -->



    <!-- jQuery -->
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

    <!-- Simplebar -->
    <!-- Used for adding a custom scrollbar to the drawer -->
    <script src="assets/vendor/simplebar.js"></script>


    <!-- Vendor -->
    <script src="assets/vendor/Chart.min.js"></script>
    <script src="assets/vendor/moment.min.js"></script>

    <!-- APP -->
    <script src="assets/js/app.js"></script>


    <script src="assets/vendor/dom-factory.js"></script>
    <!-- DOM Factory -->
    <script src="assets/vendor/material-design-kit.js"></script>
    <!-- MDK -->



    <script>
        (function() {
            'use strict';
            // Self Initialize DOM Factory Components
            domFactory.handler.autoInit()


            // Connect button(s) to drawer(s)
            var sidebarToggle = document.querySelectorAll('[data-toggle="sidebar"]')

            sidebarToggle.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    var selector = e.currentTarget.getAttribute('data-target') || '#default-drawer'
                    var drawer = document.querySelector(selector)
                    if (drawer) {
                        if (selector == '#default-drawer') {
                            $('.container-fluid').toggleClass('container--max');
                        }
                        drawer.mdkDrawer.toggle();
                    }
                });
            });
        })();        
    </script>
    <script>
        $( "form" ).on( "submit", function(e) {
    
            var addorden = $('#addorden').val(); //$(this).serialize();
        
            if(addorden.trim() == '' ){
                alert('Por favor ingresar # Orden.');
                $('#addorden').focus();
                return false;
            } else {
                $.ajax({
                    type: "POST",
                    url: "visor/addimpr.php",
                    data: '&addorden='+addorden,
                    success: function () {
                        alert('Orden ' + addorden + ' fue actualizada.');
                        
                    }
                }) 
            }
        });        
    </script>
   
    <script src="assets/vendor/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/vendor/Chart.min.js"></script>
    <script src="assets/vendor/morris.min.js"></script>
    <script src="assets/vendor/raphael.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf@2.5.1/dist/jspdf.es.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.5.23/dist/jspdf.plugin.autotable.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</body>
</html>
<?php 
}?>