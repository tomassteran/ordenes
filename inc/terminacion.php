<?php

require("../config/dbConfig.php");

?>

<div class="card">
    <div class="table-responsive">
        <table class="table table-projects mb-0">
            <thead>
                <tr>                                
                    <th style="width: 120px;">ORDEN</th>
                    <th>DISEÑO</th>
                    <th style="width: 100px;">CANTIDAD</th>
                    <th style="width: 140px;">FECHA PROCESADA</th>
                    <th style="width: 100px">FECHA DE DESPACHO</th>
                    <th>AREA ASIGNADA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $todasQuery = "SELECT * FROM `live_records` WHERE designation LIKE 'DESPACHO%' AND estado_op = '1' ";
                $todasConsu = mysqli_query($db, $todasQuery);
                while ($todasRow = mysqli_fetch_assoc($todasConsu)) {
                    
                
                ?>
                <tr>
                                
                                <td>
                                    <?php echo $todasRow['ordenp']; ?>
                                </td>
                                <td>
                                    <div class="media align-items-center">
                                        <img src="assets/images/avatars/person-13.jpg" alt="" width="40" class="rounded-circle mr-2">
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
                                            <div class="text-muted"><i><?php echo $comRow['first_name'] . ' ' . $comRow['last_name'] ; ?></i></div>
                                        </div>
                                    </div>
                                </td>
                    <td>
                        <?php echo $todasRow['age']; ?>
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