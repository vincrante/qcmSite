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
        echo "<h2>".$data[0]."</h2>";

        if($data[1]!=null){
            echo "<p>Reusltat</p><br/><table><tr><th>Nom</th><th>Note</th></tr>";
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
        echo '<style type="text/css"> tr.spaceUnder > td{  padding-top: 2em;padding-bottom: 1em;}</style>';



    }
}else{
    $resQues = $monPDO->prepare(' SELECT * 
                              FROM qcm q 
                              WHERE idCrea = "' . $_SESSION['id'] . '"');
    $resQues->execute();
    $index = 0;
    ?>
        <h2>Mes QCM</h2>
        <table>


    <?php

    while ($data = $resQues->fetch()) {
        echo '<tr><td><a href="membre.php?nav=mesqcm&idqcm='.$data[0].'&act=aff">'.$data[5].'</a></td>
              <td>Date de creation : '.$data[3].'</td>
              <td>Date de fin : '.$data[2].'</td>';
        if ($data[4] == 1 ){
            echo "<td> Est Visible </td>";
        }else{
            echo "<td> Est Caché </td><td><a href='membre.php?nav=mesqcm&idqcm=".$data[0]."&act=vis'> Rendre Visible</a> </td>";
        }
        echo "</tr>";
    }
    echo "</table>";


}
