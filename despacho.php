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



//Semana anterior

 $semanaAnterior = date('W', strtotime('-1 week'));

//Semana Actual

$semanaActual = date('W', strtotime('0 week'));
   
//Mes anterior
$mes_anterior = date('m', strtotime('-1 month'));




$fecha = date("Y-m-d") ;
$diaSiguienteMedianoche = date("Y-m-d", strtotime("+1 day", strtotime($fecha)));

// Dia actual
$sqlQuery = "SELECT * FROM `live_records` WHERE `skills` BETWEEN '".$fecha."' AND '".$diaSiguienteMedianoche."' AND `estado_op` = '1' " ;

$hoydia['totalAge'] = '0';
$resultado = mysqli_query($db, $sqlQuery);
    if ($row_cnt = mysqli_num_rows($resultado) ) {
         $row_cnt;

         $sqlQuery2 = "SELECT SUM(age) as totalAge FROM `live_records` WHERE `skills` BETWEEN '".$fecha."' AND '".$diaSiguienteMedianoche."' AND `estado_op` = '1' " ;
         //$sqlQuery2 = "SELECT SUM(age) as totalAge FROM `live_records` WHERE `skills` = '".$fecha."' AND `estado_op` = ''"
         $resultado3 = mysqli_query($db, $sqlQuery2);
         if ($hoydia = mysqli_fetch_assoc($resultado3)) {
            if (empty($hoydia['totalAge'])) {
                $hoydia['totalAge'] = '0';
            } else {
                $hoydia['totalAge'];
            }
        }         
    }


// Semana anterior
$SQLsemana = "SELECT * FROM  `live_records` WHERE `semana` = '".$semanaAnterior."' AND `estado_op` = '1' ";
    $consult = mysqli_query($db, $SQLsemana);
    if ($row_cnt2 = mysqli_num_rows($consult)) {
        
        $SQLsemana2 = "SELECT SUM(age) as totalAge FROM `live_records` WHERE `semana` = '".$semanaAnterior."' AND `estado_op` = '1' " ;
        $row = mysqli_query($db, $SQLsemana2);
        if ($consultMes = mysqli_fetch_assoc($row)) {
            $consultMes['totalAge'];
        }
    }

// Mes Anterior

