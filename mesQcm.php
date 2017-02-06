<?php
if(isset($_GET['idqcm']) && $_GET['idqcm'] != null && isset($_GET['act']) ) {
    if ($_GET['act'] == 'vis'){
        $resQues = $monPDO->prepare('UPDATE qcm
                                  SET visible = 1
                                  WHERE idQcm ="'.$_GET['idqcm'].'"');
        $resQues->execute();
        header('location: membre.php?nav=mesqcm');
    }else{
        $resQues = $monPDO->prepare(' SELECT q.nom,n.note,c.nom,c.prenom
                                FROM qcm q, note n,compte c
                                WHERE q.idCrea = "' . $_SESSION['id'] . '"
                                AND n.idQcm = q.idQcm
                                and c.idCompte = n.idCompte
                                AND q.idQcm = "'.$_GET['idqcm'].'"');


        $resQues->execute();
        $data = $resQues->fetch();
        echo "<fieldset>";
        echo "<legend>".$data[0]."</legend>";

        if($data[1]!=null){
            echo "<p>Resultat</p><br/><table><tr><th>Nom</th><th>Note</th></tr>";
            do{
                echo "<tr><td>".$data[2]." ".$data[3]."</td><td>".$data[1]."/20</td></tr>";
            }while($data = $resQues->fetch());
            echo "</table>";
        }else{
            echo "<p>Aucun élève n'a remplies le qcm</p>";
        }

        $reqRep = $monPDO->prepare('SELECT r.idQuestion,qu.question, qu.theme, r.reponse,r.juste, r.feedback FROM  question qu, reponse r,assoqcmquest ass
                                    WHERE r.idQuestion = qu.idQuestion
                                    AND qu.idQuestion = ass.idQuestion
                                    AND ass.idQcm = "'.$_GET['idqcm'].'"');
        $reqRep->execute();
        $tabResRep = $reqRep->fetchAll();
        $ques = "";
        echo "<table>";
        foreach($tabResRep as $resRep)
        {
            if($resRep["idQuestion"] == $ques){
                echo "<tr><td>reponse : ".$resRep["reponse"]."</td><td>";
                    if($resRep["juste"] == 1){
                        echo "Vrai";
                    }else{
                        echo "Faux";
                    }
                echo "</td></tr>";
            }else{
                $ques = $resRep["idQuestion"];
                echo "<tr class='spaceUnder'><td>Quesion : ".$resRep["question"]."</td><td> theme : ".$resRep["theme"]."</td></tr>";
                echo "<tr><td>reponse : ".$resRep["reponse"]."</td><td>";
                if($resRep["juste"] == 1){
                    echo "vrai";
                }else{
                    echo "Faux";
                }
                echo "</td></tr>";
            }
        }
        echo "</table>";
        echo("</fieldset>");
        echo '<style type="text/css"> tr.spaceUnder > td{  padding-top: 2em;padding-bottom: 1em;}</style>';



    }
}else{
    $resQues = $monPDO->prepare(' SELECT * 
                              FROM qcm q 
                              WHERE idCrea = "' . $_SESSION['id'] . '"');
    $resQues->execute();
    $index = 0;
    ?>
    <fieldset>
        <legend>Mes QCM</legend>
        <table id="tableMesQcm">
            <tr>
                <th id="mesQcm">
                    Nom
                </th>
                <th id="mesQcm">
                    Date de création
                </th>
                <th id="mesQcm">
                    Date de fin
                </th>
                <th id="mesQcm">
                    visibilité
                </th>
            </tr>
            <?php
            while ($data = $resQues->fetch()) {
                echo '<tr><td><a href="membre.php?nav=mesqcm&idqcm='.$data[0].'&act=aff">'.$data[5].'</a></td>
                      <td>'.$data[3].'</td>
                      <td>'.$data[2].'</td>';
                if ($data[4] == 1 ){
                    echo "<td> Est Visible </td>";
                }else{
                    echo "<td> Est Caché </td><td><a href='membre.php?nav=mesqcm&idqcm=".$data[0]."&act=vis'><input type='button' value='Rendre visible'/></a> </td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </fieldset>
<?php        
}
?>