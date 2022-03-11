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

include('inc/header.php');
?>
<title>PALMASINO 2</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/ajax7.js"></script>	
<style type="text/css">
  @media (max-width: 801px) {
    .navbar-header {
        float: none;
    }
    .navbar-toggle {
        display: block;
    }

    .navbar-collapse {
        border-top: 1px solid transparent;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
    }
    .navbar-collapse.collapse {
        display: none!important;
    }
    .navbar-nav {
        float: none!important;
        margin: 7.5px -15px;
    }
    .navbar-nav>li {
        float: none;
    }
    .navbar-nav>li>a {
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .navbar-text {
        float: none;
        margin: 15px 0;
    }
    /* since 3.1.0 */
    .navbar-collapse.collapse.in { 
        display: block!important;
    }
    .collapsing {
        overflow: hidden!important;
    }
}
</style>
</head>
<body class="">
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#important-id-for-collapsing" aria-expanded="false">
                <span class="sr-only">MENU</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="important-id-for-collapsing">
            <ul class="nav navbar-nav">

			<?php if ($tipo_usuario != '0') {
				if ($tipo_usuario == '1') { 
					header("location: diseno.php");
					exit;
				} 
			
				elseif ($tipo_usuario == '2') {
					header("location: impresion.php");
					exit;
				}
				elseif ($tipo_usuario == '3') {
					header('location: sublimacion.php');
					exit;
				}
				elseif ($tipo_usuario == '4') {
					echo '<li class="active"><a href="confeccion.php">CONFECCION</a></li>' ;
				}
				elseif ($tipo_usuario == '5') {
					header("location: despacho.php");
					exit;
				} 
				elseif ($tipo_usuario == '6') {
					header("location: despachado.php");
					exit;
				}
			}
				if ($tipo_usuario == '0') {
			?>

            	<li><a href="index.php">INICIO</a></li>
        		<li><a href="diseno.php">DISEÑO</a></li>
        		<li><a href="impresion.php">IMPRESION</a></li>
        		<li><a href="sublimacion.php">SUBLIMACION</a></li>
        		<li><a href="confeccion.php">CONFECCION</a></li>
	        	<li><a href="despacho.php">DESPACHO</a></li>
        		<li><a href="despachado.php">DESPACHADO</a></li>
        		<li class="active"><a href="eliminados.php">ELIMINADOS</a></li>
        		<li><a href="reset-password.php">Cambiar contraseña</a></li>
        		<li><a href="logout.php">Salir</a></li>
<?php } ?>        		
            </ul>
        </div>
    </div>
</nav>	
	<div class="container" style="min-height:500px;">
	
<div class="container contact">	
	<div class="">   		
		<div class="panel-heading">
		<?php if ($tipo_usuario == '0') { ?>				
				<div class="col" align="">
					<button type="button" name="add" id="addRecord" class="btn btn-success">AGREGAR NUEVA PROPUESTA</button>
				</div>
		 <?php } ?>
		</div>
		<table id="recordListing" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>ORDEN</th>					
					<th>DISEÑO</th>					
					<th>CANTIDAD</th>
					<th>FECHA DE PROCESADA</th>
					<th>FECHA DE DESPACHO</th>
					<th>AREA DESIGNADA</th>
					<th>CATEGORIA</th>					
					<th></th>
					<th></th>					
				</tr>
			</thead>
		</table>
	</div>
	<?php if ($tipo_usuario == '0') { ?>
	<div id="recordModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="recordForm">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> EDITAR REGISTRO</h4>
    				</div>
    				<div class="modal-body">
    					<div class="form-group"
							<label for="ordenp" class="control-label">ORDEN</label>
							<input type="text" class="form-control" id="ordenp" name="ordenp" placeholder="ORDEN" required>			
						</div>
						<div class="form-group"
							<label for="name" class="control-label">DISEÑO</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="DISEÑO" required>			
						</div>
						<div class="form-group">
							<label for="age" class="control-label">CANTIDAD</label>							
							<input type="text" class="form-control" id="age" name="age" placeholder="CANTIDAD">							
						</div>	   	
						<div class="form-group">
							<label for="lastname" class="control-label">FECHA DE PROCESADA</label>							
							<input type="text" class="form-control"  id="skills" name="skills" placeholder="FECHA DE PROCESADA" required>							
						</div>	 
						<div class="form-group">
							<label for="address" class="control-label">FECHA DE DESPACHO</label>							
							<input type="text" class="form-control" id="address" name="address" placeholder="FECHA DE DESPACHO">							
						</div>
						<div class="form-group">
							<label for="lastname" class="control-label">AREA DESIGNADA</label>							
							<select name="designation" id="designation">
								<option>SELECCION UNA OPCION</option>
								<optgroup label="DISEÑO">
									<option value="DISEÑO - GINA">DISEÑO - GINA</option>
									<option value="DISEÑO - ADRIAN">DISEÑO - ADRIAN</option>
									<option value="DISEÑO - JOHAN">DISEÑO - JOHAN</option>
									<option value="DISEÑO - SEBASTIAN">DISEÑO - SEBASTIAN</option>
									<option value="DISEÑO - DAVID"> DISEÑO - DAVID</option>
									<option value="DISEÑO - JUAN PABLO">DISEÑO - JUAN PABLO</option>
								</optgroup>
								<optgroup label="IMPRESION">
									<option value="IMPRESION - MS JP4">IMPRESION - MS JP4</option>
									<option value="IMPRESION - MUTOH">IMPRESION - MUTOH</option>
								</optgroup>
								<option value="SUBLIMACION">SUBLIMACION</option>
								<option value="CONFECCION">CONFECCION</option>
								<option value="DESPACHO">DESPACHO</option>
								<option value="DESPACHADO">DESPACHADO</option>
							</select>			
						</div>
						<div class="form-group">
							<label for="lastname" class="control-label">CATEGORIA</label>							
							<select name="categoria" name="categoria">
								<option value="CICLISMO / NORMAL">CICLISMO / NORMAL</option>
								<option value="CICLISMO / EVENTO">CICLISMO / EVENTO</option>
								<option value="RUNNING / NORMAL">RUNNING / NORMAL</option>
								<option value="RUNNING / EVENTO">RUNNING / EVENTO</option>
								<option value="CASUAL / NORMAL">CASUAL / NORMAL</option>
								<option value="CASUAL / EVENTO">CASUAL / EVENTO</option>
								<option value="ESCUELA / NORMAL">ESCUELA / NORMAL</option>
								<option value="ESCUELA / EVENTO">ESCUELA / EVENTO</option>

							</select>			
						</div>						
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="id" id="id" />
    					<input type="hidden" name="action" id="action" value="" />
    					<input type="submit" name="save" id="save" class="btn btn-info" value="GUARDAR" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
	<?php } ?>
</div>	
<?php include('inc/footer.php');?>