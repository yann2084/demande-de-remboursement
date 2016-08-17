<?php
include("../../view/template/top.view.php");
?>
<body>

<?php
include("../../view/template/menu.view.php");
?>

    <div class="container-fluid">
        <div class="well col-md-6 col-md-offset-3">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date demande</th>
                        <th>Date déplacement</th>
                        <th>Lieu</th>
                        <th>Objet</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($tabObjDeplacements as $objDeplacement){
						$temp =new DateTime($objDeplacement->date_demande());
						$dateDemande = $temp->format('d-m-Y h:i:s');
						
                        $date = new DateTime($objDeplacement->getAttr('debut_depl'));
                        $debut_depl = $date->format('d-m-Y');
                        echo "<tr>";
                            //echo "<td>" . $value->debut_depl . "</td>";
                            echo "<td>" . $dateDemande . "</td>";
						
                            echo "<td>" . $debut_depl . "</td>";
                            
                            echo "<td>" . $objDeplacement->getAttr('lieu_depl') . "</td>";
                            echo "<td>" . $objDeplacement->getAttr('objet_depl') . "</td>";
                            echo '<td>' .  '<form name="form" method="post" action="../nouvelle_demande/newdemandeTEST.ctrl.php">';                       
                                        echo '<input type="hidden" name="id_depl" value="' . $objDeplacement->getAttr('id_depl') .'"/>';
                                        echo '<input type="hidden" name="ecriture" value="true"/>';
                                        echo '<button type="submit" class="submit btn btn-info btn-lg" >Consulter ou modifier</button></form></td>';

                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
include("../../view/template/bottom.view.php");
?>