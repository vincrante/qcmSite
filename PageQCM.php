<?php
include('PDO.php');
if(isset($_SESSION['role']) && $_SESSION['role'] == "etudiant"){
if(isset($_POST['begin']))
{
    $reqQuest = $monPDO->prepare('SELECT * '
                          . 'FROM QUESTION as QU, ASSOQCMQUEST as A, QCM as QC '
                          . 'WHERE QU.idQuestion = A.idQuestion '
                          . 'AND A.idQcm = QC.idQcm '
                          . 'AND QC.nom ="'.$_POST["begin"].'"');
    $reqQuest->execute();
    $tabResQuest = $reqQuest->fetchAll();
echo('<form name="'.$_POST["begin"].'" method="POST" action="pageResultat.php">');
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

            <?php
            foreach($tabResRep as $resRep)
            {
                echo('<input type="radio" name="'.$resQuest['question'].'" value="'.$resRep['reponse'].'"/>'.$resRep['reponse']);
                echo('<br/>');
            }
            ?>
        </td>
    </tr>
</table>
<?php
    }
echo('<br/>');
echo ('<input type="hidden" name="qcm" value ="'.$_POST['begin'].'"/>');
echo ('<input type="submit" name="valid" value="Valider"/>');
echo ('</form>');
}
else
{
    header("Location: index.php");
}
}
?>
