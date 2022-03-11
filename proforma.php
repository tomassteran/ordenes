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

</head>

<body>

    <div class="fixed-top header-projects">
        <nav class="navbar navbar-expand-md navbar-light bg-white d-flex-none">
            <div class="media align-items-center">
                <a href="index.php" class="drawer-brand-circle mr-2">S</a>
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
<div style="margin-top: 150px;" class="main">
 <!-- Button to trigger modal -->
<center><button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
    Proforma
</button></center>

<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Agrega proforma</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Cerrar</span>
                </button>
                
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
                    <div class="form-group">
                        <label for="orden"># Orden</label>
                        <input type="text" class="form-control" id="orden" placeholder="# Orden"/>
                    </div>
                    <div class="form-group">
                        <label for="diseno">Diseño</label>
                        <input type="text" class="form-control" id="diseno" placeholder="Diseño"/>
                    </div>
                    <div class="form-group">
                        <label for="fechaP">Fecha de procesado</label>
                        <input type="text" class="form-control" id="fechaP" placeholder="Fecha de procesado"/>
                    </div>
                    <div class="form-group">
                        <label for="fechaD">Fecha de despacho</label>
                        <input type="text" class="form-control" id="fechaD" placeholder="Fecha de despacho"/>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="text" class="form-control" id="cantidad" placeholder="Cantidad"/>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <input type="text" class="form-control" id="categoria" placeholder="Categoria"/>
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
</div>



 
<script>
function submitContactForm(){    
    var orden = $('#orden').val();
    var diseno = $('#diseno').val();
    var fechaP = $('#fechaP').val();
    var fechaD = $('#fechaD').val();
    var cantidad = $('#cantidad').val();
    var categoria = $('#categoria').val();

    if(orden.trim() == '' ){
        alert('Por favor ingresar # Orden.');
        $('#orden').focus();
        return false;
    }else if(diseno.trim() == '' ){
        alert('Por favor ingresar diseño.');
        $('#diseno').focus();
        return false;
    }else if(fechaP.trim() == '' ){
        alert('Por favor ingresar fecha de procesada.');
        $('#fechaP').focus();
        return false;
    }else if(fechaD.trim() == '' ){
        alert('Por favor ingresar fecha de despacho.');
        $('#fechaD').focus();
        return false;
    }else if(cantidad.trim() == ''){
        alert('Por favor ingresar cantidad de orden.');
        $('#cantidad').focus();
        return false;
    }else if(categoria.trim() == '' ){
        alert('Por favor ingresar categoria de orden.');
        $('#categoria').focus();
        return false;
    }else{
        $.ajax({
            type:'POST',
            url:'register.php',
            data:'contactFrmSubmit=1&orden='+orden+'&diseno='+diseno+'&fechaP='+fechaP+'&fechaD='+fechaD+'&cantidad='+cantidad+'&categoria='+categoria,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                if(msg != 'ok'){
                    $('#orden').val('');
                    $('#diseno').val('');
                    $('#fechaP').val('');
                    $('#fechaD').val('');
                    $('#cantidad').val('');
                    $('#categoria').val('');
                    $('.statusMsg').html('<span style="color:green;">Datos ingresados perfectamente </p>');
                   
                }else{
                    $('#orden').val('');
                    $('#diseno').val('');
                    $('#fechaP').val('');
                    $('#fechaD').val('');
                    $('#cantidad').val('');
                    $('#categoria').val('');
                    $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}



function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>   


</body>

</html>