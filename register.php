<?php

include('config/dbConfig.php');

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


if(isset($_POST['contactFrmSubmit']) && !empty($_POST['orden']) && !empty($_POST['diseno']) && !empty($_POST['fechaP']) && !empty($_POST['fechaD']) && !empty($_POST['cantidad']) && !empty($_POST['categoria'])){


$consultSQL = "SELECT * FROM live_records WHERE ordenp = '".$_POST['orden']."' ";
$consultCON = mysqli_query($db, $consultSQL);
$consultROW = mysqli_num_rows($consultCON);

if ($consultROW == 0) {
            // Submitted form data
    $orden   = $_POST['orden'];
    $diseno  = $_POST['diseno'];
    $fechaP = $_POST['fechaP'];
 	$fechaD = $_POST['fechaD'];
 	$cantidad = $_POST['cantidad'];
    $categoria = $_POST['categoria'];

    $buscarSQL = "SELECT * from live_records WHERE ordenp = '".$orden."' ";
    $buscarCON = mysqli_query($db, $buscarSQL);
    $buscarROW = mysqli_fetch_array($buscarCON);

            // contar las veces que se respite el id_users 
    $com = $db->query("SELECT id_design,COUNT(id_design) FROM design WHERE status = '1' GROUP BY id_design HAVING COUNT(id_design) ORDER BY COUNT(id_design) ");
    while ($opt = $com->fetch_array()) {
        $idusers = $opt['id_design'] ;
        $contador = $opt['COUNT(id_design)'];
        $valor = $opt['id_design']. '<br>';
    }    
            // en caso de que no traiga valor asignarle 0
    if (!isset($contador)) {
        $idusers = 0;
        $valor = 0;
    }

    // saber el id_users que esta activo y indicarle que sea el proximo
    $pro = $db->query("SELECT status, MAX(id) AS maximo, MIN(id) minimo FROM diseno WHERE status = 1 AND id > '".$idusers."' ORDER BY id DESC LIMIT 1");
    if ($rwx = $pro->fetch_array()) {
        $maximo = $rwx['maximo'];
// Si el id_users es igual o menor  a id que me trae el contador 
        if ($valor <= $maximo) {            
            $minimo = $rwx['minimo'];
            $id2 = $minimo;
        } else { ////////// en caso contrario empieza desde 1 
            $id2 = '1';
        }
            
    }

//echo $id2;

    $semanaActual = date('W', strtotime('0 week'));

    $estacion = '2';
    $diseno2 = 'DISEÑO';
    $status = '1';


    $dataSQL = $db->query("INSERT INTO live_records (ordenp, id_user, name, estacion, skills, address, designation, age, categoria, estado_op, semana, modificado) VALUES ('$orden', '$id2', '$diseno', '$estacion', '$fechaP', '$fechaD', '$diseno2', '$cantidad', '$categoria','$status', '$semanaActual', NOW())") or die(mysql_error());


    $disenoSQL = $db->query("INSERT INTO design (id_design, id_orden, status, modificacion) VALUES ('$id2', '$orden', '$status', NOW())" ) or die(mysql_error());


    $userSQL = "SELECT * FROM diseno WHERE id = '".$id2."' ";
    $userCON = mysqli_query($db, $userSQL);
    if ($userROW = mysqli_fetch_array($userCON)) {

    }

////////////////////////
//      SEND EMAIL CLIENT
////////////////////////

$mail = new PHPMailer(true);

try{
    // Config the server
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'gerenteproduccion@palmasino.com';
    $mail->Password = 'SportsweaR01';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('gerenteproduccion@palmasino.com' , 'Tomas'); //
   // $mail->addAddress('rotamasgijuta@gmail.com', 'prueba 2 '); // SEND
    $mail->addAddress('gerenteproduccion@palmasino.com', 'prueba 3');   // SEND
    //$mail->addReplyTo('rotamasgijuta@gmail.com', 'prueba 4'); //noreplet@mail.com
    //$mail->addCC('rotamasgijuta@gmail.com', 'prueba 5');

    //  Attachments
   // $mail->addAttachment('ruta pde archivo');
   // $mail->addAttachment('segundo archivo');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Hola '.$userROW['first_name']. ' ' . $userROW['last_name'] . ' la orden ' .$orden. ' se te fue asignada';
    $mail->Body = "<p>En breves momento se te entregara la orden por favor ten paciencia y que tengas un excelente dia.</p>";
    $mail->AltBody = 'prueba 2';
    $mail->CharSet = 'UTF-8';

    $mail->send();
    //echo 'Message has been sent';
    
   // echo $username;
}catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
} else {
     'no ingresa datos';
}
}