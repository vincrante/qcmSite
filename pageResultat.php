<?php
include('PDO.php');
session_start();
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
    $note = 0 ;
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
                    ?>
                        <label class='juste'> <input type="radio" value="<?php $resRep['reponse'] ?>" <?php if($resRep['reponse'] == $_POST[$resQuest['question']]){ echo('checked="checked"'); $note += 1; }?>/><?php echo($resRep['reponse']); ?></label>
                    <?php
                }
                else {
                    ?>
                       <label class='faux'> <input type="radio" value="<?php $resRep['reponse'] ?>" <?php if($resRep['reponse'] == $_POST[$resQuest['question']]) echo('checked="checked"')?>/><?php echo($resRep['reponse']); ?></label>
                    <?php
                    }
                echo('<br/>');
            }
            
                /*$reqSelectReponse = $monPDO->prepare('SELECT idReponse '
                                                    . 'FROM reponse '
                                                    . 'WHERE reponse = "'.$_POST[$resQuest['question']].'"');
                $reqSelectReponse->execute();
                $tabSelectReponse = $reqSelectReponse->fetchAll();
                
                $idReponse = $tabSelectReponse[0];
                
                $reqResEtu = $monPDO->prepare('INSERT INTO resultat '
                          . 'VALUES("'.$_SESSION['id'].'", "'.$idReponse['idReponse'].'");');
                var_dump($reqResEtu);
                $reqResEtu->execute();*/
            ?>
            </form>
        </td>
    </tr>
</table>
<?php
    }
echo('<br/>');
echo ('</form>');

    $reqNbQuest = $monPDO->prepare('SELECT count(*) '
                          . 'FROM QUESTION as QU, ASSOQCMQUEST as A, QCM as QC '
                          . 'WHERE QU.idQuestion = A.idQuestion '
                          . 'AND A.idQcm = QC.idQcm '
                          . 'AND QC.nom ="'.$_POST['qcm'].'"');
    $reqNbQuest->execute();
    $tabResNbQuest = $reqNbQuest->fetchAll();
    $nbQuest = $tabResNbQuest[0];
    
    $reqIdQcm = $monPDO->prepare('SELECT idQcm '
                                        . 'FROM qcm '
                                        . 'WHERE nom = "'.$_POST['qcm'].'"');
    $reqIdQcm->execute();
    $tabIdQcm = $reqIdQcm->fetchAll();    
    $idQcm = $tabIdQcm[0];
    
    $note = (($note / $nbQuest[0])*20);
    
    $reqResEtu = $monPDO->prepare('INSERT INTO note '
                . 'VALUES("'.$_SESSION['id'].'", "'.$idQcm['0'].'", "'.$note.'");');
    $reqResEtu->execute();    
    
    echo("Votre note sur ce QCM est de : ".$note);
}
?>
