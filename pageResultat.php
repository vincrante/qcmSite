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
if(isset($_POST['valid']))
{
    $reqQuest = $monPDO->prepare('SELECT * '
                          . 'FROM QUESTION as QU, ASSOQCMQUEST as A, QCM as QC '
                          . 'WHERE QU.idQuestion = A.idQuestion '
                          . 'AND A.idQcm = QC.idQcm '
                          . 'AND QC.nom ="'.$_POST['qcm'].'"');
    $reqQuest->execute();
    $tabResQuest = $reqQuest->fetchAll();
    
    foreach($tabResQuest as $resQuest)
    {
?>
<table>
    <tr>
        <td>
            <?php echo($resQuest['question']); ?>
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
            <form>
            <?php
            foreach($tabResRep as $resRep)
            {
                if($resRep['juste'] == 1)
                {
                    echo('<label class="juste"> <input type="radio" class="juste" value="'.$resRep['reponse'].'"/>'.$resRep['reponse'].'</label>');
                }
                else {
                    echo('<label class="faux"> <input type="radio" class="juste" value="'.$resRep['reponse'].'"/>'.$resRep['reponse'].'</label>');

                }
                echo('<br/>');
            }
            ?>
            </form>
        </td>
    </tr>
</table>
<?php
    }
echo('<br/>');
echo ('<form method="POST" action="pageResultat.php">');
echo ('<input type="submit" value="Valider"/>');
echo ('</form>');
}
?>
