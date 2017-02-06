<?php
include('PDO.php');
?>
<html>
<head>
<title>Resultat</title>
<link rel="stylesheet" href="Style.css" />
</head>
<body>
<?php
if(isset($_POST['valid']) )
{

    $note = 0 ;
    $reqQuest = $monPDO->prepare('SELECT * '
                          . 'FROM QUESTION as QU, ASSOQCMQUEST as A, QCM as QC '
                          . 'WHERE QU.idQuestion = A.idQuestion '
                          . 'AND A.idQcm = QC.idQcm '
                          . 'AND QC.idQcm ="'.$_POST['qcm'].'"');
    $reqQuest->execute();
    $tabResQuest = $reqQuest->fetchAll();
    $indexQuest = 0;
    $indexRep = 0;
    $note= 0;
    foreach($tabResQuest as $resQuest)
    {

?>
<table>
    <tr>
        <td>
            <?php echo($resQuest['question']);$indexQuest++; ?>
        </td>
        <td>
            <?php
                $reqRep = $monPDO->prepare('SELECT * '
                          . 'FROM QUESTION as Q, REPONSE as R '
                          . 'WHERE Q.idQuestion = R.idQuestion '
                          . 'AND Q.idQuestion ='.$resQuest['idQuestion']);
                $reqRep->execute();
                $tabResRep = $reqRep->fetchAll();
            ?>

            <?php

            $indexRep = 0;
            $juste = 1;
            foreach($tabResRep as $resRep)
            {

                $indexRep++;
                if($resRep['juste'] == 1)
                {
                    ?>
                        <label class='juste'> <input type="checkbox" value="<?php $resRep['reponse'] ?>" <?php if(isset($_POST['checkbox'.$indexQuest.$indexRep])){ echo('checked="checked"');}else{$juste=0;}?>disabled/><?php echo($resRep['reponse']); ?></label>
                    <?php
                }
                else {
                    ?>
                       <label class='faux'> <input type="checkbox" value="<?php $resRep['reponse'] ?>"
                               <?php if(isset($_POST['checkbox'.$indexQuest.$indexRep])){
                                   echo('checked="checked"');
                                   $juste = 0;
                               } ?>
                                                   disabled />
                               <?php echo($resRep['reponse']) ?>
                                            </label>
                    <?php
                    }
                echo('<br/>');
                if(isset($_POST['checkbox'.$indexQuest.$indexRep])){

                    $reqResEtu = $monPDO->prepare('INSERT INTO resultat '
                                                  . 'VALUES("'.$_SESSION['id'].'", "'.$resRep['idReponse'].'", "'.$_POST['qcm'].'")');
                    $reqResEtu->execute();
                }
            }
                if($juste == 1){
                    $note++;
                    echo '<td>Juste</td>';
                }
                else{
                    echo '<td>Faux</td>';
                }

            ?>

        </td>
    </tr>
</table>
<?php
    }
echo('<br/>');
echo ('</form>');
    $note = (($note / $indexQuest)*20);
    
    $reqResEtu = $monPDO->prepare('INSERT INTO note '
                . 'VALUES("'.$_SESSION['id'].'", "'.$_POST['qcm'].'", "'.$note.'");');
    $reqResEtu->execute();    
    
    echo("Votre note sur ce QCM est de : ".$note."/20");
}
elseif(isset($_GET['idQcm'])){

    $reqRep = $monPDO->prepare('SELECT r.idQuestion,qu.question, qu.theme, r.reponse,r.juste, r.feedback,r.idReponse FROM  question qu, reponse r,assoqcmquest ass
                                    WHERE r.idQuestion = qu.idQuestion
                                    AND qu.idQuestion = ass.idQuestion
                                    AND ass.idQcm = "'.$_GET['idQcm'].'"');
    $reqRep->execute();
    $tabResRep = $reqRep->fetchAll();
    $resultat = $monPDO->prepare('SELECT r.idReponse, re.idQuestion FROM resultat r, reponse re
                                    WHERE re.idReponse = r.idReponse
                                    AND r.idCompte = "'.$_SESSION['id'].'"                                  
                                    AND r.idQcm = "'.$_GET['idQcm'].'"');
    $resultat->execute();
    $tableResultat = $resultat->fetchAll(PDO::FETCH_COLUMN, 0);

    $resNote = $monPDO->prepare('SELECT n.note,q.nom FROM note n, qcm q
                                    WHERE n.idCompte = "'.$_SESSION['id'].'"                                  
                                    AND n.idQcm = q.idQcm
                                    AND q.idQcm = "'.$_GET['idQcm'].'"');
    $resNote->execute();
    $note = $resNote->fetchAll();
    $ques = "";
    echo "<h2>".$note[0]['nom']."</h2>";
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
            echo "</td><td>".$resRep['feedback']."</td>";
            echo "<td><input type='checkbox' disabled";
            if (in_array($resRep["idReponse"],$tableResultat )){echo "checked";}
            echo "/> </td></tr>";
        }else{
            $ques = $resRep["idQuestion"];
            echo "<tr class='spaceUnder'><td>Quesion : ".$resRep["question"]."</td></tr>";
            echo "<tr><td>reponse : ".$resRep["reponse"]."</td><td>";
            if($resRep["juste"] == 1){
                echo "vrai";
            }else{
                echo "Faux";
            }
            echo "</td><td>".$resRep['feedback']."</td>";
            echo "<td><input type='checkbox' disabled";
            if (in_array($resRep["idReponse"],$tableResultat )){echo " checked";}
            echo "/> </td></tr>";


        }
    }
    echo "</table>";
    echo "<h3>vous avez eu ".$note[0][0]."/20</h3>";
    echo '<style type="text/css"> tr.spaceUnder > td{  padding-top: 2em;padding-bottom: 1em;}</style>';
}
?>
