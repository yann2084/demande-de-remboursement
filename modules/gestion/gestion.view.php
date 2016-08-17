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
                       <th>Nom et prénom</th>
                        <th>Date déplacement</th>
                        <th>Lieu</th>
                       <th>Objet</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                <?php

                    foreach($deplacementAll as $key => $value){
                        $date1 = new DateTime($value['debut_depl']);
                        $debut_depl = $date1->format('d-m-Y');
//							$date2 = new DateTime($value['fin_depl']);
//							$fin_depl = $date2->format('d-m-Y');

                        echo "<tr>";
                            echo "<td>" . $value['nom_user'] . " " .  $value['prenom_user'] . "</td>";
                            echo "<td>" . $debut_depl . "</td>";

                            echo "<td>" . $value['lieu_depl']. "</td>";
                            echo "<td>" . $value['objet_depl'] . "</td>";
                            echo '<td>' .  '<form name="form" method="post" action="../edition_pdf/traitementPdf.ctrl.php">';
                                        echo '<input type="hidden" name="id_depl" value="' . $value['id_depl'] .'"/>';
                                        echo '<input type="hidden" name="ecriture" value="true"/>';
                                        echo '<button type="submit" class="submit btn btn-info btn-lg" >Détails</button></form></td>';
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