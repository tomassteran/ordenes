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
$hoydia['totalAge'] = '0';

$sqlQuery = "SELECT * FROM `live_records` WHERE `modificado` BETWEEN '".$fecha."' AND '".$diaSiguienteMedianoche."' AND `estado_op` = '1' " ;
$resultado = mysqli_query($db, $sqlQuery);
    if ($row_cnt = mysqli_num_rows($resultado) ) {
         $row_cnt;

         $sqlQuery2 = "SELECT SUM(age) as totalAge FROM `live_records` WHERE `modificado` BETWEEN '".$fecha."' AND '".$diaSiguienteMedianoche."' AND `estado_op` = '1' " ;
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
$consultMes['totalAge'] = 0;

$SQLsemana = "SELECT * FROM  `live_records` WHERE `semana` = '".$semanaAnterior."' AND `estado_op` = '1' ";
    $consult = mysqli_query($db, $SQLsemana);
    if ($row_cnt2 = mysqli_num_rows($consult)) {
        
        $SQLsemana2 = "SELECT SUM(age) as totalAge FROM `live_records` WHERE `semana` = '".$semanaAnterior."' AND `estado_op` = '1' " ;
        $row = mysqli_query($db, $SQLsemana2);
        if ($consultMes = mysqli_fetch_assoc($row)) {
            if (empty($consultMes['totalAge'])) {
                $consultMes['totalAge'] = 0;
            } else {
                $consultMes['totalAge'];
            }
        }
    }

// Mes Anterior
$mes['totalAge'] = 0;

$SQLmes = "SELECT * FROM `live_records` WHERE YEAR(modificado) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(modificado) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND estado_op = '1' ";
    $consultas = mysqli_query($db, $SQLmes);
    if ($row_cnt3 = mysqli_num_rows($consultas)) {
        
        $SQLmes2 = "SELECT SUM(age) as totalAge FROM `live_records` WHERE YEAR(modificado) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(modificado) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND estado_op = '1' ";
        $row0 = mysqli_query($db, $SQLmes2);
        if ($mes = mysqli_fetch_assoc($row0) ) {
           $mes['totalAge']; 
           if (empty($consultMes['totalAge'])) {
                $mes['totalAge'] = 0;
            } else {
                $mes['totalAge'];
            }
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


    <link type="text/css" href="assets/css/vendor-morris.css" rel="stylesheet">
    <link type="text/css" href="assets/css/vendor-bootstrap-datepicker.css" rel="stylesheet">

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- App CSS -->
    <link type="text/css" href="assets/css/app.css" rel="stylesheet">
    <link type="text/css" href="assets/css/app.rtl.css" rel="stylesheet">

    <!-- Simplebar -->
    <link type="text/css" href="assets/vendor/simplebar.css" rel="stylesheet">


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
                            <div class="page-title m-0">JORGE PRO 0.1</div>

                            <div class="collapse navbar-collapse" id="mainNavbar">
                                <ul class="navbar-nav ml-auto align-items-center">
                                    
                                   
                                    <li class="nav-item dropdown notifications d-flex align-self-center align-items-center" id="navbarNotifications">
                                        <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="material-icons align-middle">notifications</i>
        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsDropdown" id="notificationsDropdown">
                                            <ul class="nav nav-tabs-notifications d-flex px-0" id="notifications-ul" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications" aria-selected="true">NOTIFICACIONES</a>
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
                                                                <b><?php echo $notiRow['ordenp']; ?></b> <?php echo $notiRow['name']; ?></div>
                                                            <div class="w-100 text-muted"><?php echo $notiRow['secondsDiff']; ?></div>
                                                        </li>
                                                    <?php } ?>                                                        
                                                        
                                                    </ul>
                                                </div>                                                
                                                <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item nav-divider">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link dropdown-toggle dropdown-clear-caret" data-toggle="sidebar" data-target="#user-drawer">
          Menu
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
                        <div class="row font-1">
                            <div class="col-lg-4">
                                <div class="card card-body flex-row align-items-center">
                                    <h5 class="m-0"><i class="material-icons align-middle text-muted md-18"></i> Hoy </h5> 
                                    <div class="text-primary ml-auto"><?php echo $row_cnt; ?></div> 
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-body flex-row align-items-center">
                                    <h5 class="m-0"> Ultima semana</h5> <span>&nbsp;&nbsp;(Semana anterior)</span>
                                    <div class="text-primary ml-auto"><?php echo $row_cnt2; ?></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-body flex-row align-items-center">
                                    <h5 class="m-0"> Ultimos 30 dias </h5><span>&nbsp;&nbsp;(Mes anterior)</span>
                                    <div class="text-primary ml-auto"><?php echo $row_cnt3; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-earnings">
                            <div class="card-group">
                                <div class="card card-body mb-0">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <p class="card-text text-muted mb-1">Total unidades hoy</p>
                                            <h1 class="mb-0 font-weight-normal"><?php echo $hoydia['totalAge']; ?></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-body mb-0">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <p class="card-text text-muted mb-1">Ultima semana</p>
                                            <h1 class="mb-0 font-weight-normal"><?php echo $consultMes['totalAge']; ?></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-body mb-0">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <p class="card-text text-muted mb-1">Ultimo mes</p>
                                            <h1 class="mb-0 font-weight-normal"><?php echo $mes['totalAge'];?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">                            
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <div class="card-title">
                                            Diseñadores
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <?php 
                                        $sqlusr = "SELECT * FROM `diseno` WHERE status = '1'";
                                        $rowd = mysqli_query($db, $sqlusr);
                                        while ($roc = mysqli_fetch_assoc($rowd)) {
                                            $roc['id'];

                                            $sqlusr2 = "SELECT * FROM `design` WHERE id_design = '".$roc['id']."' ORDER BY id DESC limit 6";
                                            $rowd2 = mysqli_query($db, $sqlusr2);
                                            if ($roc2 = mysqli_fetch_array($rowd2)) {

                                                $roc2['id_design'];
                                                $roc2['id_orden'];

                                                $sqlusr3 = "SELECT * FROM `live_records` WHERE ordenp = '".$roc2['id_orden']."' " ;
                                                $rowd3 = mysqli_query($db, $sqlusr3);
                                                    if ($roc3 = mysqli_fetch_array($rowd3)) {
                                                        $roc3['name'];
                                                        $roc3['age'];
                                                    }?>
                                                        
                                                        <li class="list-group-item d-flex flex-row">
                                                            <img src="<?php echo $roc['avatar']; ?>" alt="" class="rounded-circle mr-2" width="30" height="30">
                                                            <div class="media-body">
                                                                <span class=""><?php echo $roc3['name'] ?></span>
                                                                <strong><?php echo $roc['first_name'] . ' ' . $roc['last_name']; ?></strong>
                                                                <div><small class="text-muted"><?php echo $roc2['modificacion'];?></small></div>
                                                            </div>
                                                        </li>
                                        <?php }                                                
                                        } ?>                                                                                
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- TOP DE DISEÑADORES -->

                        </div>

                        <div class="card">                            
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr class="bg-fade">
                                            <th style="width: 120px;">ORDEN</th>
                                            <th>DISEÑO</th>
                                            <th>MONTADOR</th>
                                            <th style="width: 100px;">CANTIDAD</th>
                                            <th style="width: 140px;">FECHA PROCESADA</th>
                                            <th style="width: 100px">FECHA DE DESPACHO</th>
                                            <th>AREA ASIGNADA</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $tableSQL = "SELECT * FROM `live_records` ORDER BY `live_records`.`modificado` DESC LIMIT 6 ";
                                        $tableCons = mysqli_query($db, $tableSQL);
                                        while ($tableRow = mysqli_fetch_array($tableCons)) {
                                            $userSQL = "SELECT * FROM diseno WHERE id = '".$tableRow['id_user']."' ";
                                            $userCON = mysqli_query($db, $userSQL);
                                            $userROW = mysqli_fetch_array($userCON);
                                        ?>

                                        <tr>
                                            <td class="align-middle"><?php echo $tableRow['ordenp']; ?></td>
                                            <td class="align-middle">
                                                <div><i class="material-icons align-middle md-18 text-link-color">contacts</i> <?php echo $tableRow['name']; ?>
                                                    <em class="text-muted ml-1"><?php echo $tableRow['categoria']; ?></em>
                                                </div>

                                            </td>
                                            <td class="align-middle"><?php echo $userROW['first_name'] . ' ' . $userROW['last_name']; ?></td>
                                            <td class="align-middle">
                                                <?php echo $tableRow['age']; ?>
                                            </td>
                                            <td class="align-middle"><?php echo $tableRow['skills']; ?></td>
                                            <td class="align-middle"><?php echo $tableRow['address']; ?></td>
                                            <td class="align-middle">
                                                <?php
                                                if ($tableRow['designation'] == 'DISEÑO') {
                                                    echo '<div class="badge badge-danger">' . $tableRow["designation"] . '</div>';
                                                } elseif ($tableRow['designation'] == 'IMPRESION') {
                                                    echo '<div class="badge badge-warning">' . $tableRow["designation"] . '</div>';
                                                } elseif ($tableRow['designation'] == 'SUBLIMACION') {
                                                   echo '<div class="badge badge-info">' . $tableRow["designation"] . '</div>';
                                                } elseif ($tableRow['designation'] == 'CONFECCION') {
                                                    echo '<div class="badge badge-secondary">' . $tableRow["designation"] . '</div>';
                                                } elseif ($tableRow['designation'] == 'TERMINACION') {
                                                    echo '<div class="badge badge-light">' . $tableRow["designation"] . '</div>';
                                                } elseif ($tableRow['designation'] == 'DESPACHO') {
                                                    echo '<div class="badge badge-success">' . $tableRow["designation"] . '</div>';
                                                } elseif ($tableRow['designation'] == 'DESPACHADO') {
                                                    echo '<div class="badge badge-success">' . $tableRow["designation"] . '</div>';
                                                }

                                                ?>


                                                 </div>
                                            </td>
                                            
              <?php } ?>
                                               
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- // END drawer-layout__content -->
<?php if ($iduser == '1') { ?>
        <!-- drawer -->
        <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content">
                <div class="mdk-drawer__inner" data-simplebar data-simplebar-force-enabled="true">

                    <nav class="drawer  drawer--dark">
                        <div class="drawer-spacer">
                            <div class="media align-items-center">
                                <a href="index.html" class="drawer-brand-circle mr-2">P</a>
                                <div class="media-body">
                                    <a href="index.php" class="h5 m-0 text-link">JOGER PRO 0.1</a>
                                </div>
                            </div>
                        </div>
                        <!-- HEADING -->
                        <div class="py-2 drawer-heading">
                            Dashboard
                        </div>
                        <!-- MENU -->
                        <ul class="drawer-menu" id="dasboardMenu" data-children=".drawer-submenu">
                            <li class="drawer-menu-item active ">
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
                                <a href="proforma.php">
                                    <i class="material-icons">autorenew</i>
                                    <span class="drawer-menu-text">PROFORMAS</span>
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
                        

                        <!-- MENU 
                        <ul class="drawer-menu" id="mainMenu" data-children=".drawer-submenu">
                            <li class="drawer-menu-item">
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
                            </li>
                        </ul>-->

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
    <script src="assets/js/color_variables.js"></script>
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
    </script>
    

    <script src="assets/vendor/morris.min.js"></script>
    <script src="assets/vendor/raphael.min.js"></script>
    <script src="assets/vendor/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/datepicker.js"></script>

</body>

</html>
<?php } }

mysqli_close($db);

?>