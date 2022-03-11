<?php

require("config/dbConfig.php");

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


    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- App CSS -->
    <link type="text/css" href="assets/css/app.css" rel="stylesheet">
    <link type="text/css" href="assets/css/app.rtl.css" rel="stylesheet">

    <!-- Simplebar -->
    <link type="text/css" href="assets/vendor/simplebar.css" rel="stylesheet">

    <!-- App JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>


    <script type="text/javascript">
    $(document).ready(function() {
        $('#div-btn1').on('click', function() {
            $('.navbar-nav li').removeClass('active');
            $("#central").load('inc/diseno.php');
            return false;
        });
    
        $('#div-btn2').on('click', function() {
            $('.navbar-nav li').removeClass('active');
            $("#central").load('inc/impresion.php');
            return false;
        });
    
        $('#div-btn3').on('click', function() {
            $('.navbar-nav li').removeClass('active');
            $("#central").load('inc/sublimacion.php');
            return false;
        });
    
        $('#div-btn4').on('click', function() {
            $('.navbar-nav li').removeClass('active');
            $("#central").load('inc/confeccion.php');
            return false;
        });

        $('#div-btn5').on('click', function() {
            $('.navbar-nav li').removeClass('active');
            $("#central").load('inc/terminacion.php');
            return false;
        });

        $('#div-btn6').on('click', function() {
            $('.navbar-nav li').removeClass('active');
            $("#central").load('inc/despacho.php');
            return false;
        });
    });
</script>
</head>