$SQLmes = "SELECT * FROM `live_records` WHERE YEAR(skills) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(skills) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND estado_op = '1' ";
    $consultas = mysqli_query($db, $SQLmes);
    if ($row_cnt3 = mysqli_num_rows($consultas)) {
        
        $SQLmes2 = "SELECT SUM(age) as totalAge FROM `live_records` WHERE YEAR(skills) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(skills) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND estado_op = '1' ";
        $row0 = mysqli_query($db, $SQLmes2);
        if ($mes = mysqli_fetch_assoc($row0) ) {
           $mes['totalAge']; 
        }
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

        <!-- Modal Header -->

        <div class="modal fade" id="modalForm" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ordenes incompletas</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Cerrar</span>
                        </button>
                    </div>
                    <!-- Modal Body --> 
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form role="form">
                            <div classs="form-group">
                                <label for="orden"># Orden</label>
                                <input type="text" class="form-control" id="orden" placeholder="# Orden" />
                            </div>
                            <div class="form-group">
                                <label for="diseno">Diseño</label>
                                <input type="text" class="form-control" id="diseno" placeholder="# Diseno" />
                            </div>
                            <div class="form-group">
                                <label for="talla">Talla</label>
                                <input type="text" class="form-control" id="talla" placeholder="Talla" />
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre" />
                            </div>
                            <div class="form-group">
                                <label for="numero">Numero</label>
                                <input type="text" class="form-control" id="numero" placeholder="Numero" />
                            </div>
                        </form>
                    </div>
                    
                    <!-- Modal Footer -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">ENVIAR</button>
                    </div>
                </div>
            </div>            
        </div>

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
                            <div class="page-title m-0">Departamento de despacho</div>

                            <div class="collapse navbar-collapse" id="mainNavbar">
                                <ul class="navbar-nav ml-auto align-items-center">
                                    <li class="nav-item nav-link">
                                        <div class="form-group m-0">
                                            
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
          <img src="../../../pbs.twimg.com/profile_images/928893978266697728/3enwe0fO_400x400.jpg" class="img-fluid rounded-circle ml-1" width="35"
            alt="">
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
                                <h1 class="h2 mb-0">Departamento de despacho</h1>
                                <ol class="breadcrumb p-0">
                                    <li>
                                        <a href="index.php">Dashboards</a>
                                    </li>
                                    <li class="text-muted">
                                        Despacho
                                    </li>
                                </ol>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-ms-1">
                                <div class="card">
                                    <form name="contact" action="">
                                        <div class="loginbar">
                                            <input type="text" name="addorden" id="addorden" placeholder="# Orden" class="form-control" value="" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode >57) event.returnValue = false;">
                                            <input type="submit" name="submit" class="button" id="submit_btn" value="CLICK" />
                                        </div>
                                    </form>
                            <!--    <div class="card-header d-flex align-items-center justify-content-between">
                                        <div>

                                        <?php 
                                    //  $impQuery = "SELECT * FROM live_records WHERE designation LIKE 'DISEÑO%' AND estado_op = '1'";
                                        ?>                                           
                                            <a href="print.php" class="btn btn-sm btn-white" target="_blank">
              <i class="material-icons md-18 align-middle">print</i>
              <small class="align-middle text-uppercase">Print</small>
            </a>
                                        </div>
                                    </div>   -->                                
                                </div>
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
                                        $disenoSQL = "SELECT * FROM `live_records` WHERE designation LIKE 'DESPACHO%' AND estado_op = '1'";
                                        $disenoCON = mysqli_query($db, $disenoSQL);
                                        $disenoCNT = mysqli_num_rows($disenoCON);
                                        if ($disenoCNT == 0) {
                                            echo "<tr><td>SIN REGISTRO</td></tr>";
                                        } else {
                                        while ($disenoROW = mysqli_fetch_assoc($disenoCON)) { 

                                                    $desigSQL = "SELECT * FROM `design` WHERE id_orden = '".$disenoROW['ordenp']."' ";
                                                    $desigCON = mysqli_query($db, $desigSQL);
                                                    
                                                    if ($desigROW = mysqli_fetch_assoc($desigCON)) {

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
                                    <?php } } } } ?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-ms-1">
                                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">Ordenes incompletas</button>
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
                                            <td class="align-middle"><strong><?php echo $incROW['diseno'] ; ?></strong></td>
                                            <td class="align-middle"><strong><?php echo $incROW['talla'] ; ?></strong></td>
                                            <td class="align-middle"><strong><?php echo $incROW['nombre'] ; ?></strong></td>
                                            <td class="align-middle"><strong><?php echo $incROW['numero'] ; ?></strong></td>
                                            <td class="align-middle"><?php echo $incROW['estado']; ?></td>
                                            <td class="align-middle"><strong><?php echo $timeRow['secondsDif'] ; ?></strong></td>
                                        </tr>
                                    <?php } } } ?>
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
                            <li class="drawer-menu-item ">
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
                            <li class="drawer-menu-item ">
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
                            <li class="drawer-menu-item active ">
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
                                <img src="../../../pbs.twimg.com/profile_images/928893978266697728/3enwe0fO_400x400.jpg" class="img-fluid rounded-circle mr-2" width="35" alt="">
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
                })
            })
        })()

        function submitContactForm() {
            var orden = $('#orden').val();
            var diseno = $('#diseno').val();
            var talla = $('#talla').val();
            var nombre = $('#nombre').val();
            var numero = $('#numero').val();

            if (orden.trim() == '') {
                alert('Por favor ingresar # Orden.');
                $('#orden').focus();
                return false;
            } else if (diseno.trim() == '') {
                alert('Por favor ingresar diseño.');
                $('#diseno').focus();
                return false;
            } else if (talla.trim() == '') {
                alert('Por favor ingresar talla.');
                $('#talla').focus();
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'visor/adddespacho.php',
                    data: 'contactFrmSubmit=1&orden='+orden+'&diseno='+diseno+'&talla='+talla+'&nombre='+nombre+'&numero='+numero,
                    beforeSend: function () {
                        $('#.submitBtn').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    },
                    success: function (msg) {
                        if (msg != 'ok') {
                            $('#orden').val('');
                            $('#diseno').val('');
                            $('#talla').val('');
                            $('#nombre').val('');
                            $('#numero').val('');
                            $('.statusMsg').html('<span style="color:green;">Datos ingresados perfectamente.</span>');
                        } else {
                            $('#orden').val('');
                            $('#diseno').val('');
                            $('#talla').val('');
                            $('#nombre').val('');
                            $('#numero').val('');
                            $('.statusMsg').html('<span style="color:red;">Opss, Ocurrio un error intente de nuevo.</span>');
                        }
                        $('.submitBtn').removeAttr("disabled");
                        $('.modal-body').css('opacity', '');
                    }
                });
            }
        }
    </script>
    <script>
        $("form").on("submit", function(e) {
            var addorden = $('#addorden').val();

            if (addorden.trim() == '') {
                alert('Por favor ingresar # Orden.');
                $('#addorden').focus();
                return false;
            } else {
                $.ajax({
                    type: "POST",
                    url: "visor/adddespacho.php",
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
<?php }?>