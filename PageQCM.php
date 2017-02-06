<?php
include('PDO.php');
if(isset($_SESSION['role']) && $_SESSION['role'] == "etudiant"){
if(isset($_GET['idQcm']))
{
    $reqRep = $monPDO->prepare('SELECT r.idQuestion,qu.question, qu.theme, r.reponse,r.juste, r.feedback FROM  question qu, reponse r,assoqcmquest ass
                                    WHERE r.idQuestion = qu.idQuestion
                                    AND qu.idQuestion = ass.idQuestion
                                    AND ass.idQcm = "'.$_GET['idQcm'].'"');
    $reqRep->execute();
    $tabResRep = $reqRep->fetchAll();
    $ques = "";
    $indexRep = 0;
    $indexQuest = 0;
    echo "<form  action='membre.php?nav=vrqcm' method='post'><table>";
    foreach($tabResRep as $resRep)
    {
        if($resRep["idQuestion"] == $ques){
            $indexRep++;
            echo "<tr><td>reponse : ".$resRep["reponse"]."</td><td><input type='checkbox' name='checkbox".$indexQuest.$indexRep."'/>";

            echo "</td></tr>";
        }else{
            $indexRep = 1;
            $indexQuest++;
            $ques = $resRep["idQuestion"];
            echo "<tr class='spaceUnder'><td>Quesion : ".$resRep["question"]."</td></tr>";
            echo "<tr><td>reponse : ".$resRep["reponse"]."</td><td><input type='checkbox' name='checkbox".$indexQuest.$indexRep."'/>";
            echo "</td></tr>";

        }

    }
    echo ('<input type="hidden" name="qcm" value ="'.$_GET['idQcm'].'"/>');
    echo "</table>";
    echo ('<input type="submit" name="valid" value="Valider"/>');
    echo "</form>";
    echo '<style type="text/css"> tr.spaceUnder > td{  padding-top: 2em;padding-bottom: 1em;}</style>';
    echo "<input type='hidden' name='index' value='".$indexQuest."'";
    }

}
?>