<body>
    <div class="fixed-top header-projects">

        <nav class="navbar navbar-expand-md navbar-light bg-white d-flex-none">
            <div class="media align-items-center">
                <a href="index.php" class="drawer-brand-circle mr-2">P</a>
                <div class="media-body">
                    <a href="index.php" class="page-title m-0">JORGE PRO 0.1</a>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ml-auto  align-items-center">
                    <li class="nav-item nav-link">
                        <a class="btn btn-outline-primary" href="index.php">
          <i class="material-icons align-middle md-18">chevron_left</i>
          Regresar al inicio
        </a>
                    </li>
                    <li class="nav-item nav-link">
                        <div class="form-group m-0">
                            
                        </div>
                    </li>
                    
                    <li class="nav-item dropdown notifications d-flex align-items-center" id="navbarNotifications">
                        <a href="#" class="nav-link dropdown-toggle " data-toggle="dropdown" aria-expanded="false">
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
                        <li class="nav-item dropdown nav-dropdown d-flex align-items-center">
                            <a href="#" class="nav-link dropdown-toggle dropdown-clear-caret" data-toggle="dropdown" aria-expanded="false">
          MENU
          <img src="../../../pbs.twimg.com/profile_images/928893978266697728/3enwe0fO_400x400.jpg" class="img-fluid rounded-circle ml-1" width="35"
            alt="">
        </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-account">
                                <ul class="list-unstyled">
                                    
                                    <!--<li>
                                        <a href="profile.php" class="dropdown-item ">
                <i class="material-icons md-18 align-middle mr-1">account_circle</i>
                <span class="align-middle">PERFIL</span>
              </a>
                                    </li>-->                                    
                                    <li>
                                        <a href="login.php" class="dropdown-item">
                <i class="material-icons md-18 align-middle mr-1">exit_to_app</i>
                <span class="align-middle">SALIR</span>
              </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- main content -->
    <div class="top-navbar">

        <nav class="navbar navbar-expand-md bg-primary navbar-dark d-flex  flex-column aling-items-center mb-3">
            <button class="btn btn-link text-white pl-0 d-md-none" type="button" data-toggle="sidebar">
    <i class="material-icons align-middle md-36">short_text</i>
  </button>           
        </nav>       
        <div class="container mt-0 pb-3">
            <div class="card card-body p-2">
                <div class="row row-projects">
                    <div class="col">
                        <?php
                            $totalQuery = "SELECT * FROM `live_records` WHERE designation != 'DESPACHADO' AND estado_op = '1' ";
                            $totalConsu = mysqli_query($db, $totalQuery);
                            if ($totalRow = mysqli_num_rows($totalConsu)) {
                                
                            }
                            ?>
                        <a class="nav-link" href="projects.php"><i class="material-icons text-link-color md-36">dvr</i>
                        <div class="mb-1"> TODAS</div>
                        <h4 class="mb-0 "><?php echo $totalRow; ?></h4></a>
                    </div>
                    <div class="col">
                         <?php
                            $disenoQuery = "SELECT * FROM `live_records` WHERE designation LIKE 'DISEÑO%' AND estado_op = '1'";
                            $disenoConsu = mysqli_query($db, $disenoQuery);
                            if ($disenoRow = mysqli_num_rows($disenoConsu)) {
                                
                            }
                            ?>
                        <a class="nav-link" href="#" id="div-btn1"><i class="material-icons text-dargen md-36">important_devices</i>
                        <div class="mb-1">DISEÑO</div>
                        <h4 class="mb-0"><?php echo $disenoRow; ?></h4></a>
                    </div>
                    <div class="col">
                        <?php
                            $impresionQuery = "SELECT * FROM `live_records` WHERE designation LIKE 'IMPRESION%' AND estado_op = '1'";
                            $impresionConsu = mysqli_query($db, $impresionQuery);
                            if ($impresionRow = mysqli_num_rows($impresionConsu)) {
                                
                            }
                            ?>
                        <a class="nav-link" href="#" id="div-btn2"><i class="material-icons text-warning md-36">print</i>
                        <div class="mb-1">IMPRESION</div>
                        <h4 class="mb-0"><?php echo $impresionRow; ?></h4></a>
                    </div>
                    <div class="col">
                        <?php
                            $sublimacionQuery = "SELECT * FROM `live_records` WHERE designation LIKE 'SUBLIMACION%' AND estado_op = '1'";
                            $sublimacionConsu = mysqli_query($db, $sublimacionQuery);
                            if ($sublimacionRow = mysqli_num_rows($sublimacionConsu)) {
                                
                            }
                            ?>
                        <a class="nav-link" href="#" id="div-btn3"><i class="material-icons text-primary md-36">store</i>
                        <div class="mb-1">SUBLIMACION</div>
                        <h4 class="mb-0"><?php echo $sublimacionRow; ?></h4></a>
                    </div>
                    <div class="col">
                        <?php
                            $confeccionQuery = "SELECT * FROM `live_records` WHERE designation LIKE 'CONFECCION%' AND estado_op = '1'";
                            $confeccionConsu = mysqli_query($db, $confeccionQuery);
                            if ($confeccionRow = mysqli_num_rows($confeccionConsu)) {
                                
                            }
                            ?>
                        <a class="nav-link" href="#" id="div-btn4"><i class="material-icons text-muted md-36">supervisor_account</i>
                        <div class="mb-1">CONFECCION</div>
                        <h4 class="mb-0"><?php echo $confeccionRow; ?></h4></a>
                    </div>
                    <div class="col">
                        <?php
                            $terminacionQuery = "SELECT * FROM `live_records` WHERE designation LIKE 'TERMINACION%' AND estado_op = '1'";
                            $terminacionConsu = mysqli_query($db, $terminacionQuery);
                            if ($terminacionRow = mysqli_num_rows($terminacionConsu)) {
                                
                            }
                            ?>
                        <a class="nav-link" href="#" id="div-btn5"><i class="material-icons text-success md-36">visibility</i>
                        <div class="mb-1">TERMINACION</div>
                        <h4 class="mb-0"><?php echo $terminacionRow; ?></h4></a>
                    </div>
                    <div class="col">
                        <?php
                            $despSQL = "SELECT * FROM `live_records` WHERE designation LIKE 'DESPACHO%' AND estado_op = '1' ";
                            $despCON = mysqli_query($db, $despSQL);
                            $despROW = mysqli_num_rows($despCON);
                        ?>
                        <a class="nav-link" href="#" id="div-btn6"><i class="material-icons text-primary md36">redeem</i>
                            <div class="mb-1">DESPACHO</div>
                            <h4 class="mb-0"><?php echo $despROW; ?></h4>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card" id="central">
                <div class="table-responsive">
                    <table class="table table-projects mb-0">
                        <thead>
                            <tr>                                
                                <th style="width: 120px;">ORDEN</th>
                                <th>DISEÑO</th>
                                <th style="width: 100px;">CANTIDAD</th>
                                <th style="width: 150px;">CATEGORIA</th>
                                <th style="width: 140px;">FECHA PROCESADA</th>
                                <th style="width: 100px">FECHA DE DESPACHO</th>
                                <th>AREA ASIGNADA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $todasQuery = "SELECT * FROM `live_records` WHERE designation != 'DESPACHADO' AND estado_op = '1' ";
                            $todasConsu = mysqli_query($db, $todasQuery);
                            while ($todasRow = mysqli_fetch_assoc($todasConsu)) {
                                
                            
                            ?>
                            <tr>
                                
                                <td>
                                    <?php echo $todasRow['ordenp']; ?>
                                </td>
                                <td>
                                    <div class="media align-items-center">
                                        <div class="media-body lh-1">
                                            <b><?php echo $todasRow['name']; ?></b>
                                            <?php 
                                            
                                            $userQuery = "SELECT * FROM design WHERE id_orden = '".$todasRow['ordenp']."' ";
                                            $userConsu = mysqli_query($db, $userQuery);
                                            $userRow = mysqli_fetch_assoc($userConsu);
                                            
                                            $comQuery = "SELECT * FROM diseno WHERE id = '".$userRow['id_design']."' ";
                                            $comConsu = mysqli_query($db, $comQuery);
                                            $comRow = mysqli_fetch_assoc($comConsu);
                                            
                                            ?>
                                            <div class="text-muted"><i><?php echo $comRow['first_name'] . ' ' . $comRow['last_name']; ?></i></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <center><?php echo $todasRow['age']; ?></center>
                                </td>
                                <td>
                                    <?php echo $todasRow['categoria']; ?>
                                </td>
                                <td>
                                    <?php echo $todasRow['skills']; ?>
                                </td>
                                <td>
                                    <?php echo $todasRow['address']; ?>
                                </td>
                                <td>
                                    <?php 
                                    if ($todasRow['designation'] == 'DISEÑO') {
                                        echo '<div class="badge badge-danger">' . $todasRow["designation"] . '</div>';
                                    } elseif ($todasRow['designation'] == 'IMPRESION') {
                                        echo '<div class="badge badge-warning">' . $todasRow["designation"] . '</div>';
                                    } elseif ($todasRow['designation'] == 'SUBLIMACION') {
                                        echo '<div class="badge badge-info">' . $todasRow["designation"] . '</div>';
                                    } elseif ($todasRow['designation'] == 'CONFECCION') {
                                        echo '<div class="badge badge-secondary">' . $todasRow["designation"] . '</div>';
                                    } elseif ($todasRow['designation'] == 'TERMINACION') {
                                        echo '<div class="badge badge-light">' . $todasRow["designation"] . '</div>';
                                    } elseif ($todasRow['designation'] == 'DESPACHO') {
                                        echo '<div class="badge badge-success">' . $todasRow["designation"] . '</div>';
                                    } elseif ($todasRow['designation'] == 'DESPACHADO') {
                                        echo '<div class="badge badge-success">' . $todasRow["designation"] . '</div>';
                                    }
                                    ?>
                                    
                                </td>
                            </tr>
                            <?php }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

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
                            <li class="drawer-menu-item active">
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

    <!-- jQuery -->
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

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


    <script>
        $(".check-projects").click(function() {
            $('.project').not(this).prop('checked', this.checked);
        });
    </script>


</body>

</html>